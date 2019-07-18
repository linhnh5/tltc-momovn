<p align="center">
<img src="https://developers.momo.vn/images/logo.png"></p>

## About Tltc/Momovn

Momo is one of favourite payment gateway in Viet Name. This package will help developer 
to connect with it's API easily.


## Install
```sh
composer require tltc/momovn
```
### Required
```sh
"ixudra/curl": "^6.16"
```
## Support
Laravel/ Lumen 5.7.*
## Config
Public config file 
```sh
php artisan vendor:publish --tag=config
```
Config value including
```sh
PARTNER_CODE: partner code of Momo Account
SECRET_KEY: Key using to generate signature
ACCESS_KEY: Key using to authen when call API
API_END_POINT: api route (/gw_payment/transactionProcessor)
DOMAIN: Momo url - change it to sandbox url in local/develop env
```
## Use it
Add this line to provider list in config/app.php
```sh
\Tltc\Momovn\Providers\MomovnServiceProvider::class,
```
## Example code
```sh
        $momoService = new MomovnService();
        $orderId = 'M'.rand(1, 20000);
        $amount = (string)rand(1000000, 2000000);
        $orderInfo = "Momo API testing";
        $requestId = 'M'.rand(1,200000);
        $returnUrl = route('home');
        $notifyUrl = route('home');
        $extraData = "merchantName=;merchantId=";
        $response = $momoService->requestMomoPayment($requestId, $amount, $orderId, $orderInfo, $returnUrl, $notifyUrl, $extraData);
        if ($response && !empty($response->payUrl)) {
            return redirect($response->payUrl); // Redirect to Momo payment
        } else {
            dd($response); // Check error code in Momo document
        }
```

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
