<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;

class CheckoutController extends Controller
{
    function index() {
        $items = Cart::content();

        return view('checkout', compact('items'));
    }

    function payment(Request $request) {
        \Ebanx\Config::set([
            'integrationKey' => 'Afa72ee756672551ca2cb945cc9158ccc3937596d24217722c2b262226d5c6a9826fc73deb4434fa6d54d241f286aa8cffaf',
            'testMode' => true,
            'directMode' => true
        ]);

        $data = $this->handleData($request);

        $paymentData = array(
            'mode'      => 'full',
            'operation' => 'request',
            'payment'   => array(
                'merchant_payment_code' => time(),
                'amount_total'      => Cart::total(),
                'currency_code'     => 'USD',
                'name'              => $data["name"],
                'email'             => $data["email"],
                'birth_date'        => $data["birth_date"],
                'document'          => $data["document"],
                'address'           => $data["address"],
                'street_number'     => $data["street_number"],
                'city'              => $data["city"],
                'state'             => $data["state"],
                'zipcode'           => $data["zipcode"],
                'country'           => $data["country"],
                'phone_number'      => $data["phone_number"],
                'payment_type_code' => $data["payment_method"] == 'credit-card' || $data["payment_method"] == 'debit-card'  ? $data["credit_card"] : $data["payment_method"],
                'creditcard' => array(
                    'card_number' => $data["card_number"],
                    'card_name' => $data['card_holder_name'],
                    'card_due_date' => $data['due_date'],
                    'card_cvv' => $data['cvv'],
                    'auto_capture' => true
                )
            )
        );

        $ebanx_request = \Ebanx\Ebanx::doRequest($paymentData);

        return response()->json($ebanx_request);
    }

    private function handleData($request) {
        $data = json_decode($request->all()["data"]);

        $newData = [];

        foreach($data as $item) {
            $newData[$item->name] = $item->value;
        }
        return $newData;
    }
}