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
* @project boutique-en-ligne (maxaboom)
* @name Cart - Model
* @test test/cart.php
* @file Cart.php
* @author: Morgane Marechal <morgane.marechal@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Axel Vair <axel.vair@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Get all products in cart
*    -|>
*    -|> 
*/


// declare a namespace for this `Cart` model class
namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;



/**
 * Cart model class
 */
class Cart extends Database {

  /**
   * Cart constructor
   */
  public function __construct() {
    parent::__construct();
    // $this->setDatabasePort(8888);
    // $this->setDatabaseUsername('root');
    // $this->setDatabasePassword('root');

    // connect to the database
    $this->dbConnect();

    // Initialize the `cart` session variable,
    // by calling the `initSession()` method
    $this->initSession();

  }


  // PUBLIC SETTERS

  /**
   * Sets or updates the session cart
   *
   * @param array $cart - the cart to set
   * @return void
   */
  public function setSessionCart(array $cart): void {
    $_SESSION['cart'] = $cart;
  }



  // PUBLIC GETTERS

  /**
   * Returns the session cart
   *
   * @return array - the value of the `cart` session variable
   */
  public function getSessionCart(): array {
    return $_SESSION['cart'];
  }

  // PUBLIC METHODS


  /**
   * Add a product to the cart
   *
   * @param int $product_id - the product id
   * @param int $user_id - the user id
   *
   * @return bool - true if the product was added, false otherwise
   */
  public function addProduct(int $product_id, int $user_id): bool {
    // initialize the `result` variable
    $result = false;

    // check if the product is already in the cart
    $isProductInCart = $this->checkProduct($product_id, $user_id);

    if ($isProductInCart) {
      // if the product is already in the cart, update the quantity
      $result = $this->addProductQuantity($product_id, $user_id);
    } else {
      // if the product is not in the cart, add it
      $result = $this->addProductToCart($product_id, 0, 1, $user_id);
    }

    // return the result
    return $result; 
  }


  /**
   * Method used to add the given `product_id` to the session cart
   * NOTE: This method will increase the quantity of the product if it is already in the session cart
   *
   * @param int $product_id - the product id
   *
   * @return int - the quantity of the product
   */
  public function addProductToSession(int $product_id): int {
    // initialize the `quantity` variable
    $quantity = 0;
    
    // check if the product with `product_id` is already in the session cart
    $isProductInSessionCart = isset($_SESSION['cart'][$product_id]);

    // if the product is already in the session cart...
    if ($isProductInSessionCart) {
      // ...increase the quantity
      $quantity = $this->increaseSessionQuantity($product_id);

    } else { // <- if the product is not in the session cart...
      // ...add it !
      $quantity = $_SESSION['cart'][$product_id] = 1;
    }

    // return the `quantity` of the product
    return $quantity;
  }


  /**
   * Increases the quantity of the product with the given `product_id` in the session cart
   *
   * @param int $product_id - the product id
   * @param int $increment - the quantity increment
   *
   * @return int - the quantity of the product
   */
  public function increaseSessionQuantity(int $product_id, int $increment = 1): int {
    // initialize the `quantity` variable
    $quantity = -1;
    
    // check if the product with `product_id` is already in the session cart
    $isProductInSessionCart = isset($_SESSION['cart'][$product_id]);

    // if the product is in the session cart...
    if ($isProductInSessionCart) {
      // ...increase the quantity by the given `increment`
      $_SESSION['cart'][$product_id] += $increment;
      // update the `quantity` variable
      $quantity = $_SESSION['cart'][$product_id];
      
    }

    // return the `quantity` of the product
    return $quantity;
  }



  /**
   * Decrease the quantity of the product with the given `product_id` in the session cart
   *
   * @param int $product_id - the product id
   * @param int $decrement - the quantity decrement
   *
   * @return int - the quantity of the product
   */
  public function decreaseSessionQuantity(int $product_id, int $decrement = 1): int {
    // initialize the `quantity` variable
    $quantity = -1;
    
    // check if the product with `product_id` is already in the session cart
    $isProductInSessionCart = isset($_SESSION['cart'][$product_id]);

    // if the product is in the session cart...
    if ($isProductInSessionCart) {
      // ...decrease the quantity by the given `decrement`
      $_SESSION['cart'][$product_id] -= $decrement;
      // update the `quantity` variable
      $quantity = $_SESSION['cart'][$product_id];
    }

    // return the `quantity` of the product
    return $quantity;
  }



