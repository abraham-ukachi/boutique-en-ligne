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

    $delivery = htmlspecialchars($_POST['deliveryChoice'], ENT_QUOTES);
    $address = htmlspecialchars($_POST['address'], ENT_QUOTES);
    $addressComplement = htmlspecialchars($_POST['addressComplement'], ENT_QUOTES);
    $city = htmlspecialchars($_POST['city'], ENT_QUOTES);
    $postalCode = htmlspecialchars($_POST['postalCode'], ENT_QUOTES);
    $country = htmlspecialchars($_POST['country'], ENT_QUOTES);
    $nbCard = htmlspecialchars($_POST['nbCard'], ENT_QUOTES);
    $expiration = htmlspecialchars($_POST['expiration'], ENT_QUOTES);
    $cvv = htmlspecialchars($_POST['cvv'], ENT_QUOTES);

    $checkoutController->registerAllInformations($delivery, $address, $addressComplement, $city, $postalCode, $country, $nbCard, $expiration, $cvv);
    $userId = $this->user->id;
    $checkoutController->getAddressUser($userId);
    echo json_encode($response);


});
