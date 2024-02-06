<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
