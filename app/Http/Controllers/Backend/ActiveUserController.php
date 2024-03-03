<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ActiveUserController extends Controller
{
    public function adminAllUser()
    {
        $title      = 'All Users';
        $subtitle   = 'all users';
        $users      = User::where('role', 'user')->latest()->get();


        return view('admin.backend.users.user_all', compact('title', 'subtitle', 'users'));
    }

    public function updateUserStauts(Request $request)
    {
        $userId   = $request->input('user_id');
        $isChecked  = $request->input('is_checked', 0);

        $user = User::find($userId);
        if ($user) {
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully']);
    }
}
