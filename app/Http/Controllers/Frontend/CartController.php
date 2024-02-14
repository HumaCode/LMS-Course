<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirm;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Order;
use App\Models\Payment;
use App\Models\SmtpSetting;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $course = Course::find($id);

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        // Check if the course is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {

            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        }

        return response()->json(['success' => 'Successfully Added on Your Cart']);
    }

    public function buyToCart(Request $request, $id)
    {
        $course = Course::find($id);

        // Check if the course is already in the cart
        $cartItem = Cart::search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });

        if ($cartItem->isNotEmpty()) {
            return response()->json(['error' => 'Course is already in your cart']);
        }

        if ($course->discount_price == NULL) {

            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        } else {

            Cart::add([
                'id' => $id,
                'name' => $request->course_name,
                'qty' => 1,
                'price' => $course->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $course->course_image,
                    'slug' => $request->course_name_slug,
                    'instructor' => $request->instructor,
                ],
            ]);
        }

        return response()->json(['success' => 'Buy Course Prosessing.']);
    }

    public function miniCart()
    {
        $carts      = Cart::content();
        $cartTotal  = Cart::total();
        $cartQty    = Cart::count();

        return response()->json([
            'carts'         => $carts,
            'cartTotal'     => $cartTotal,
            'cartQty'       => $cartQty,
        ]);
    }

    public function miniCartCourseRemove($rowId)
    {
        Cart::remove($rowId);

        return response()->json(['success' => 'Course Remove From Cart']);
    }

    public function myCart()
    {

        return view('frontend.mycart.view_mycart');
    }

    public function getCartCourse()
    {
        $carts      = Cart::content();
        $cartTotal  = Cart::total();
        $cartQty    = Cart::count();

        return response()->json([
            'carts'         => $carts,
            'cartTotal'     => $cartTotal,
            'cartQty'       => $cartQty,
        ]);
    }

    public function cartRemove($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            $coupon_name    = Session::get('coupon')['coupon_name'];
            $coupon         = Coupon::where('coupon_name', $coupon_name)->first();

            Session::put('coupon', [
                'coupon_name'       => $coupon->coupon_name,
                'coupon_discount'   => $coupon->coupon_discount,
                'discount_amount'   => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'      => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);
        }

        return response()->json(['success' => 'Course Remove From Cart']);
    }

    public function couponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name'       => $coupon->coupon_name,
                'coupon_discount'   => $coupon->coupon_discount,
                'discount_amount'   => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount'      => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);


            return response()->json([
                'validity' => true,
                'success' => 'Coupon Applied Successfully',
            ]);
        } else {
            return response()->json([
                'error' => 'Invalid Coupon',
            ]);
        }
    }

    public function couponCalculation()
    {
        if (Session::has('coupon')) {
            return response()->json([
                'subtotal'          => Cart::total(),
                'coupon_name'       => session()->get('coupon')['coupon_name'],
                'coupon_discount'   => session()->get('coupon')['coupon_discount'],
                'discount_amount'   => session()->get('coupon')['discount_amount'],
                'total_amount'      => session()->get('coupon')['total_amount'],
            ]);
        } else {
            return response()->json([
                'total'      => Cart::total(),
            ]);
        }
    }

    public function couponRemove()
    {
        Session::forget('coupon');

        return response()->json(['success' => 'Coupon Remove Successfully']);
    }

    public function checkoutCreate()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts      = Cart::content();
                $cartTotal  = Cart::total();
                $cartQty    = Cart::count();


                return view('frontend.checkout.checkout_view', compact('carts', 'cartTotal', 'cartQty'));
            } else {
                $notification = [
                    'message'       => 'Add At List One Course',
                    'alert-type'    => 'error',
                ];

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = [
                'message'       => 'You Need to Login First',
                'alert-type'    => 'error',
            ];

            return redirect()->route('login')->with($notification);
        }
    }

    public function payment(Request $request)
    {
        if (Session::has('coupon')) {
            $total_amount       = Session::get('coupon')['total_amount'];

            $coupon_discount    = Session::get('coupon')['coupon_discount']; //10%
            $coupon_name        = Session::get('coupon')['coupon_name']; //coupon name 
            $discount_amount    = Session::get('coupon')['discount_amount']; //discount amount 
        } else {
            $total_amount = round(Cart::total());
            $coupon_discount    = 0;
            $coupon_name        = '-';
            $discount_amount    = 0;
        }

        foreach ($request->course_title as $key => $course_title) {
            $exitingOrder =  Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();

            if ($exitingOrder) {
                $notification = [
                    'message'       => 'You Have Already Endrolled in This Course.',
                    'alert-type'    => 'error',
                ];

                $request->session()->forget('cart');

                return redirect()->route('index')->with($notification);
            }
        }

        $data = new Payment();

        $data->name             = $request->name;
        $data->email            = $request->email;
        $data->phone            = $request->phone;
        $data->address          = $request->address;
        $data->cash_delivery    = $request->cash_delivery;
        $data->coupon_discount  = $coupon_discount;
        $data->coupon_name      = $coupon_name;
        $data->discount_amount  = $discount_amount;
        $data->total_amount     = $total_amount;
        $data->payment_type     = 'Direct Payment';

        $data->invoice_no       = 'HCL' . mt_rand(10000000, 99999999);
        $data->order_date       = Carbon::now()->format('d F Y');
        $data->order_month      = Carbon::now()->format('F');
        $data->order_year       = Carbon::now()->format('Y');
        $data->status           = 'pending';
        $data->created_at       = Carbon::now();
        $data->save();



        foreach ($request->course_title as $key => $course_title) {
            $exitingOrder =  Order::where('user_id', Auth::user()->id)->where('course_id', $request->course_id[$key])->first();

            if ($exitingOrder) {
                $notification = [
                    'message'       => 'You Have Already Endrolled in This Course.',
                    'alert-type'    => 'error',
                ];

                $request->session()->forget('cart');

                return redirect()->route('index')->with($notification);
            }


            $order = new Order();
            $order->payment_id      = $data->id;
            $order->user_id         = Auth::user()->id;
            $order->course_id       = $request->course_id[$key];
            $order->instructor_id   = $request->instructor_id[$key];
            $order->course_title    = $course_title;
            $order->price           = $request->price[$key];
            $order->save();
        }

        $request->session()->forget('cart');

        $smpt = SmtpSetting::find(1);

        // check status smpt
        if ($smpt->status == 1) {

            $payment_id = $data->id;

            // sent email notification
            $sendmail = Payment::find($payment_id);
            $data = [
                'invoice_no'    => $sendmail->invoice_no,
                'amount'        => $total_amount,
                'name'          => $sendmail->name,
                'email'         => $sendmail->email
            ];


            Mail::to($request->email)->send(new OrderConfirm($data));
        }


        if ($request->cash_delivery == 'stripe') {
            echo 'stripe';
        } else {
            $notification = [
                'message'       => 'Cash Payment Submit Success.',
                'alert-type'    => 'success',
            ];

            return redirect()->route('index')->with($notification);
        }
    }
}
