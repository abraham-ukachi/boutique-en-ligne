<?php


require_once __DIR__ . "/../helpers/Database.php";
require_once __DIR__ . "/../Cart.php";

use Maxaboom\Models\Cart;

$cart = new Cart();
echo "<br>Check quantity : ".$cartQUantity = $cart->getQuantity(11, 3);
echo "<br>Check OK : ".$checkProduct = $cart->checkProduct(11,3);
echo "<br>Check total price : ".$total = $cart->totalPriceByUser(11)."<br>";
$displayProductUser = $cart->displayProductFromCart(11);
var_dump($displayProductUser);
$addQuantity = $cart->addProductQuantity(11, 3);
$delete = $cart->deleteProduct(13, 27);
$cart->addProductToCart(13,6700, 1, 27);

