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

    public function adminPendingReview()
    {
        $title      = 'Pending Review';
        $subtitle   = 'pending review';
        $review     = Review::with('user', 'course')->where('status', 0)->orderBy('id', 'DESC')->get();

        return view('admin.backend.review.pending_review', compact('title', 'subtitle', 'review'));
    }

    public function updateReviewStauts(Request $request)
    {
        $reviewId   = $request->input('review_id');
        $isChecked  = $request->input('is_checked', 0);

        $review = Review::find($reviewId);
        if ($review) {
            $review->status = $isChecked;
            $review->save();
        }

        return response()->json(['message' => 'Review Status Updated Successfully']);
    }


    public function adminActiveReview()
    {
        $title      = 'Active Review';
        $subtitle   = 'active review';
        $review     = Review::with('user', 'course')->where('status', 1)->orderBy('id', 'DESC')->get();

        return view('admin.backend.review.active_review', compact('title', 'subtitle', 'review'));
    }

    public function instructorAllReview()
    {
        $title      = 'All Review';
        $subtitle   = 'all review';
        $id         = Auth::user()->id;
        $review     = Review::with('user', 'course')->where('instructor_id', $id)->orderBy('id', 'DESC')->get();

        return view('instructor.review.all_review', compact('title', 'subtitle', 'review'));
    }
}
