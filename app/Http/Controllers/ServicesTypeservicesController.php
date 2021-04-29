<?php

namespace App\Http\Controllers;

use App\Models\TypeService;
use Illuminate\Http\Request;

class ServicesTypeservicesController extends Controller
{
    public function index(TypeService $typeService)
    {
        $services = $typeService->services;

        return $this->successResponse($services);
    }
}
