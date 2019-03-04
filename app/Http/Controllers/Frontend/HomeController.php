<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    public function showHomePage()
    {
        $data = [];
        $data['products'] = Product::select(['id', 'title', 'slug', 'price', 'sale_price'])->where('active', 1)->paginate(9);

        return view('frontend.home', $data);
    }

    public function getCart(): void
    {
        $client = new Client(['base_uri' => 'https://sandbox.sslcommerz.com/', 'timeout' => 2]);
        $response = $client->post('gwprocess/v3/api.php', [
            'form_params' => [
                'store_id' => 'test_cardsbill',
                'store_passwd' => 'test_cardsbill@ssl',
                'total_amount' => '100',
                'currency' => 'BDT',
                'tran_id' => '1234',
                'success_url' => 'http://llc-ecommerce.sumon',
                'fail_url' => 'http://llc-ecommerce.sumon',
                'cancel_url' => 'http://llc-ecommerce.sumon',
                'cus_name' => 'Test',
                'cus_email' => 'test@gmail.com',
                'cus_phone' => '01854969657',
            ],
        ]);

        $response = $response->getBody()->getContents();
        $data = json_decode($response, true);

        header('Location: '.$data['GatewayPageURL']);
        exit();
    }

    public function getPayment()
    {
        return request()->all();
    }

    public function sendSms(): void
    {
        $client = new Client(['base_uri' => 'http://clients.muthofun.com:8901/esmsgw/', 'timeout' => 2]);
        $response = $client->post('sendsms.jsp', [
            'form_params' => [
                'user' => 'llcrocks',
                'password' => 'LLCr0ck$',
                'mobiles' => '8801854969657',
                'sms' => 'Hello!',
                'unicode' => 1,
            ],
        ]);
    }

    public function getPdf(): \Illuminate\Http\Response
    {
        $product = Product::find(1);
        $pdf = \PDF::loadView('welcome', ['product' => $product]);

        return $pdf->download('product.pdf');
    }
}
