<?php

namespace Maxaboom\Models;
use Maxaboom\Models\Helpers\Database;
use PDO;
use PDOException;

class Checkout extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->dbConnect();
    }

    public function registerCard($user_id, $nbCard, $expiration, $cvv){
        $sql = "INSERT INTO cards (user_id, card_no, expiration, CVV)
                VALUES (:user_id, :card_no, :expiration, :cvv)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'user_id' => htmlspecialchars($user_id),
            'card_no' => htmlspecialchars($nbCard),
            'expiration' => htmlspecialchars($expiration),
            'cvv' => htmlspecialchars($cvv)
        ]);
        if ($sql_exe) {
           return true;
        } else {
           return false;
        }
    }

    public function newAddress($titre, $address, $complement, $postal_code, $city, $country, $user_id, $type)
    {
        $sql = 'INSERT INTO addresses (titre, address, address_complement, postal_code, city, country, user_id, type)
                VALUES (:titre, :address, :address_complement, :postal_code, :city, :country, :user_id, :type)';
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'titre' => htmlspecialchars($titre),
            'address' => htmlspecialchars($address),
            'address_complement' => htmlspecialchars($complement),
            'postal_code' => $postal_code,
            'city' => htmlspecialchars($city),
            'country' => htmlspecialchars($country),
            'user_id' => $user_id,
            'type' => htmlspecialchars($type)
        ]);
        if ($sql_exe) {
           return true;
        } else {
           return false;
        }
    }

    public function getAddressByUser(int $userId){
        $addressUser = $this->db->prepare("SELECT * FROM addresses WHERE user_id=$userId");
        $addressUser->execute([
        ]);
        $result = $addressUser->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}