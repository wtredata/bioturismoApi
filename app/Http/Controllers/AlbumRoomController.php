<?php

namespace App\Http\Controllers;

use App\Models\AlbumRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = AlbumRoom::all();

        return $this->successResponse($albums);
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
            'photo' => 'required|image',
            'room_id' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['photo']);
        $fields['photo'] = $request->photo->store('album_room', 'public');

        $album = AlbumRoom::create($fields);

        return $this->successResponse($album);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlbumRoom  $albumRoom
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumRoom $albumRoom)
    {
        return $this->successResponse($albumRoom);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumRoom  $albumRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumRoom $albumRoom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumRoom  $albumRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlbumRoom $albumRoom)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);
        $albumRoom->fill($request->except(['photo']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$albumRoom->photo)[1]);
            $albumRoom->photo = $request->photo->store('album_room', 'public');
        }

        if($albumRoom->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $albumRoom->save();

        return $this->successResponse($albumRoom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumRoom  $albumRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumRoom $albumRoom)
    {
        $albumRoom->delete();
        Storage::disk('public')->delete(explode('storage/',$albumRoom->photo)[1]);
        return $this->successResponse($albumRoom);
    }
}
