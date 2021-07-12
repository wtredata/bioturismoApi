<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $services = Sale::with('services')->where('state_sale_id', 3)
        ->whereRaw('month(updated_at) = month(now())')->get();
        return $this->successResponse($services);
    }
}
