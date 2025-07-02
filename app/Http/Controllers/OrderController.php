<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Убедитесь, что модель Order импортирована

class OrderController extends Controller
{
    /**
     * Display a listing of the user's orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();

        $orders = $user->orders()->with(['items.product'])->latest()->get();

        return view('profile.orders', compact('orders'));
    }
}