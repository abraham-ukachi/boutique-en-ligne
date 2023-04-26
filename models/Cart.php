<?php

namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;

class Cart extends Database
{

    public function __construct()
    {
        parent::__construct();
        // $this->setDatabasePort(8888);
        // $this->setDatabaseUsername('root');
        // $this->setDatabasePassword('root');

        // connect to the database
        $this->dbConnect();
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
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouveau produit enregistré']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
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

    public function totalPriceByUser($user_id){
        $sql="SELECT SUM(cart.quantity*products.price) as TOTAL FROM cart, products WHERE products.id=cart.product_id AND cart.user_id = $user_id";
        $totalPrice = $this->db->prepare($sql);
        $totalPrice->execute([
        ]);
        $result = $totalPrice->fetchAll(PDO::FETCH_ASSOC);
        return $result[0]['TOTAL']; 
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


}