<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function adminReportView()
    {
        $title          = 'Report View';
        $subtitle       = 'report view';

        return view('admin.backend.report.report_view', compact('title', 'subtitle'));
    }

    public function adminSearchByDate(Request $request)
    {
        $title          = 'Report By Date';
        $subtitle       = 'report by date';

        $date           = new DateTime($request->date);
        $formatDate     = $date->format('d F Y');

        $payment        = Payment::where('order_date', $formatDate)->latest()->get();

        return view('admin.backend.report.report_by_date', compact('title', 'subtitle', 'payment', 'formatDate'));
    }
}
