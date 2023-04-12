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

    public function getAddressByUser(int $userId){
        $addressUser = $this->db->prepare("SELECT * FROM addresses WHERE user_id=$userId");
        $addressUser->execute([
        ]);
        $result = $addressUser->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function newAddress($titre,$address, $complement, $postal_code, $city, $country, $user_id, $type){
        $sql = "INSERT INTO addresses (titre, address, address_complement, postal_code, city, country, user_id, type)
                VALUES (:titre, :address, :address_complement, :postal_code, :city, :country, :user_id, :type)";
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
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouvelle adresse enregistrée']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
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