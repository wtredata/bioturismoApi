<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Service;
use App\Models\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();

        return $this->successResponse($services);
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
            'partner_id' => 'required',
            'type_service_id' => 'required',
        ];
        $this->validate($request, $rules);

        $fields = $request->except(['image']);

        if ($request->image != null) {
            $image = $request->image;
            $file_data = $image["imagen"];
            $file_name = 'service/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
                Storage::disk('public')->put($file_name, base64_decode($file_data));
                $fields['photo'] = $file_name;
            }
        }

        $service = Service::create($fields);

        return $this->successResponse($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $service->rooms=$service->rooms;
        $service->albums=$service->albums;
        return $this->successResponse($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $service->fill($request->except(['image']));

        if ($request->image != null) {
            $image = $request->image;
            $file_data = $image["imagen"];
            $file_name = 'service/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
                Storage::disk('public')->put($file_name, base64_decode($file_data));
                Storage::disk('public')->delete(explode('storage/',$service->photo)[1]);
                $service->photo = $file_name;
            }
        }

        if($service->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $service->save();

        return $this->successResponse($service);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        Storage::disk('public')->delete(explode('storage/',$service->image)[1]);
        return $this->successResponse($service);
    }


    /**
     * Services by type of service and city
     *
     * $type: type of service
     * $city: city searched
     * @return \Illuminate\Http\Response
     */
    public function service_city_type(TypeService $type, City $city)
    {
        $services = Service::whereHas('partner', function ($item) use($city){
            $item->where('city_id', $city->id);
        })->where('type_service_id', $type->id)->get();

        return $this->successResponse($services);
    }

}
