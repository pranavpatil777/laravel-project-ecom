<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class CatalogManagementController extends Controller
{
    public function index(): View
    {
        $products = Product::query()->with('category')->latest()->paginate(20);

        return view('admin.catalog', compact('products'));
    }
}
