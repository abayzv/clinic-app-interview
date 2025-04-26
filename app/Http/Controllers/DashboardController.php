<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    public function index(DashboardService $dashboardService)
    {
        $metrics = $dashboardService->getMetrics();
        return view('dashboard', compact('metrics'));
    }
}
