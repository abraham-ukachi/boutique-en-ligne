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

    public function registerCart($product_id,$unit_price, $quantity, $user_id){
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO products (product_id, unit_price, quantity, user_id)
                VALUES (:product_id, :unit_price, :quantity, :user_id)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'product_id' => htmlspecialchars($product_id),
            'unit_price' => htmlspecialchars($unit_price),
            'quantity' => htmlspecialchars($quantity),
            'user_id' => htmlspecialchars($user_id),
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouveau produit enregistré']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }

}