  //for add in product in shopping-cart
  public function addProductToCart($product_id,$unit_price, $quantity, $user_id){
      $sqlAddProduct = "INSERT INTO cart (product_id, unit_price, quantity, user_id)
              VALUES (:product_id, :unit_price, :quantity, :user_id)";

      $sql_exe = $this->db->prepare($sqlAddProduct);
      $sql_exe->execute([
          'product_id' => $product_id,
          'unit_price' => htmlspecialchars($unit_price),
          'quantity' => htmlspecialchars($quantity),
          'user_id' => htmlspecialchars($user_id)
      ]);         
      if ($sql_exe) {
        // echo json_encode(['response' => 'ok', 'reussite' => 'Nouveau produit enregistré']);
        return true;
      } else {
        // echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        return false;
      }
  }

    public function addProductQuantity($user_id, $product_id){
        $newQuantity = $this->getQuantity($user_id, $product_id);
        $newQuantity = $newQuantity + 1;
        $sqlUpdateQuantity = "UPDATE cart SET quantity = '$newQuantity' WHERE user_id = :user_id and product_id = :product_id ";
        $addProduct = $this->db->prepare($sqlUpdateQuantity);
        return $addProduct->execute([
            'product_id' => $product_id,
            'user_id' => htmlspecialchars($user_id)
        ]);       
    }





  /**
   * Increases the quantity of the product with the given `product_id` in the cart
   *
   * @param int $user_id - the user id 
   * @param int $product_id - the product id
   * @param int $increment - the quantity increment
   *
   * @return int - the quantity of the product, or -1 if the product is not in the cart
   */
  public function increaseQuantity(int $user_id, int $product_id, int $increment = 1): int {
    // initialize the `quantity` variable
    $quantity = -1;
    
    // check if the product with `product_id` is already in the cart
    $isProductInCart = $this->checkProduct($user_id, $product_id);

    // if the product is in the cart...
    if ($isProductInCart) {
      // ...get the current quantity as `current_quantity`
      $current_quantity = $this->getQuantity($user_id, $product_id);
      // increase the quantity by the given `increment`
      $new_quantity = $current_quantity + $increment;
      
      // Create a `increase_quantity_query` variable
      $increase_quantity_query = "
        UPDATE cart 
        SET quantity = '$new_quantity' 
        WHERE 
          user_id = :user_id 
          AND 
          product_id = :product_id 
      ";
      
      // prepare our query as a PDO statement
      $pdo_stmt = $this->db->prepare($increase_quantity_query);
      // execute our pdo statement
      $qtyIncreased = $pdo_stmt->execute([
        'user_id' => $user_id,
        'product_id' => $product_id
      ]);

      // if the quantity was increased...
      if ($qtyIncreased) {
        // ...update the `quantity` variable
        $quantity = $new_quantity;
      }

    }

    // return the `quantity` of the product
    return $quantity;
  }




  /**
   * Decreases the quantity of the product with the given `product_id` in the cart
   *
   * @param int $user_id - the user id 
   * @param int $product_id - the product id
   * @param int $decrement - the quantity decrement
   *
   * @return int - the quantity of the product, or -1 if the product is not in the cart
   */
  public function decreaseQuantity(int $user_id, int $product_id, int $decrement = 1): int {
    // initialize the `quantity` variable
    $quantity = -1;
    
    // check if the product with `product_id` is already in the cart
    $isProductInCart = $this->checkProduct($user_id, $product_id);

    // if the product is in the cart...
    if ($isProductInCart) {
      // ...get the current quantity as `current_quantity`
      $current_quantity = $this->getQuantity($user_id, $product_id);
      // decrease the quantity by the given `decrement`
      $new_quantity = $current_quantity - $decrement;
      
      // Create a `decrease_quantity_query` variable
      $decrease_quantity_query = "
        UPDATE cart 
        SET quantity = '$new_quantity' 
        WHERE 
          user_id = :user_id 
          AND 
          product_id = :product_id 
      ";
      
      // prepare our query as a PDO statement
      $pdo_stmt = $this->db->prepare($decrease_quantity_query);
      // execute our pdo statement
      $qtyDecreased = $pdo_stmt->execute([
        'user_id' => $user_id,
        'product_id' => $product_id
      ]);

      // if the quantity was decreased...
      if ($qtyDecreased) {
        // ...update the `quantity` variable
        $quantity = $new_quantity;
      }

    }

    // return the `quantity` of the product
    return $quantity;
  }





