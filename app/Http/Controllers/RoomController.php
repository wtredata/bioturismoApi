<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();

        return $this->successResponse($rooms);
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
            'price' => 'required',
            'type_room_id' => 'required',
            'photo' => 'image',
        ];
        $this->validate($request, $rules);

        $fields = $request->except(['photo']);

        if ($request->has('photo')) {
            $fields['photo'] = $request->photo->store('room', 'public');
        }

        $room = Room::create($fields);

        return $this->successResponse($room);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Room $room)
    {
        return $this->successResponse($room);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);

        $room->fill($request->except(['photo']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$room->photo)[1]);
            $room->photo = $request->photo->store('room', 'public');
        }

        if($room->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $room->save();

        return $this->successResponse($room);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        Storage::disk('public')->delete(explode('storage/',$room->photo)[1]);
        return $this->successResponse($room);
    }
}
