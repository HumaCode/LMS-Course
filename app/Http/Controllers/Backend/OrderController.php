<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
}
