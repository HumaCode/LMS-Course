<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.index');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminLogin()
    {
        return view('admin.admin_login');
    }

    public function adminProfile()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('admin.admin_profile_view', compact('profileData'));
    }

    public function adminProfileStore(Request $request)
    {
        $id = Auth::user()->id;

        $attr = $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users,username,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'phone'     => 'required|unique:users,phone,' . $id,
            'address'   => 'nullable',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:1000'
        ]);

        $data = User::findOrFail($id);

        $data->name         = $attr['name'];
        $data->username     = $attr['username'];
        $data->email        = $attr['email'];
        $data->phone        = $attr['phone'];
        $data->address      = $attr['address'];


        if ($request->file('photo')) {

            // unlink foto
            if ($data->photo <> "") {
                unlink('upload/admin_images/' . $data->photo);
            }


            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);

            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message'       => 'Admin Profile Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function adminChangePassword()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('admin.admin_change_password', compact('profileData'));
    }

    public function adminPasswordUpdate(Request $request)
    {
        $attr = $request->validate([
            'old_password'                  => 'required',
            'new_password'                  => 'required|min:6|confirmed',
            'new_password_confirmation'     => 'required',
        ]);

        if (!Hash::check($attr['old_password'], auth::user()->password)) {
            $notification = [
                'message'       => 'Old Password Does Not Match..!',
                'alert-type'    => 'error',
            ];

            return redirect()->back()->with($notification);
        }

        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($attr['new_password']),
        ]);

        $notification = [
            'message'       => 'Password Change Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function becomeInstructor()
    {
        return view('frontend.instructor.reg_instructor');
    }
    
    public function instructorRegister(Request $request)
    {
        $attr = $request->validate([
            'name'                  => 'required|unique:users,name',
            'username'              => 'required|unique:users,username',
            'email'                 => 'required|unique:users,email',
            'phone'                 => 'required|unique:users,phone',
            'address'               => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);


        User::insert([
            'name'          => $attr['name'],
            'username'      => $attr['username'],
            'email'         => $attr['email'],
            'phone'         => $attr['phone'],
            'address'       => $attr['address'],
            'password'      => Hash::make($attr['password']),
            'role'          => 'instructor',
            'status'        => '0',
        ]);

        $notification = [
            'message'       => 'Instructor Register Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('instructor.login')->with($notification);
    }
}
