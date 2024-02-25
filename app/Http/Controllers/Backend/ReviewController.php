<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function storeReview(Request $request)
    {
        $attr = $request->validate([
            'course_id'         => 'required',
            'instructor_id'     => 'required',
            'comment'           => 'required',
            'rate'              => 'required',
        ]);

        $courseId       = $attr['course_id'];
        $instructorId   = $attr['instructor_id'];

        Review::insert([
            'course_id'     => $courseId,
            'instructor_id' => $instructorId,
            'user_id'       => Auth::id(),
            'comment'       => $attr['comment'],
            'rating'        => $attr['rate'],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Review Will Approve With Admin',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
