<?php

namespace App\Http\Controllers;

use App\Models\AlbumService;
use Illuminate\Http\Request;

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
        $fields = $request->all();
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
        $albumService->fill($request->all());

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
        return $this->successResponse($albumService);
    }
}
