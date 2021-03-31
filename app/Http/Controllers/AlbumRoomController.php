<?php

namespace App\Http\Controllers;

use App\Models\AlbumRoom;
use Illuminate\Http\Request;

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
        $fields = $request->all();
        $album = CommentService::create($fields);

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
        $albumRoom->fill($request->all());

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
        return $this->successResponse($albumRoom);
    }
}
