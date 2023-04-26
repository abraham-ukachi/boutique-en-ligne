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
        return $this->cartModel->displayProductFromCart($user_id);
       //require_once __DIR__ . '/../models/test/cart.php';
    }

    public function totalPrice($user_id){
        return $this->cartModel->totalPriceByUser($user_id);
    }

    public function showPage($user_id){
        $displayCart = $this->infoCart($user_id);
        $total = $this->totalPrice($user_id);
    
        require_once __DIR__ . '/../views/cart-page.php';

    }

    public function increaseQuantity($product_id){
      $isUserConnected = $this->userModel->isConnected();

      $user_id = null;
      $success = false;

      
      if ($isUserConnected) {
          $user_id = $this->userModel->id;
        //   $success = true;
        $success = $this->cartModel->addProductQuantity($user_id, $product_id);
      }
      return Array('success' => $success, 'data' => $user_id);
    }

    public function reduceQuantity($product_id){
        $isUserConnected = $this->userModel->isConnected();
  
        $user_id = null;
        $success = false;
        
        if ($isUserConnected) {
            $user_id = $this->userModel->id;
          //   $success = true;
          $success = $this->cartModel->reduceQuantity($user_id, $product_id);
  
        }       
        return Array('success' => $success, 'data' => $user_id);
      }

}