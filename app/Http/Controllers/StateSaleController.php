<?php

namespace App\Http\Controllers;

use App\Models\StateSale;
use Illuminate\Http\Request;

class StateSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stateSales = StateSale::all();

        return $this->successResponse($stateSales);
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
        $stateSale = City::create($fields);

        return $this->successResponse($stateSale);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StateSale  $stateSale
     * @return \Illuminate\Http\Response
     */
    public function show(StateSale $stateSale)
    {
        return $this->successResponse($stateSale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StateSale  $stateSale
     * @return \Illuminate\Http\Response
     */
    public function edit(StateSale $stateSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StateSale  $stateSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StateSale $stateSale)
    {
        $stateSale->fill($request->all());

        if($stateSale->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $stateSale->save();

        return $this->successResponse($stateSale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StateSale  $stateSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(StateSale $stateSale)
    {
        $stateSale->delete();
        return $this->successResponse($stateSale);
    }
}
