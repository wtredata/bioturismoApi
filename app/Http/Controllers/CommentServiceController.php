<?php

namespace App\Http\Controllers;

use App\Models\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = CommentService::all();

        return $this->successResponse($comments);
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
            'description' => 'required',
            'service_id' => 'required',
            'photo' => 'image'
        ];
        $this->validate($request, $rules);
        $fields = $request->except(['photo']);

        if ($request->has('image'))
        {
            $fields['photo'] = $request->photo->store('comment', 'public');
        }

        $comment = CommentService::create($fields);

        return $this->successResponse($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommentService  $commentService
     * @return \Illuminate\Http\Response
     */
    public function show(CommentService $commentService)
    {
        return $this->successResponse($commentService);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommentService  $commentService
     * @return \Illuminate\Http\Response
     */
    public function edit(CommentService $commentService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommentService  $commentService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommentService $commentService)
    {
        $rules = [
            'photo' => 'image',
        ];
        $this->validate($request, $rules);
        $commentService->fill($request->except(['photo']));

        if ($request->has('photo')) {
            Storage::disk('public')->delete(explode('storage/',$commentService->photo)[1]);
            $commentService->photo = $request->photo->store('comment', 'public');
        }

        if($commentService->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $commentService->save();

        return $this->successResponse($commentService);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommentService  $commentService
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommentService $commentService)
    {
        $commentService->delete();
        Storage::disk('public')->delete(explode('storage/',$commentService->photo)[1]);
        return $this->successResponse($commentService);
    }
}
