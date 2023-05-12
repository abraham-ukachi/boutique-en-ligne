<?php

namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;

class Address extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->dbConnect();
    }

    public function getAll(int $userId){
        $addressUser = $this->db->prepare("SELECT * FROM addresses WHERE user_id=$userId");
        $addressUser->execute([
        ]);
        $result = $addressUser->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getOne(int $userId, int $addressId){
        $addressUser = $this->db->prepare("SELECT * FROM addresses WHERE user_id=$userId AND id = $addressId");
        $addressUser->execute([
        ]);
        $result = $addressUser->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function newAddress($title,$address, $complement, $postal_code, $city, $country, $user_id){
        $created_at = date('Y-m-d H:i:s');
        $sql = "INSERT INTO addresses (title, address, address_complement, postal_code, city, country, user_id, created_at)
                VALUES (:title, :address, :address_complement, :postal_code, :city, :country, :user_id, :created_at)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'title' => htmlspecialchars($title),
            'address' => htmlspecialchars($address),
            'address_complement' => htmlspecialchars($complement),
            'postal_code' => $postal_code,
            'city' => htmlspecialchars($city),
            'country' => htmlspecialchars($country),
            'user_id' => $user_id,
            'created_at' => $created_at
        ]);         
        if ($sql_exe) {
           return true;
        } else {
           return false;
        }
    }

    public function updateAddress($address_id, $title, $address, $address_complement, $postal_code, $city, $country, $user_id)
    {
        $sql = "
            UPDATE addresses 
            SET title = :title, address = :address, address_complement = :address_complement, postal_code = :postal_code, city = :city, country = :country 
            WHERE user_id = $user_id AND id = $address_id
            ";

        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([

            'title' => htmlspecialchars($title),
            'address' => htmlspecialchars($address),
            'address_complement' => htmlspecialchars($address_complement),
            'postal_code' => $postal_code,
            'city' => htmlspecialchars($city),
            'country' => htmlspecialchars($country),
        ]);
        if ($sql_exe) {
            return true;
        } else {
            return false;
        }
    }
    //UPDATE TYPE ADDRESS

    function updateTypeAddress($idAddress, $newtype){
        $sqlupdate = $this -> db -> prepare("UPDATE addresses SET type = :newtype WHERE id = :id ");
        $sqlupdate->execute([
            'id' => $idAddress,
            'newtype' => $newtype
        ]);
        if ($sqlupdate) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Type addresse mis à jour']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'PB pour supprimer']);
        }
    }

    //DELETE ADDRESS

    function deleteAddress($addressId){
            $sqlupdate = $this -> db -> prepare("DELETE FROM addresses WHERE id = :id ");
            $sqlupdate->execute([
            'id' => $addressId,
        ]);
            if ($sqlupdate) {
                echo json_encode(['response' => 'ok', 'reussite' => 'Addresse supprime']);
            } else {
                echo json_encode(['response' => 'not ok', 'echoue' => 'PB pour supprimer']);
            }

    }
}