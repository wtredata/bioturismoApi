<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();

        return $this->successResponse($cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'photo' => 'required|image',
            'department_id' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['photo']);
        $fields['photo'] = $request->photo->store('city', 'public');
        $city = City::create($fields);

        return $this->successResponse($city);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return $this->successResponse($city);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);

        $city->fill($request->except(['photo']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$city->photo)[1]);
            $city->photo = $request->photo->store('city', 'public');
        }

        if($city->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $city->save();

        return $this->successResponse($city);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $city->delete();
        Storage::disk('public')->delete(explode('storage/',$city->photo)[1]);
        return $this->successResponse($city);
    }

    /**
     * Cities by a type of service
     * $type: type of service
     * @return \Illuminate\Http\Response
     */
    public function city_type(TypeService $type)
    {
        $city=City::whereIn('id', function($query) use($type){
            $query->select('city_id')
                ->from('partners')
                ->whereIn('id', function($query) use($type){
                    $query->select('partner_id')
                        ->from('services')
                        ->where('type_service_id', $type->id);
                    });
            })->get();

        return $this->successResponse($city);
    }
}
