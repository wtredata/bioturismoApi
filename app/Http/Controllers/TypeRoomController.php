<?php

namespace App\Http\Controllers;

use App\Models\TypeRoom;
use Illuminate\Http\Request;

class TypeRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeRooms = TypeRoom::all();

        return $this->successResponse($typeRooms);
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
        ];
        $this->validate($request, $rules);

        $fields = $request->all();
        $typeRoom = TypeRoom::create($fields);

        return $this->successResponse($typeRoom);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeRoom  $typeRoom
     * @return \Illuminate\Http\Response
     */
    public function show(TypeRoom $typeRoom)
    {
        return $this->successResponse($typeRoom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeRoom  $typeRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeRoom $typeRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeRoom  $typeRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeRoom $typeRoom)
    {
        $typeRoom->fill($request->all());

        if($typeRoom->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $typeRoom->save();

        return $this->successResponse($typeRoom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeRoom  $typeRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeRoom $typeRoom)
    {
        $typeRoom->delete();
        return $this->successResponse($typeRoom);
    }
}
