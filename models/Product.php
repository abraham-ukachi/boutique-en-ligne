<?php

namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;

class Product extends Database
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

    /**
     * Returns a product with the given `productId`
     *
     * @param int $productId id of the product
     * @return array $productData
     */
    public function getProductById(int $productId): array {
        $productData = [];

        try {

            $query = "SELECT * FROM `products` WHERE id = '$productId'";
            $pdo_stmt = $this->db->query($query, PDO::FETCH_ASSOC);

            $result = $pdo_stmt->fetch();

            // update the product data
            $productData = $result;

        } catch (PDOException $e) {
            // TODO: handle the exception
        }

        return $productData;
    }

    public function getAllProducts(){
        $allProducts = $this->db->prepare("SELECT * FROM products");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function productsCategories(int $idCategorie){
        $productsCategories = $this->db->prepare("SELECT * FROM products WHERE categories_id=$idCategorie");
        $productsCategories->execute([
        ]);
        $result = $productsCategories->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function subCategorie(int $idsubCategorie){
        $subCategorie = $this->db->prepare("SELECT * FROM products WHERE sub_categories_id=$idsubCategorie");
        $subCategorie->execute([]);
        $result = $subCategorie->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }



    public function registerProduct($name,$description, $price, $categories_id, $sub_categories_id, $stock){
        $created_at = date('Y-m-d h:i:s');
        $sql = "INSERT INTO products (name, description, price, categories_id,
        sub_categories_id, created_at, stock)
                VALUES (:name, :description, :price, :categories_id, :sub_categories_id, :created_at, :stock)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'name' => htmlspecialchars($name),
            'description' => htmlspecialchars($description),
            'price' => htmlspecialchars($price),
            'categories_id' => htmlspecialchars($categories_id),
            'sub_categories_id' => htmlspecialchars($sub_categories_id),
            'created_at' => $created_at,
            'stock' => htmlspecialchars($stock)
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouveau produit enregistré']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }

    //get last id in DB for image name
    public function getLastId(){
            $getLastId = $this->db->prepare("SELECT MAX(id) FROM `products`");
            $getLastId->execute([
            ]);
            $result = $getLastId->fetchAll(PDO::FETCH_ASSOC);
            return $result[0]['MAX(id)'];        
    }

    //ADD image name with ID of the product inside
    function updateImageProduct($lastProductId){
        $sqlupdate = $this -> db -> prepare("UPDATE products SET image = 'img_$lastProductId.png' WHERE id = :id ");
        $sqlupdate->execute([
            'id' => $lastProductId,
        ]);
    }

    
    function getProductByDate(){
        $allProducts = $this->db->prepare("SELECT * FROM products ORDER BY created_at DESC");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getProductHigherPrice(){
        $allProducts = $this->db->prepare("SELECT * FROM products ORDER BY price DESC");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getProductLowerPrice(){
        $allProducts = $this->db->prepare("SELECT * FROM products ORDER BY price ASC");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}

