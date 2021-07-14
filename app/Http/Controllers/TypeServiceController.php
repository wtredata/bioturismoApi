<?php

namespace App\Http\Controllers;

use App\Models\TypeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TypeServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $typeServices = TypeService::all();

        return $this->successResponse($typeServices);
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
            'name' => 'required',
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['photo']);
        $fields['photo'] = $request->photo->store('type_service', 'public');

        $typeService = TypeService::create($fields);

        return $this->successResponse($typeService);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeService  $typeService
     * @return \Illuminate\Http\Response
     */
    public function show(TypeService $typeService)
    {
        return $this->successResponse($typeService);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeService  $typeService
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeService $typeService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeService  $typeService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeService $typeService)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);
        $typeService->fill($request->except(['image']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$typeService->photo)[1]);
            $typeService->photo = $request->photo->store('type_service', 'public');
        }

        /* if ($request->image != null) {
            $image = $request->image;
            $file_data = $image["imagen"];
            $file_name = 'type_service/image_' . time() . '.' . $image["type_image"]; //generating unique file name;

            if ($file_data != "") { // storing image in storage/app/public Folder
                Storage::disk('public')->put($file_name, base64_decode($file_data));
                Storage::disk('public')->delete(explode('storage/',$typeService->photo)[1]);
                $typeService->photo = $file_name;
            }
        } */

        if($typeService->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $typeService->save();

        return $this->successResponse($typeService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeService  $typeService
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeService $typeService)
    {
        $typeService->delete();
        Storage::disk('public')->delete(explode('storage/',$typeService->image)[1]);
        return $this->successResponse($typeService);
    }
}
