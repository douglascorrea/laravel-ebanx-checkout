<?php

namespace App\Http\Controllers;

use Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProductsController extends Controller
{
    function index() {
        $products = Product::all();
        return view('products', compact('products'));
    }
}
