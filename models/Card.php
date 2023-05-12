<?php

namespace Maxaboom\Models;
use Maxaboom\Models\Helpers\Database;
use PDO;
use PDOException;

class Card extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->dbConnect();
    }

    public function registerCard($user_id, string $type, $nbCard, $expiration, $cvv)
    {
        $sql = "INSERT INTO cards (user_id, type, card_no, expiry_month, expiry_year, CVV)
                VALUES (:user_id, :type, :card_no, :expiry_month, :expiry_year, :cvv)";
        $sql_exe = $this->db->prepare($sql);
        $expiry_month = (int) explode('/', $expiration)[0];
        $expiry_year = (int) explode('/', $expiration)[1];
        $sql_exe->execute([
            'user_id' => $user_id,
            'type' => $type,
            'card_no' => htmlspecialchars($nbCard),
            'expiry_month' => $expiry_month,
            'expiry_year' => $expiry_year,
            'cvv' => htmlspecialchars($cvv)
        ]);
        if ($sql_exe) {
            return true;
        } else {
            return false;
        }
    }

    public function getCards($user_id){
        $sql = "SELECT * FROM cards where user_id = $user_id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([]);
        $result = $sql_exe->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}