<?php

namespace Maxaboom\Routes;
use Maxaboom\Controllers\AddressController;
use Maxaboom\Controllers\CheckoutController;


$router->map('GET', '/address/[i:addressId]', function ($addressId){
    if (!isset($_SERVER['HTTP_CREATOR'])) {
        echo "fuck off!!!";
        die("You are dead!!!");
        return;
    }

    $AddressController = new AddressController();
    $response = $AddressController->getAddressById($addressId);

    echo json_encode($response);
});