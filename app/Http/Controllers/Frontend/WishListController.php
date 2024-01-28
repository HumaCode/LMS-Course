<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function addToWishlist(Request $request, $course_id)
    {
        if (Auth::check()) {
            $exists = Wishlist::where('user_id', Auth::id())->where('course_id', $course_id)->first();

            if (!$exists) {
                Wishlist::insert([
                    'user_id'       => Auth::id(),
                    'course_id'     => $course_id,
                    'created_at'    => Carbon::now(),
                    'updated_at'    => Carbon::now(),
                ]);


                return response()->json(['success' => 'Successfully Added on Your Wishlist.']);
            } else {
                return response()->json(['error' => 'This Product Has Already on Your Wishlist.']);
            }
        } else {
            return response()->json(['error' => 'At First Login Your Account.']);
        }
    }

    public function allWishlist()
    {
        return view('frontend.wishlist.all_wishlist');
    }
}
