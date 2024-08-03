<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentGatewayController extends Controller
{

    public function get_checkout_id(Request $request)
    {

        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=" . $request->subtotal .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='
            )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $res = json_decode($responseData, true);

        $view = view('ajax.form')->with(['responseData' => $res, 'subtotal' => $request->subtotal])
            ->renderSections();

        return response()->json([
            'status' => true,
            'content' => $view['main']
        ]);
    }

    public function show($offer_id)
    {
        $offer = Offer::findOrFail($offer_id);

        if (request('id') && request('resourcePath')) {
            $payment_status = $this->getPaymentStatus(request('id'), request('resourcePath'));
            if (isset($payment_status['id'])) { //success payment id -> transaction bank id
                $showSuccessPaymentMessage = true;

                //save order in orders table with transaction id  = $payment_status['id']
                return view($this->module_view_folder . '.details', compact('offer'))->with(['success' => 'تم الدفغ بنجاح']);
            } else {
                $showFailPaymentMessage = true;
                return view($this->module_view_folder . '.details', compact('offer'))->with(['fail' => 'فشلت عملية الدفع']);
            }

        }
        return view($this->module_view_folder . '.details', compact('offer'));
    }

}