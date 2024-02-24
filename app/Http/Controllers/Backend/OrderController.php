<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseSection;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Question;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function adminPendingOrder()
    {
        $title          = 'Pending Orders';
        $subtitle       = 'pending orders';
        $payment        = Payment::where('status', 'pending')->orderBy('id', 'DESC')->get();

        return view('admin.backend.orders.pending_orders', compact('title', 'subtitle', 'payment'));
    }

    public function adminOrderDetail($payment_id)
    {
        $title          = 'Detail Order';
        $subtitle       = 'detail order';
        $payment        = Payment::where('id', $payment_id)->first();
        $order_item     = Order::with('user', 'payment', 'course')->where('payment_id', $payment_id)->orderBy('id', 'DESC')->get();

        return view('admin.backend.orders.admin_orders_detail', compact('title', 'subtitle', 'payment', 'order_item'));
    }

    public function pendingToConfirm($payment_id)
    {
        Payment::findOrFail($payment_id)->update([
            'status'        => 'confirm',
            'confirmed_by'  => Auth::user()->id,
            'confirm_date'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Order Confirm Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->route('admin-confirm-order')->with($notification);
    }

    public function adminConfirmOrder()
    {
        $title          = 'Confirm Order';
        $subtitle       = 'confirm order';
        $payment        = Payment::where('status', 'confirm')->orderBy('id', 'DESC')->get();


        return view('admin.backend.orders.confirm_orders', compact('payment', 'title', 'subtitle'));
    }

    public function instructorAllOrder()
    {
        $title              = 'All Orders';
        $subtitle           = 'all orders';
        $id                 = Auth::user()->id;
        $latestOrderItem    = Order::where('instructor_id', $id)->select('payment_id', \DB::raw('MAX(id) as max_id'))->groupBy('payment_id');

        $orderItem          = Order::with('payment')->joinSub($latestOrderItem, 'latest_order', function ($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id', 'DESC')->get();

        return view('instructor.orders.all_order', compact('orderItem', 'title', 'subtitle'));
    }

    public function instructorOrderDetail($payment_id)
    {
        $title          = 'Detail Order';
        $subtitle       = 'detail order';
        $payment        = Payment::with('user')->where('id', $payment_id)->first();
        $order_item     = Order::with('user', 'payment', 'course')->where('payment_id', $payment_id)->orderBy('id', 'DESC')->get();

        return view('instructor.orders.orders_detail', compact('title', 'subtitle', 'payment', 'order_item'));
    }

    public function instructorPendingConfirm($payment_id)
    {
        Payment::findOrFail($payment_id)->update([
            'status'        => 'confirm',
            'confirmed_by'  => Auth::user()->id,
            'confirm_date'  => Carbon::now(),
        ]);

        $notification = [
            'message'       => 'Order Confirm Successfully',
            'alert-type'    => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    public function instructorOrderInvoice($payment_id)
    {
        $payment        = Payment::with('user')->where('id', $payment_id)->first();
        $orderItem      = Order::with('user', 'payment', 'course')->where('payment_id', $payment_id)->orderBy('id', 'DESC')->get();


        $pdf = Pdf::loadView('instructor.orders.order_pdf', compact('payment', 'orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);

        return $pdf->download('invoice.pdf');
    }

    public function myCourse()
    {
        $id = Auth::user()->id;

        $latestOrders = Order::where('user_id', $id)->select('course_id', \DB::raw('MAX(id) as max_id'))->groupBy('course_id');

        $mycoruse = Order::joinSub($latestOrders, 'latest_order', function ($join) {
            $join->on('orders.id', '=', 'latest_order.max_id');
        })->orderBy('latest_order.max_id', 'DESC')->get();

        return view('frontend.mycourse.my_all_course', compact('mycoruse'));
    }

    public function courseView($course_id)
    {
        $id             = Auth::user()->id;

        $course         = Order::where('course_id', $course_id)->where('user_id', $id)->first();
        $section        = CourseSection::where('course_id', $course_id)->orderBy('id', 'asc')->get();
        $allQuestion    = Question::where('course_id', $course_id)->latest()->get();

        return view('frontend.mycourse.course_view', compact('course', 'section', 'allQuestion'));
    }
}
