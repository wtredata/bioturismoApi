<?php

namespace App\Http\Controllers;

use App\Models\AlbumService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = AlbumService::all();

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
            'service_id' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['image']);
        $image = $request->image;
        $file_data = $image["imagen"];
        $file_name = 'service/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

        if ($file_data != "") { // storing image in storage/app/public Folder
            Storage::disk('public')->put($file_name, base64_decode($file_data));
            $fields['photo'] = $file_name;
        }
        $album = AlbumService::create($fields);

        return $this->successResponse($album);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AlbumService  $albumService
     * @return \Illuminate\Http\Response
     */
    public function show(AlbumService $albumService)
    {
        return $this->successResponse($albumService);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AlbumService  $albumService
     * @return \Illuminate\Http\Response
     */
    public function edit(AlbumService $albumService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AlbumService  $albumService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AlbumService $albumService)
    {
        $albumService->fill($request->except(['image']));

        if ($request->image != null) {
            $image = $request->image;
            $file_data = $image["imagen"];
            $file_name = 'product/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
                Storage::disk('public')->put($file_name, base64_decode($file_data));
                Storage::disk('public')->delete(explode('storage/',$albumService->photo)[1]);
                $albumService->photo = $file_name;
            }
        }

        if($albumService->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $albumService->save();

        return $this->successResponse($albumService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AlbumService  $albumService
     * @return \Illuminate\Http\Response
     */
    public function destroy(AlbumService $albumService)
    {
        $albumService->delete();
        Storage::disk('public')->delete(explode('storage/',$albumService->image)[1]);
        return $this->successResponse($albumService);
    }
}
