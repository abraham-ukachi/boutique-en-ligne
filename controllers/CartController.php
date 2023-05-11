<?php
/**
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
* All rights reserved.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project boutique-en-ligne
* @name Home - Controller 
* @file HomeController.php
* @author: Morgane Marechal <morgane.marechal@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Abraham Ukachi <abraham.ukachi@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> //
*    -|> 
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare a namespace to avoid collisions
namespace Maxaboom\Controllers;

// using our models... ;)
use Maxaboom\Models\Product;
use Maxaboom\Models\User;
use Maxaboom\Models\Cart;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;








// Declare a class that represents the `Cart` controller,
// which is a child of the `Controller` class
class CartController extends Controller {
    // Using some traists (a.k.a. step parents) in this class
    use ResponseHandler;

    // Define some constants...

    const CART_PRODUCTS_LIMIT = 10; 
    
    public Product $product;
    public User $user;
    public Cart $cart;











    /**
     * Constructor of the class
     * This method is executed automatically whenever this class is instantiated
     *
     * @param ?string $theme : the theme to use
     * @param ?string $lang : the language to use
     * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
     */
    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
      // call the parent's constructor
      parent::__construct($theme, $lang, $useDefaultBrowserLang);

      $this->product = new Product();
      $this->user = new User();
      $this->cart = new Cart();
    }
    

    // PUBLIC SETTERS
    // PUBLIC GETTERS
    // PUBLIC METHODS



    /**
     * Method used to add the product with the given `productId` to the cart
     * NOTE 1: If the user is not connected, the product will be added to `cart` session variable
     * NOTE 2: If the user is connected, the product will be added to the database
     *
     * @param int $productId : the id of the product to add to the cart
     *
     * @return array : an array containing the success status, message and the `user_id` & `user_connected` in data.
     */
    public function addToCart($product_id) {
      // TODO: check if the product exists

      // check if the user is connected
      $isUserConnected = $this->user->isConnected();
      
      $user_id = null;
      $success = false;

      // if the user is connected...
      if ($isUserConnected) {
        // ...get the user id
        $user_id = $this->user->id;

        // add the product to the cart
        // TODO: `addProduct()` should return the quantity of the product in the cart
        $success = $this->cart->addProduct($product_id, $user_id);
        
        // get the total price
        $totalPrice = $this->cart->totalPriceByUser($user_id);

        // set the response success
        $this->setResponseSuccess($success);
        // set the response status
        $this->setResponseStatus($success ? self::$STATUS_SUCCESS_CREATED : self::$STATUS_ERROR_INTERNAL_ERROR);
        // update the response message
        $this->setResponseMessage($success ? $this->i18n->getString('productAddedToYourCart') : $this->i18n->getString('failedToAddProductToYourCart'));
    

      } else { // <- user is not connected :(
        
        // add the product to the session cart
        $quantity = $this->cart->addProductToSession($product_id);        

        // set the response success to `true`
        $success = $quantity > 0 ? true : false;

        // get the total price from session
        $totalPrice = $this->cart->totalPriceFromSession();

        // set the response success
        $this->setResponseSuccess($success);
        // set the response status
        $this->setResponseStatus($success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_INTERNAL_ERROR);
        // set the response message
        $this->setResponseMessage($success ? $this->i18n->getString('productAddedToCart') : $this->i18n->getString('failedToAddProductToCart'));

      }


      // set the response data to the user id
      $this->setResponseData([
        'user_id' => $user_id, 
        'user_connected' => $isUserConnected,
        'product_id' => $product_id,
        'cart_total' => $this->getCartProductsTotal(),
        'total_price' => number_format($totalPrice / 100, 2) . '€'
      ]);

      // return our response
      return $this->getResponse();

      // return the success status, message and the user id (in data)
      // return Array('success' => $success, 'data' => [ 'user_id' => $user_id ]);
    }



    /**
     * Method used to remove the product with the given `productId` from the cart
     * NOTE 1: If the user is not connected, the product will be removed from the `cart` session variable
     * NOTE 2: If the user is connected, the product will be removed from his/her cart in the database
     *
     * @param int $productId : the id of the product to remove from the cart
     *
     * @return array : an array containing the success status, message and the `user_id` & `user_connected` in data.
     */
    public function removeFromCart($product_id) {
      // TODO: check if the product exists

      // check if the user is connected
      $isUserConnected = $this->user->isConnected();

      // Initialize the `user_id` & `success` variables 
      $user_id = null;
      $success = false;
      

      // if the user is connected...
      if ($isUserConnected) {
        // ...get the user id
        $user_id = $this->user->id;

        // remove the product from the cart,
        // and get the `success` result
        // TODO: Rename `deleteProduct` to `removeProduct`
        $success = $this->cart->deleteProduct($product_id, $user_id);

        // get the total price 
        $totalPrice = $this->cart->totalPriceByUser($user_id);

        // set the response success
        $this->setResponseSuccess($success);
        // set the response status
        $this->setResponseStatus($success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_UNPROCESSABLE_ENTITY);
        // set the response message
        $this->setResponseMessage($success ? $this->i18n->getString('productRemovedFromYourCart') : $this->i18n->getString('failedToRemoveProductFromYourCart'));


      } else { // <- user is not connected :(
        
        // remove the product from the session cart
        $success = $this->cart->deleteProductFromSession($product_id);
        
        // get the total price from session
        $totalPrice = $this->cart->totalPriceFromSession();

        // set the response success
        $this->setResponseSuccess($success);
        // set the response status
        $this->setResponseStatus($success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_NOT_FOUND);
        // set the response message
        $this->setResponseMessage($success ? $this->i18n->getString('productRemovedFromCart') : $this->i18n->getString('failedToRemoveProductFromCart'));

      }

      // set the response data to the user id
      $this->setResponseData([
        'user_id' => $user_id,
        'user_connected' => $isUserConnected,
        'product_id' => $product_id,
        'cart_total' => $this->getCartProductsTotal(),
        'total_price' => number_format($totalPrice / 100, 2) . '€'
      ]);

      // return our response
      return $this->getResponse();

      // return the success status, message and the user id (in data)
      // return Array('success' => $success, 'data' => [ 'user_id' => $user_id ]);
    }



  /**
   * Method used to get a list of products from the cart or session
   *
   * @param int $start : the start index
   * @param int $limit : the limit of products to get
   *
   * @return array : an array containing the list of products
   */
  public function getProducts(int $start, int $limit): array {
    // Initialize the `products` array variable
    $products = [];
    
    // If the user is connected...
    if ($this->user->isConnected()) {
      // ...get the user id
      $user_id = $this->user->id;

      // ...get the products from the database
      $products = $this->cart->getAll($user_id, $start, $limit);

    } else { // <- user is not connected :(
      // ...get the products from the session
      $products = $this->cart->getAllFromSession($start, $limit);
    }

    // return `products` array
    return $products;
  }


  /**
   * Shows the cart page
   *
   * @return void
   */
  public function showPage(): void {
    // TODO: do something awesome here before showing the home page ;)
    
    // Initialize some variables
    $products = [];
    $totalProducts = 0;
    $totalPrice = 0;

    // get the user id as `$userId`
    $userId = $this->user->id;

    // check if the user is connected
    $isUserConnected = $this->user->isConnected();


    // TODO: Use our beloved ternary statement to clean up the mess below ;)

    // if the user is connected ...
    if ($isUserConnected) {
      // ...get a limited list of the user's products in cart as `$products`
      $products = $this->cart->getAll($userId, 0, $this::CART_PRODUCTS_LIMIT);
      
      // get the total number of products in the cart as `$totalProducts` 
      $totalProducts = $this->cart->countAll($userId);
      
      // get the total price 
      $totalPrice = $this->cart->totalPriceByUser($userId);
      
    }else { // <- user is not connected
      // ...get a limited list of the user's products from the `cart` session variable as `$products`
      $products = $this->cart->getAllFromSession(0, $this::CART_PRODUCTS_LIMIT);

      // get the total number of products from the `cart` session variable as `$totalProducts`
      $totalProducts = $this->cart->countAllFromSession();

      // get the total price from the `cart` session variable as `$totalPrice`
      $totalPrice = $this->cart->totalPriceFromSession();
    } 
    
    // require [once] the home page from the `views` folder
    require_once __DIR__ . '/../views/cart-page.php';
  }





    /**
     * Method used to get the total number of the cart products
     * NOTE: If the user is connected, the total will be retrieved from the database
     * NOTE: If the user is not connected, the total will be retrieved from the `cart` session variable
     *
     * @return int : the total number of the cart products
     */
    public function getCartProductsTotal() {
      // return $this->user->isConnected() ? $this->cart->countAll($this->user->id) : count($_SESSION['cart']);
      return $this->user->isConnected() ? $this->cart->countAll($this->user->id) : $this->cart->countAllFromSession();
    } 



    public function registerCart($product_id,$unit_price, $quantity, $user_id){
        $success = $this->cart->addProductToCart($product_id,$unit_price, $quantity, $user_id);
    }

    public function infoCart($user_id){
        return $this->cart->displayProductFromCart($user_id);
       //require_once __DIR__ . '/../models/test/cart.php';
    }

    public function totalPrice($user_id){
        return $this->cart->totalPriceByUser($user_id);
    }




  /*
    public function showPage($user_id){
        $displayCart = $this->infoCart($user_id);
        $total = $this->totalPrice($user_id);
    
        require_once __DIR__ . '/../views/cart-page.php';

    }
   */


    public function increaseQuantity($product_id){
      $isUserConnected = $this->user->isConnected();

      $user_id = null;
      $success = false;

      
      if ($isUserConnected) {
          $user_id = $this->user->id;

        //   $success = true;
        $success = $this->cart->addProductQuantity($user_id, $product_id);
        $total = $this->totalPrice($user_id);

      }
      return Array('success' => $success, 'data' => $user_id, 'total' => $total);
    }


  /**
   * Method used to increase the quantity of a product in the cart
   * NOTE: If the user is connected, the quantity will be increased from the database
   * NOTE: If the user is not connected, the quantity will be increased from the session 
   *
   * @param int $product_id : the product id
   * @param int $increment : the quantity increment
   *
   * @return array : a response which contains the success status, message, quantity and other data
   */
  public function increaseProductQuantity(int $product_id, int $increment = 1): array {
    // Check if the user is connected as `$isUserConnected`
    $isUserConnected = $this->user->isConnected();

    // Initialize the `user_id` and `success` variables
    $user_id = null;
    $success = false;


    // if the user is connected ...
    if ($isUserConnected) {
      // ...get the user id as `$user_id`
      $user_id = $this->user->id;

      // increase the quantity of the given product in the cart
      $quantity = $this->cart->increaseQuantity($user_id, $product_id, $increment);
      
      // update the `success` variable,
      // NOTE: the action is successful, if the returned quantity is not -1
      $success = $quantity !== -1;

      // get the total price 
      $totalPrice = $this->cart->totalPriceByUser($user_id);
      

    } else { // <- 

      // increase the quantity of the given product in the `cart` session variable
      $quantity = $this->cart->increaseSessionQuantity($product_id, $increment);

      // update the `success` variable,
      // NOTE: the action is successful, if the returned quantity is not -1
      $success = $quantity !== -1;
      
      // get the total price from session
      $totalPrice = $this->cart->totalPriceFromSession();

    }


    // set the response success
    $this->setResponseSuccess($success);
    // set the response status
    $this->setResponseStatus($success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_INTERNAL_ERROR);
    // set the response message
    $this->setResponseMessage($success ? $this->i18n->getString('productQtyIncreased') : $this->i18n->getString('failedToIncreaseProductQty'));


    // set the response data to the user id
    $this->setResponseData([
      'user_id' => $user_id,
      'user_connected' => $isUserConnected,
      'product_id' => $product_id,
      'quantity' => $quantity,
      'cart_total' => $this->getCartProductsTotal(),
      'total_price' => number_format($totalPrice / 100, 2) . '€'
    ]);

    // return our response
    return $this->getResponse();

  }


  /**
   * Method used to decrease the quantity of a product in the cart
   * NOTE: If the user is connected, the quantity will be decreased from the database
   * NOTE: If the user is not connected, the quantity will be decreased from the session
   *
   * @param int $product_id : the product id
   * @param int $decrement : the quantity to decrease
   *
   * @return array : a response which contains the success status, message, quantity and other data
   */
  public function decreaseProductQuantity(int $product_id, int $decrement = 1): array {
    // Check if the user is connected as `$isUserConnected`
    $isUserConnected = $this->user->isConnected();

    // Initialize the `user_id` and `success` variables
    $user_id = null;
    $success = false;


    // if the user is connected ...
    if ($isUserConnected) {
      // ...get the user id as `$user_id`
      $user_id = $this->user->id;

      // decrease the quantity of the given product in the cart
      $quantity = $this->cart->decreaseQuantity($user_id, $product_id, $decrement);
      
      // update the `success` variable,
      // NOTE: the action is successful, if the returned quantity is not -1
      $success = $quantity !== -1;

      // get the total price 
      $totalPrice = $this->cart->totalPriceByUser($user_id);
      

    } else { // <- 

      // decrease the quantity of the given product in the session
      $quantity = $this->cart->decreaseSessionQuantity($product_id, $decrement);

      // update the `success` variable,
      // NOTE: the action is successful, if the returned quantity is not -1
      $success = $quantity !== -1;
      
      // get the total price from session
      $totalPrice = $this->cart->totalPriceFromSession();

    }


    // set the response success
    $this->setResponseSuccess($success);
    // set the response status
    $this->setResponseStatus($success ? self::$STATUS_SUCCESS_OK : self::$STATUS_ERROR_INTERNAL_ERROR);
    // set the response message
    $this->setResponseMessage($success ? $this->i18n->getString('productQtyDecreased') : $this->i18n->getString('failedToDecreaseProductQty'));


    // set the response data to the user id
    $this->setResponseData([
      'user_id' => $user_id,
      'user_connected' => $isUserConnected,
      'product_id' => $product_id,
      'quantity' => $quantity,
      'cart_total' => $this->getCartProductsTotal(),
      'total_price' => number_format($totalPrice / 100, 2) . '€'
    ]);

    // return our response
    return $this->getResponse();

  }
















    public function reduceQuantity($product_id){
        $isUserConnected = $this->user->isConnected();
  
        $user_id = null;
        $success = false;
        
        if ($isUserConnected) {
            $user_id = $this->user->id;
          //   $success = true;
          $success = $this->cart->reduceQuantity($user_id, $product_id);
          $total = $this->totalPrice($user_id);

        }       
        return Array('success' => $success, 'data' => $user_id, 'total' => $total);
      }

}
