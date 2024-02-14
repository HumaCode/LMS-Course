<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Payment;
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
}
