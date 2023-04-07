<?php

namespace Api\classProduct;

use datetime;
use PDO;
use PDOException;

class Product
{

    private PDO $db;

    public function __construct()
    {
        $db_dsn = 'mysql:host=localhost; dbname=db_maxaboom';
        $username = 'root';
        strpos($_SERVER['HTTP_USER_AGENT'], 'Macintosh') !== false ? $password_db = 'root' : $password_db = '';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $this->db = new PDO($db_dsn, $username, $password_db, $options);
        } catch (PDOException $e) {
            print 'Erreur! :' . $e->getMessage() . '</br>';
            die();
        }
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

}

