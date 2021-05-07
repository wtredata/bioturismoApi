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
            'image' => 'required|image',
            'service_id' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['photo']);
        $fields['photo'] = $request->photo->store('album_service', 'public');
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
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);
        $albumService->fill($request->except(['image']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$albumService->photo)[1]);
            $albumService->photo = $request->photo->store('album_service', 'public');
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
        Storage::disk('public')->delete(explode('storage/',$albumService->photo)[1]);
        return $this->successResponse($albumService);
    }
}
