<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function adminSmptSetting()
    {
        $title      = 'Edit SMPT Setting';
        $subtitle   = 'edit smpt setting';
        $smpt       = SmtpSetting::findOrFail(1);

        return view('admin.backend.setting.smpt_update', compact('smpt', 'title', 'subtitle'));
    }

    public function adminUpdateSmpt(Request $request)
    {
        $smpt_id = $request->id;

        if ($request->status != null) {
            $stts = 1;
        } else {
            $stts = 0;
        }

        SmtpSetting::find($smpt_id)->update([
            'mailer'        => $request->mailer,
            'host'          => $request->host,
            'port'          => $request->port,
            'username'      => $request->username,
            'password'      => $request->password,
            'encryption'    => $request->encryption,
            'from_address'  => $request->from_address,
            'status'        => $stts,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Smpt Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    ////////////////////////    SITE SETTING     ////////////////////////////////


    public function adminSiteSetting()
    {
        $title      = 'Edit Site Setting';
        $subtitle   = 'edit site setting';
        $site       = SiteSetting::findOrFail(1);

        return view('admin.backend.site.site_update', compact('site', 'title', 'subtitle'));
    }
}
