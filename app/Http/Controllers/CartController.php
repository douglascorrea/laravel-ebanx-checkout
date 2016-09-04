<?php

namespace App\Http\Controllers;
use Cart;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests;

class CartController extends Controller
{
    function add($id) {
        $product = Product::find($id);
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]);
        return response()->json([
            'qty' => Cart::count() 
        ]);
    }
}
