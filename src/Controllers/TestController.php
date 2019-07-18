<?php

namespace Tltc\Momovn\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tltc\Momovn\Services\MomovnService;

class TestController extends Controller
{
    protected $momoService;
    public function __construct(MomovnService $momoService)
    {
        $this->momoService = $momoService;
    }

    public function requestPayment(Request $request)
    {
        $orderId = 'M'.rand(1, 20000);
        $amount = (string)rand(1000000, 2000000);
        $orderInfo = "Momo API testing";
        $requestId = 'M'.rand(1,200000);
        $returnUrl = route('home');
        $notifyUrl = route('home');
        $extraData = "merchantName=;merchantId=";
        $response = $this->momoService->requestMomoPayment($requestId, $amount, $orderId, $orderInfo, $returnUrl, $notifyUrl, $extraData);
        if ($response && !empty($response->payUrl)) {
            return redirect($response->payUrl);
        } else {
            dd($response);
        }
    }
}