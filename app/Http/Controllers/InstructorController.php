<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InstructorController extends Controller
{
    public function instructorDashboard()
    {
        return view('instructor.index');
    }

    public function instructorLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/instructor/login');
    }

    public function instructorLogin()
    {
        return view('instructor.instructor_login');
    }

    public function instructorProfile()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('instructor.instructor_profile_view', compact('profileData'));
    }

    public function instructorProfileStore(Request $request)
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
                unlink('upload/instructor_images/' . $data->photo);
            }


            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/instructor_images'), $filename);

            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message'       => 'Instructor Profile Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function instructorChangePassword()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::find($id);

        return view('instructor.instructor_change_password', compact('profileData'));
    }

    public function instructorPasswordUpdate(Request $request)
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
}
