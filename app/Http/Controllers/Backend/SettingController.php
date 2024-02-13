<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SmtpSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function adminSmptSetting()
    {
        $title      = 'Edit Category';
        $subtitle   = 'edit category';
        $smpt       = SmtpSetting::findOrFail(1);

        return view('admin.backend.setting.smpt_update', compact('smpt', 'title', 'subtitle'));
    }
}
