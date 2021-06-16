<?php

namespace App\Http\Controllers;

use App\Models\TypeExperience;
use Illuminate\Http\Request;

class TypeExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeExperience = TypeExperience::all();
        return $this->successResponse($typeExperience);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        ];
        $this->validate($request, $rules);

        $fields = $request->all();
        $typeExperience = TypeExperience::create($fields);

        return $this->successResponse($typeExperience);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeExperience  $typeExperience
     * @return \Illuminate\Http\Response
     */
    public function show(TypeExperience $typeExperience)
    {
        return $this->successResponse($typeExperience);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeExperience  $typeExperience
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeExperience $typeExperience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeExperience  $typeExperience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeExperience $typeExperience)
    {
        $typeExperience->fill($request->all());

        if($typeExperience->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $typeExperience->save();

        return $this->successResponse($typeExperience);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeExperience  $typeExperience
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeExperience $typeExperience)
    {
        $typeExperience->delete();
        return $this->successResponse($typeExperience);
    }
}