    public function reduceQuantity($user_id, $product_id){
        $newQuantity = $this->getQuantity($user_id, $product_id);
        $newQuantity = $newQuantity - 1;
        $sqlUpdateQuantity = "UPDATE cart SET quantity = '$newQuantity' WHERE user_id = :user_id and product_id = :product_id ";
        $reduceProduct = $this->db->prepare($sqlUpdateQuantity);
        return $reduceProduct->execute([
            'product_id' => $product_id,
            'user_id' => htmlspecialchars($user_id)
        ]);       
    }

    public function getQuantity($user_id, $product_id){
        $sql = "SELECT quantity FROM cart WHERE user_id = :user_id and product_id = :product_id";
        $addQuantity = $this->db->prepare($sql);
        $addQuantity->execute([
            'user_id' => htmlspecialchars($user_id),
            'product_id' => $product_id
        ]);
        $result = $addQuantity->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);
        //echo "user_id => $user_id ::::: product_id => $product_id"; 
        return $result['quantity']; 
    }

    public function displayProductFromCart($user_id){
        $sql="SELECT products.name, products.price, products.id, products.image, cart.quantity, cart.user_id from products INNER JOIN cart on products.id = cart.product_id AND cart.user_id = $user_id";
        $getProducts = $this->db->prepare($sql);
        $getProducts->execute([
        ]);
        $result = $getProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;        
    }


    /**
     * Returns all the user's products from his/her cart
     *
     * @param int $user_id - the user id
     * @param int $start - the start index
     * @param int $limit - the limit
     *
     * @return array - the products
     */
    public function getAll(int $user_id, int $start = 0, int $limit = 10): array {
      $sql="
        SELECT products.*, cart.quantity 
        FROM products 
        INNER JOIN cart 
        ON products.id = cart.product_id 
        WHERE cart.user_id = :user_id
        LIMIT :start, :limit";

      // prepare the sql query
      $pdo_stmt = $this->db->prepare($sql);
      // execute the sql pdo statement
      $pdo_stmt->execute([
        'user_id' => $user_id,
        'start' => $start,
        'limit' => $limit
      ]);
      
      // fetch all the products
      $products = $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);

      // return the products
      return $products;        
    }

    
  /**
   * Returns all the products from the cart in session
   *
   * @param int $start - the start index
   * @param int $limit - the limit
   *
   * @return array - the products
   */
  public function getAllFromSession(int $start = 0, int $limit = -1): array {
    // get a list of products in session as `$sessionProducts`
    $sessionProducts = isset($_SESSION['cart']) ? $_SESSION['cart']: [];
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    // print_r($sessionProducts);
    
    // Get a products list from the session products
    $productsIds = (count($sessionProducts) > 0) ? array_keys($sessionProducts) : [-1];

    // DEBUG [4dbsmaster]: tell me about it ;)
    // echo sprintf("<h3>Product Ids:</h3> <pre>%s</pre>", json_encode($productsIds));

    // Selecting all products from the database where the id is in `$productsList` w/ the specified limits...
    
    // create a `get_all_session_products_query` variable
    $get_all_session_products_query = sprintf(<<<SQL
      SELECT * FROM products 
      WHERE id IN %s
      LIMIT :start, :limit
      SQL,

      "(" . implode(',', $productsIds) . ")"
     );

    // $sql = "SELECT * FROM `products` WHERE id IN (" . implode(',', $productsList) . ")";

    // DEBUG [4dbsmaster]: tell me about it ;)
    // echo $get_all_session_products_query;

    
    // prepare our query as a pdo statement
    $pdo_stmt = $this->db->prepare($get_all_session_products_query);
    $pdo_stmt->execute([
      'start' => $start,
      'limit' => $limit
    ]);
    
    // fetch all the products
    $products = $pdo_stmt->fetchAll(PDO::FETCH_ASSOC);

    // map the products to add the quantity
    $products = array_map(function($product) use ($sessionProducts) {
      $product['quantity'] = $sessionProducts[$product['id']];
      return $product;
    }, $products);
    
    // return the products
    return $products;
  }


  public function totalPriceByUser($user_id){
    $sql="SELECT SUM(cart.quantity*products.price) as TOTAL FROM cart, products WHERE products.id=cart.product_id AND cart.user_id = $user_id";
    $totalPrice = $this->db->prepare($sql);
    $totalPrice->execute([
    ]);
    $result = $totalPrice->fetchAll(PDO::FETCH_ASSOC);
    return $result[0]['TOTAL']; 
  }


  /**
   * Returns the total price of the products in the cart in session
   *
   * @return int - the total price
   */
  public function totalPriceFromSession(): int {
    // initialize the `total` variable
    $total = 0;

    // get all the products from session as `$products`
    $products = $this->getAllFromSession();
    
    // get the cart from session as `$sessionCart`
    $sessionCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // DEBUG [4dbsmaster]: tell me about it ;)
    // print_r($products);
    // print_r($sessionCart);

    // IDEA: Loop through the products, and for each product, 
    // add the price - multiplied by its corresponding quantity - to the total
    
    // loop through the products
    foreach ($products as $product) {
      // ...get the product id as `$productId`
      $productId = $product['id'];
      // get the product price as `$productPrice`
      $productPrice = $product['price'];
      // get the product quantity as `$productQuantity`
      $productQuantity = $sessionCart[$productId];

      
      // add the price - multiplied by its corresponding quantity - to the total
      $total += $productPrice * $productQuantity;    

    }

  
    // return `$total`
    return $total;
  }


    public function checkProduct($user_id, $product_id){
        $sql = "SELECT * FROM cart WHERE user_id = :user_id and product_id = :product_id";
        $checkProduct = $this->db->prepare($sql);
        $checkProduct->execute([
            'product_id' => $product_id,
            'user_id' => htmlspecialchars($user_id)
        ]);
        $results = $checkProduct->fetch(PDO::FETCH_ASSOC);
        if ($results) {
            return true;
        } else {
            return false;
        } 

    }

    public function deleteProduct($product_id, $user_id){
        $sql="DELETE FROM cart WHERE user_id = :user_id and product_id = :product_id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'user_id' => $user_id,
            'product_id' => $product_id
        ]);         
        if ($sql_exe) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes or removes a product from the session cart
     *
     * @param int $product_id - the product id
     *
     * @return bool - Returns TRUE if the product was deleted, FALSE otherwise
     */
    public function deleteProductFromSession($product_id): bool {
      // get the cart from session as `$sessionCart`
      $sessionCart = $this->getSessionCart();

      // DEBUG [4dbsmaster]: tell me about it ;)
      // print_r($sessionCart);

      // If the product exists in the session cart...
      if (isset($sessionCart[$product_id])) {
        // ...remove the product from the session cart
        unset($sessionCart[$product_id]);
        // set the session cart to the new session cart
        $this->setSessionCart($sessionCart);
        // return true
        return true;
      } else {
        // return false
        return false;
      }
    }



  /**
   * Returns the number of products in the cart
   *
   * @param int $user_id - the user id
   *
   * @return int - the number of products
   */
  public function countAll(int $user_id): int {
      $sql = "SELECT COUNT(*) FROM cart WHERE user_id = :user_id";
      $countAll = $this->db->prepare($sql);
      $countAll->execute([
          'user_id' => htmlspecialchars($user_id)
      ]);
      $result = $countAll->fetch(PDO::FETCH_ASSOC);
      return $result['COUNT(*)']; 
  }


  /**
   * Returns the number of products from the cart in session
   *
   * @return int - the number of products
   */
  public function countAllFromSession(): int {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
  }



  // PRIVATE SETTERS
  // PRIVATE GETTERS
  // PRIVATE METHODS


  /**
   * Initializes the session
   * NOTE: This method creates a `cart` key in the session if it doesn't exist
   *
   * @return void
   */
  private function initSession() {
    if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
    }
  }

}
