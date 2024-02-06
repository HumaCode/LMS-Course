<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
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
}
