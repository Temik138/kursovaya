<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\OrderStatus; 

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders()->with('items.product')->latest()->get();

        return view('profile.orders', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            abort(403, 'У вас нет прав на отмену этого заказа.');
        }
        if (!$order->status->canBeCancelled()) {
            return redirect()->back()->with('error', 'Этот заказ уже нельзя отменить.');
        }

        $order->status = OrderStatus::CANCELLED;
        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно отменен.');
    }

}