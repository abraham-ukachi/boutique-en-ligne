<?php


require_once __DIR__ . "/../helpers/Database.php";
require_once __DIR__ . "/../Cart.php";

use Maxaboom\Models\Cart;
 
$cart = new Cart();
echo $cartQUantity = $cart->getQuantity(11, 3);