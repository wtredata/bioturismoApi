<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Experience;
use App\Models\Sale;
use App\Models\TypeExperience;
use App\Models\TypeService;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::all();

        return $this->successResponse($sales);
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
            'date_start' => '',
            'date_end' => '',
            'state_sale_id' => 'required',
        ];
        $this->validate($request, $rules);

        $fields = $request->all();
        $sale = Sale::create($fields);

        return $this->successResponse($sale);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        $sale->stateSale = $sale->stateSale;
        $json = json_decode($sale->data_client);
        if ($json["type_service"] != null) {
            $json["type_service_data"] = TypeService::findOrFail($json["type_service"]);
        }
        if ($json["experience"] != null) {
            $json["experience_data"] = Experience::findOrFail($json["experience"]);
        }
        if ($json["city_id"] != null) {
            $json["city_data"] = City::findOrFail($json["city_id"]);
        }
        if ($json["type_experience"] != null) {
            $json["type_experience_data"] = TypeExperience::findOrFail($json["type_experience"]);
        }
        $sale->client = $json;
        return $this->successResponse($sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $sale->fill($request->all());

        if($sale->isClean()){
            return response()->json("No se hicieron cambios",422);
        }

        $sale->save();

        return $this->successResponse($sale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        $sale->delete();
        return $this->successResponse($sale);
    }
}
