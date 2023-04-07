<?php

namespace Api\classProduct;

require_once '/Applications/MAMP/htdocs/boutique-en-ligne/api/database/Database.php';

use Api\classDatabase\Database;;
use datetime;
use PDO;
use PDOException;

class Product extends Database
{

    public function __construct()
    {
        parent::__construct();
        $this->setDatabasePort(8888);
        $this->setDatabaseUsername('root');
        $this->setDatabasePassword('root');

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

}

