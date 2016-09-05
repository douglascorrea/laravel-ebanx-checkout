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
        Cart::add($product, 1);
        return Cart::content();
    }

    function destroy() {
        Cart::destroy();
        return Cart::content();
    }

    function remove($rowId) {
        Cart::remove($rowId);
        return response()->json([
            'total' => Cart::total()
        ]);
    }

    function update(Request $request) {
        $data = $request->all();
        $items = $data['items'];

        foreach($items as $item) {
            Cart::update($item["rowId"], $item["qty"]);
        }

        return response()->json([
            'total' => Cart::total()
        ]);
    }
}
