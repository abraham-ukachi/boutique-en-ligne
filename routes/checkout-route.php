<?php

namespace  Maxaboom\Routes;
use Maxaboom\Controllers\CheckoutController;

$router->map('GET', '/checkout', function(){
    $checkoutController = new CheckoutController();
    $checkoutController->showCheckoutPage();
});

$router->map('POST', '/checkout', function(){
    $checkoutController = new CheckoutController();

    $response = ['success' => true];
    $response['data'] = $_POST;
    var_dump($response['data']);
    $delivery = $_POST['deliveryChoice'];
    $address = $_POST['address'];
    $addressComplement = $_POST['addressComplement'];
    $city = $_POST['city'];
    $postalCode = $_POST['postalCode'];
    $country = $_POST['country'];
    $nbCard = $_POST['nbCard'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];

    $checkoutController->registerAllInformations($delivery, $address, $addressComplement, $city, $postalCode, $country, $nbCard, $expiration, $cvv);

    echo json_encode($response);


});
