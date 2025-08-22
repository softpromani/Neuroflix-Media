<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->orderBy('sequence','asc')->get();
        return view('welcome', compact('products'));
    }
}
