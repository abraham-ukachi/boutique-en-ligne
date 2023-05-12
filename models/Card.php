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

    public function updateCard($card_id, $type, $card_no, $expiration, $cvv, $user_id)
    {
        $expiry_month = (int) explode('/', $expiration)[0];
        $expiry_year = (int) explode('/', $expiration)[1];
        $sql = "
            UPDATE cards 
            SET type = :type, card_no =  :card_no, expiry_month = :expiry_month, expiry_year = :expiry_year, cvv = :cvv 
            WHERE user_id = $user_id AND id = $card_id
            ";

        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([

            'type' => $type,
            'card_no' => $card_no,
            'expiry_month' => $expiry_month,
            'expiry_year' => $expiry_year,
            'cvv' => $cvv
        ]);

        if ($sql_exe) {
            return true;
        } else {
            return false;
        }
    }
    public function getAll($user_id){
        $sql = "SELECT * FROM cards where user_id = $user_id";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([]);
        $result = $sql_exe->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getOne(int $userId, int $cardId){
        $sql = "SELECT * FROM cards WHERE user_id=$userId AND id = $cardId";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
        ]);
        $result = $sql_exe->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}