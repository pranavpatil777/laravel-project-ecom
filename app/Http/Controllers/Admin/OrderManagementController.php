<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderManagementController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()->latest()->paginate(20);

        return view('admin.orders', compact('orders'));
    }
}
