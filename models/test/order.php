<?php


namespace Maxaboom\Models\Test;


include "../helpers/Database.php";
include "../Order.php";
include "../User.php";
include "../Product.php";


use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Order;
use Maxaboom\Models\User;
use Maxaboom\Models\Product;


// use Maxaboom\Models;
// use Maxaboom\Models\Helpers;


/*
 * Code from JavaScript
 *
 * let orderData = {}
 *
 * orderData.userInfo = {
 *  firstName: 'Axel',
 *  lastName: 'Riav',
 *  ...
 * };
 *
 * orderData.address = {
 *  delivery: {address1: '71 Boulevard de Paris', address2: '', ...},
 *  payment: {...}
 * };
 *
 * orderData.cardInfo {
 *   cardNumber: 83082827421114,
 *   expiryDate: {month: '03', year: '27'},
 *   cvv: '233'
 * };
 *
 * orderData.products = [
 *   {productId: 12, quantity: 2}
 *   {productId: 13, quantity: 1}
 *   {productId: 14, quantity: 5}
 * ];
 *
 *  fetch('product.php?guest', {
 *      ...
 *      body: JSON.stringify(orderData)
 * });
 */

$product = new Product();
$order = new Order($product);
$user = new User();

// $userId = $_GET['userId'];
$isGuest = isset($_GET['guest']);

$orderData = Array();

$orderData['totalPrice'] = 300;

$orderData['userInfo'] = ['firstName' => 'Axel', 'lastName' => 'Riav', 'email' => 'axel.riav@laplateforme.io'];
$orderData['address'] = Array();
$orderData['address']['delivery'] = ['address1' => '71 bd de paris'];
$orderData['address']['payment'] = ['address1' => '71 bd de paris'];

$orderData['cardInfo'] = array();
$orderData['cardInfo']['number']  = ['cardNumber' => '83082827421114'];
$orderData['cardInfo']['expiry']  = ['month' => '03', 'year' => '27'];
$orderData['cardInfo']['securityCode']  = ['cvv' => '233'];

$orderData['products'] = array();
$orderData['products'][0] = ['productId' => '12', 'quantity' => '2'];
$orderData['products'][1] = ['productId' => '13', 'quantity' => '1'];
$orderData['products'][2] = ['productId' => '14', 'quantity' => '5'];

// Tell us about it order data stuff ;)
// print_r($orderData);


// for each table in `orderData`...
foreach ($orderData as $table){
    // ...print the table
    print_r($table);
}


$userId = -1;


if ($isGuest) {
    $firstName = $orderData['userInfo']['firstName'];
    $lastName = $orderData['userInfo']['lastName'];
    $email = $orderData['userInfo']['email'];

    $user->registerGuest($firstName, $lastName, $email);
    $userId = 5; // $user->getLastGuestId(); // <- returns eg. 23

}

$response = $order->createOrder($userId, $orderData);

print_r($response);
