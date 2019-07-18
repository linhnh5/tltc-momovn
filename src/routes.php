<?php

Route::get('momovn', function () {
    echo 1223;
});

Route::get('momo/test', 'Tltc\Momovn\Controllers\TestController@requestPayment');