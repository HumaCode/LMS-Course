<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function userProfile()
    {
        $id             =  Auth::user()->id;
        $profileData    = User::findOrFail($id);

        return view('frontend.dashboard.edit_profile', compact('profileData'));
    }

    public function userProfileUpdate(Request $request)
    {
        $id = Auth::user()->id;

        $attr = $request->validate([
            'name'      => 'required',
            'username'  => 'required|unique:users,username,' . $id,
            'email'     => 'required|email|unique:users,email,' . $id,
            'phone'     => 'required|unique:users,phone,' . $id,
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg|max:1000',
            'address'   => 'nullable',
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
                unlink('upload/user_images/' . $data->photo);
            }


            $file = $request->file('photo');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $filename);

            $data['photo'] = $filename;
        }

        $data->save();

        $notification = [
            'message'       => 'User Profile Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
