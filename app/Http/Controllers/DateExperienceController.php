<?php

namespace App\Http\Controllers;

use App\Models\DateExperience;
use Illuminate\Http\Request;

class DateExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dateExperiences = DateExperience::all();

        return $this->successResponse($dateExperiences);
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
            'description' => 'required',
            'service_id' => 'required',
        ];
        $this->validate($request, $rules);

        $fields = $request->all();

        $dateExperience = DateExperience::create($fields);

        return $this->successResponse($dateExperience);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DateExperience  $dateExperience
     * @return \Illuminate\Http\Response
     */
    public function show(DateExperience $dateExperience)
    {
        return $this->successResponse($dateExperience);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DateExperience  $dateExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(DateExperience $dateExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DateExperience  $dateExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DateExperience $dateExperience)
    {
        $dateExperience->fill($request->all());

        if($dateExperience->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $dateExperience->save();

        return $this->successResponse($dateExperience);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DateExperience  $dateExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(DateExperience $dateExperience)
    {
        $dateExperience->delete();
        return $this->successResponse($dateExperience);
    }
}
