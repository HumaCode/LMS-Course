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
}
