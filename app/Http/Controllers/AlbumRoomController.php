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
            'image' => 'required',
            'room_id' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['image']);
        $image = $request->image;
        $file_data = $image["imagen"];
        $file_name = 'room/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

        if ($file_data != "") { // storing image in storage/app/public Folder
            Storage::disk('public')->put($file_name, base64_decode($file_data));
            $fields['photo'] = $file_name;
        }

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
        $albumRoom->fill($request->except(['image']));

        if ($request->image != null) {
            $image = $request->image;
            $file_data = $image["imagen"];
            $file_name = 'room/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
                Storage::disk('public')->put($file_name, base64_decode($file_data));
                Storage::disk('public')->delete(explode('storage/',$albumRoom->photo)[1]);
                $albumRoom->photo = $file_name;
            }
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
        Storage::disk('public')->delete(explode('storage/',$albumRoom->image)[1]);
        return $this->successResponse($albumRoom);
    }
}
