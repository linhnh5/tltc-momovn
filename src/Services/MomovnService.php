<?php

namespace Tltc\Momovn\Services;


use Ixudra\Curl\Facades\Curl;

class MomovnService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('momovn');
    }

    /**
     * @param $requestId
     * @param $amount
     * @param $orderId
     * @param $orderInfo
     * @param $returnUrl
     * @param $notifyUrl
     * @param string $extraData
     * @return
     */
    public function requestMomoPayment($requestId, $amount, $orderId, $orderInfo, $returnUrl, $notifyUrl, $extraData = '')
    {
        $rawData =
            [
                'partnerCode' => $this->config['PARTNER_CODE'],
                'accessKey' => $this->config['ACCESS_KEY'],
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyUrl,
                'extraData' => $extraData,
            ];
        $partnerCode = $this->config['PARTNER_CODE'];
        $accessKey = $this->config['ACCESS_KEY'];
        $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$returnUrl&notifyUrl=$notifyUrl&extraData=$extraData";
        $signature = $this->generateSignature($rawHash);
        $rawData['requestType'] = 'captureMoMoWallet';
        $rawData['signature'] = $signature;

        $momoApi = $this->config['DOMAIN'] . $this->config['API_END_POINT'];
        $response = Curl::to($momoApi)
            ->withContentType('application/json; charset=UTF-8')
            ->withData(json_encode($rawData))
            ->post();
        if ($response) {
            return json_decode($response);
        }
        return false;
    }

    protected function generateSignature($data)
    {
        return hash_hmac('sha256', $data, $this->config['SECRET_KEY']);
    }
}