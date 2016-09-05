<?php

namespace App\Http\Controllers;

use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use App\Mail\CreditCardOrderConfirmed;
use App\Mail\CreditCardConfirmedSpanish;
use App\Mail\OxxoConfirmed;
use App\Mail\BoletoConfirmed;
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
        $is_card = $data["payment_method"] == 'credit-card' || $data["payment_method"] == 'debit-card' ? true : false;
        $is_oxxo = $data["payment_method"] == 'oxxo';
        $is_boleto = $data["payment_method"] == 'boleto';

        if(isset($ebanx_request->payment)) {
            $payment_info = $ebanx_request->payment;
            $card_successfull = isset($payment_info->transaction_status) && $payment_info->transaction_status->code == "OK" ? true : false;
            if($is_card && $card_successfull) {
                Cart::destroy();
                if($data["country"] == "br") {
                    Mail::to($data["email"])->send(new CreditCardOrderConfirmed());
                } else {
                    Mail::to($data["email"])->send(new CreditCardConfirmedSpanish());
 
                }
            }
            if(!$is_card && $ebanx_request->status == 'SUCCESS') {
                Cart::destroy();
                if($is_boleto) {
                    Mail::to($data["email"])->send(new BoletoConfirmed($payment_info->boleto_url));
                } else {
                    Mail::to($data["email"])->send(new OxxoConfirmed($payment_info->oxxo_url));
 
                }
            }
        }


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