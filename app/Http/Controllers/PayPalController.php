<?php

namespace App\Http\Controllers;

use App\Book;
use App\Mail\DemoEmail;
use App\Order;
use App\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;

class PayPalController extends Controller
{
    //
    public function paypalCreateOrder()
    {
        $cart = \session()->get('cart');
        if($cart === null){
            return 'fail';
        }
        //init Paypal
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $config = [
            'mode' => 'sandbox',
            'sandbox' => [
                'client_id' => 'AZUhv2DMf2w53vpzdTrvYTtIog91TiV9huprdxxBLaOh-n2fO6AThNvDgKhvNOmwmI8Ofv8CsC2MZ-Vp',
                'client_secret' => 'EGiXiPT9ku18Z166tqLw1jlGNJdYNB7ml85xiWhFwvD8V-_v_ISRMbmxj-Hvg186O7OvWGZDkBOzKyF1',
                'app_id' => 'APP-80W284485P519543T',
            ],

            'payment_action' => 'Sale',
            'currency' => 'USD',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];

        $provider->setApiCredentials($config);

        $provider->setAccessToken($provider->getAccessToken());

        $price = \session()->get('total') / 23192;

        $data = json_decode('{
            "intent": "CAPTURE",
            "purchase_units": [
              {
                "amount": {
                  "currency_code": "USD",
                  "value": "' . round($price,2) . '"
                }
              }
            ]
        }', true);

        $orderPurchase = $provider->createOrder($data);

        return response()->json($orderPurchase);
    }

    public function CaptureOrder(Request $request)
    {
        if(\auth()->user()->profile->diachi == null || \auth()->user()->profile->sdt == null){
            Session::flash('error', 'Vui lập cập nhật địa chỉ và sđt liên hệ.');
            return redirect()->route('profile');
        }
        $orderId = json_decode($request->getContent(), true)['orderId'];

        //init Paypal
        $provider = new PayPalClient;
        $provider = \PayPal::setProvider();
        $config = [
            'mode' => 'sandbox',
            'sandbox' => [
                'client_id' => 'AZUhv2DMf2w53vpzdTrvYTtIog91TiV9huprdxxBLaOh-n2fO6AThNvDgKhvNOmwmI8Ofv8CsC2MZ-Vp',
                'client_secret' => 'EGiXiPT9ku18Z166tqLw1jlGNJdYNB7ml85xiWhFwvD8V-_v_ISRMbmxj-Hvg186O7OvWGZDkBOzKyF1',
                'app_id' => 'APP-80W284485P519543T',
            ],
            'notify_url'     => '',
            'payment_action' => 'Sale',
            'currency' => 'USD',
            'locale' => 'en_US',
            'validate_ssl' => true,
        ];

        $provider->setApiCredentials($config);

        $provider->setAccessToken($provider->getAccessToken());

        $result = $provider->capturePaymentOrder($orderId);
        Log::info($result);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'paymentId' => $orderId
        ]);
        foreach (\session()->get('cart') as $key => $value){
            OrderDetails::create([
                'order_id'  => $order->id,
                'book_id'   => $key,
                'quantity'  => $value['qty']
            ]);
            $book = Book::find($key);
            $book->soluong = $book->soluong - $value['qty'];
            $book->save();
        }

//        $objDemo = new \stdClass();
//        $objDemo->action = 'thanh toán';
//        $objDemo->created_at = now();
//        $objDemo->cart = \session()->get('cart');
//        $objDemo->receiver = Auth::user()->name;
//        Mail::to(Auth::user()->email)->send(new DemoEmail($objDemo));

        Session::put('cart_old', \session()->get('cart'));
        Session::put('order_id', $order->id);

        Session::forget('cart');
        Session::forget('total');


        return response()->json($result);
    }

}
