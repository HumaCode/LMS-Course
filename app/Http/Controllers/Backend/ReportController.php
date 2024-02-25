<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function adminReportView()
    {
        $title          = 'Report View';
        $subtitle       = 'report view';

        return view('admin.backend.report.report_view', compact('title', 'subtitle'));
    }
}
