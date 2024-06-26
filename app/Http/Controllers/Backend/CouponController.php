<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public function adminAllCoupon()
    {
        $title          = 'All Coupon';
        $subtitle       = 'all coupon';
        $coupons        = Coupon::latest()->get();

        return view('admin.backend.coupon.coupon_all', compact('coupons', 'title', 'subtitle'));
    }

    public function adminAddCoupon()
    {
        $title          = 'Add Coupon';
        $subtitle       = 'add coupon';

        return view('admin.backend.coupon.coupon_add', compact('title', 'subtitle'));
    }

    public function adminStoreCoupon(Request $request)
    {
        $attr = $request->validate([
            'coupon_name'           => 'required',
            'coupon_discount'       => 'required',
            'coupon_validity'       => 'required',
        ]);

        Coupon::insert([
            'coupon_name'       => strtoupper($attr['coupon_name']),
            'coupon_discount'   => $attr['coupon_discount'],
            'coupon_validity'   => $attr['coupon_validity'],
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Coupon Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function adminEditCoupon($id)
    {
        $title          = 'Edit Coupon';
        $subtitle       = 'edit coupon';
        $coupon         = Coupon::findOrFail($id);


        return view('admin.backend.coupon.coupon_edit', compact('title', 'subtitle', 'coupon'));
    }

    public function adminUpdateCoupon(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'coupon_name'           => 'required',
            'coupon_discount'       => 'required',
            'coupon_validity'       => 'required',
        ]);


        Coupon::find($id)->update([
            'coupon_name'       => strtoupper($attr['coupon_name']),
            'coupon_discount'   => $attr['coupon_discount'],
            'coupon_validity'   => $attr['coupon_validity'],
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Coupon Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin.all.coupon')->with($notification);
    }

    public function adminDeleteCoupon($id)
    {
        $data = Coupon::findOrFail($id);

        $data->delete();

        $notification = [
            'message'       => 'Coupon Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }


    // INSTRUCTOR MANAGE ./////////////////////////////////
    public function instructorAllCoupon()
    {
        $title          = 'All Coupon';
        $subtitle       = 'all coupon';
        $id             = Auth::user()->id;
        $coupons        = Coupon::with('course')->where('instructor_id', $id)->latest()->get();

        return view('instructor.coupon.all_coupon', compact('title', 'subtitle', 'coupons'));
    }

    public function instructorAddCoupon()
    {
        $title          = 'Add Coupon';
        $subtitle       = 'add coupon';
        $id             = Auth::user()->id;
        $courses        = Course::where('instructor_id', $id)->get();

        return view('instructor.coupon.add_coupon', compact('title', 'subtitle', 'courses'));
    }

    public function instructorStoreCoupon(Request $request)
    {
        $attr = $request->validate([
            'coupon_name'           => 'required',
            'coupon_discount'       => 'required',
            'course_id'             => 'required',
            'coupon_validity'       => 'required',
        ]);

        Coupon::insert([
            'coupon_name'       => strtoupper($attr['coupon_name']),
            'coupon_discount'   => $attr['coupon_discount'],
            'coupon_validity'   => $attr['coupon_validity'],
            'course_id'         => $attr['course_id'],
            'instructor_id'     => Auth::user()->id,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Coupon Inserted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function instructorEditCoupon($coupon_id)
    {
        // return 'HELLO';

        $title          = 'Edit Coupon';
        $subtitle       = 'edit coupon';
        $id             = Auth::user()->id;
        $coupon         = Coupon::findOrFail($coupon_id);
        $courses        = Course::where('instructor_id', $id)->get();
        // return 'HELLO';


        return view('instructor.coupon.edit_coupon', compact('title', 'subtitle', 'coupon', 'courses'));
    }

    public function instructorUpdateCoupon(Request $request)
    {
        $id = $request->id;

        $attr = $request->validate([
            'coupon_name'           => 'required',
            'coupon_discount'       => 'required',
            'course_id'             => 'required',
            'coupon_validity'       => 'required',
        ]);


        Coupon::find($id)->update([
            'coupon_name'       => strtoupper($attr['coupon_name']),
            'coupon_discount'   => $attr['coupon_discount'],
            'coupon_validity'   => $attr['coupon_validity'],
            'course_id'         => $attr['course_id'],
            'instructor_id'     => Auth::user()->id,
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ]);


        $notification = [
            'message'       => 'Coupon Updated Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('instructor.all.coupon')->with($notification);
    }

    public function instructorDeleteCoupon($id)
    {
        $data = Coupon::findOrFail($id);

        $data->delete();

        $notification = [
            'message'       => 'Coupon Deleted Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
