<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateCityController extends Controller
{
    public function index(State $state)
    {
        $cities = $state->cities;
        return $this->successResponse($cities);
    }
}
