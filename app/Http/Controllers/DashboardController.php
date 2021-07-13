<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\StateSale;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request, StateSale $stateSale)
    {
        $services = Sale::with('services')->where('state_sale_id', $stateSale->id)
        // ->whereRaw('month(updated_at) = month(now())')
        ->get();
        return $this->successResponse($services);
    }
}
