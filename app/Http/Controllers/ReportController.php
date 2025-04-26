<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected ReportService $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function salesReport(Request $request)
    {
        $data = $this->reportService->getSalesReport($request);

        return view('reports.sales-report', [
            'sales' => $data['sales'],
            'metrics' => $data['metrics'],
        ]);
    }

    public function productsSoldReport(Request $request)
    {
        $productsSold = $this->reportService->getProductsSoldReport($request->start_date, $request->end_date);

        return view('reports.products-sold-report', compact('productsSold'));
    }
}
