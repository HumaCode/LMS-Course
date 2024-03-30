<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\SmtpSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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

    public function adminUpdateSetting(Request $request)
    {
        $id   = $request->id;
        $data = SiteSetting::findOrFail($id);

        $attr = $request->validate([
            'phone'      => 'required',
            'email'      => 'required',
            'address'    => 'required',
            'copyright'  => 'required',
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg|max:2000',
        ]);

        if ($request->file('logo')) {

            // unlink foto
            if ($data->logo <> "") {
                unlink($data->logo);
            }

            $images = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $images->getClientOriginalExtension();

            $manager = new ImageManager(Driver::class);
            $image = $manager->read($images);

            $image->resize(140, 41);
            $image->save('upload/logo/' . $name_gen);

            $save_url = 'upload/logo/' . $name_gen;

            $data->update([
                'phone'         => $attr['phone'],
                'email'         => $attr['email'],
                'address'       => $attr['address'],
                'facebook'      => $request->facebook,
                'twitter'       => $request->twitter,
                'copyright'     => $attr['copyright'],
                'logo'          => $save_url,
                'created_at'    => Carbon::now(),
            ]);
        } else {
            $data->update([
                'phone'         => $attr['phone'],
                'email'         => $attr['email'],
                'address'       => $attr['address'],
                'facebook'      => $request->facebook,
                'twitter'       => $request->twitter,
                'copyright'     => $attr['copyright'],
                'created_at'    => Carbon::now(),
            ]);
        }

        $notification = [
            'message'       => 'Site Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
