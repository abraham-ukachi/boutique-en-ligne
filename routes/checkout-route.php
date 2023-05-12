<?php

namespace  Maxaboom\Routes;
use Maxaboom\Controllers\CheckoutController;
use Maxaboom\Models\User;

$router->map('GET', '/checkout', function(){
    $checkoutController = new CheckoutController();
    $checkoutController->showCheckoutPage();

});

$router->map('POST', '/checkout', function(){
    $checkoutController = new CheckoutController();

    $address_id = $_POST['id_address'];
    $card_id = $_POST['id_card'];
    $title = $_POST['title'];
    $type = 'mastercard';
    $delivery = $_POST['deliveryChoice'];
    $address = $_POST['address'];
    $address_complement = $_POST['addressComplement'];
    $city = $_POST['city'];
    $postal_code = $_POST['postalCode'];
    $country = $_POST['country'];
    $nb_card = $_POST['nbCard'];
    $expiration = $_POST['expiration'];
    $cvv = $_POST['cvv'];

    $checkoutController->registerAddress($address_id, $title, $address, $address_complement, $postal_code, $city, $country);
    $checkoutController->registerCard($card_id, $type, $nb_card, $expiration, $cvv);

    //$checkoutController->getAddressUser($userId);
    $response = ['success' => true];
    $response['data'] = $_POST;
    echo json_encode($response);


});


