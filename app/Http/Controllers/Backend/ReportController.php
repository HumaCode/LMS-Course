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

    public function adminSearchByMonth(Request $request)
    {
        $title          = 'Report By Month';
        $subtitle       = 'report by month';

        // if ($request->month == null && $request->year == null) {
        //     $month          = date('F');
        //     $year           = date('Y');
        // } else if ($request->month != null && $request->year == null) {
        //     $month          = $request->month;
        //     $year           = date('Y');
        // } else if ($request->month == null && $request->year != null) {
        //     $month          = date('F');
        //     $year           = $request->year_name;
        // }

        $year           = $request->year_name;
        $month          = $request->month;

        $payment        = Payment::where('order_month', $month)->where('order_year', $year)->latest()->get();

        return view('admin.backend.report.report_by_month', compact('title', 'subtitle', 'payment', 'month', 'year'));
    }

    public function adminSearchByYear(Request $request)
    {
        $title          = 'Report By Year';
        $subtitle       = 'report by year';

        if ($request->year == null) {
            $year           = date('Y');
        } else {
            $year           = $request->year;
        }

        $payment        = Payment::where('order_year', $year)->latest()->get();

        return view('admin.backend.report.report_by_year', compact('title', 'subtitle', 'payment', 'year'));
    }
}
