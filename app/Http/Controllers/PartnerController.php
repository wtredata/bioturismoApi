<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $partners = Partner::all();

        return $this->successResponse($partners);
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
            'phone' => 'required',
            'direction' => 'required',
            'neighbor' => 'required',
            'email' => 'required',
            'user_id' => 'required',
            'city_id' => 'required',
            'logo' => 'image'
        ];
        $this->validate($request, $rules);

        $fields = $request->except(['logo']);

        if ($request->has('logo')) {
            $fields['logo'] = $request->logo->store('partner', 'public');
        }
        $partner = Partner::create($fields);

        return $this->successResponse($partner);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        return $this->successResponse($partner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Partner $partner)
    {
        $rules = [
            'logo' => 'image',
        ];
        $this->validate($request, $rules);

        $partner->fill($request->except(['logo']));

        if ($request->has('logo')) {
            Storage::disk('public')->delete(explode('storage/',$partner->logo)[1]);
            $partner->logo = $request->logo->store('partner', 'public');
        }

        if($partner->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $partner->save();

        return $this->successResponse($partner);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        $partner->delete();
        Storage::disk('public')->delete(explode('storage/',$partner->logo)[1]);
        return $this->successResponse($partner);
    }
}
