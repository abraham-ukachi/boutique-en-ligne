<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Product;
use Maxaboom\Models\Review;
use Maxaboom\Models\User;
use Maxaboom\Models\Cart;
use PDO;

class CartController{


    public object $productModel;
    public object $productCategory;
    public object $userModel;
    public object $cartModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->userModel = new User();
        $this->cartModel = new Cart();
    }


    public function registerCart($product_id,$unit_price, $quantity, $user_id){
        $success = $this->cartModel->addProductToCart($product_id,$unit_price, $quantity, $user_id);
    }

    public function infoCart($user_id){
       $displayCart = $this->cartModel->displayProductFromCard($user_id);
       $total = $this->cartModel->totalPriceByUser($user_id);
       //require_once __DIR__ . '/../models/test/cart.php';

    }

    public function showPage(){
        require_once __DIR__ . '/../views/cart-page.php';

    }

}