<?php
/*
* @license MIT
* boutique-en-ligne (maxaboom)
* Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
* All rights reserved.
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* @project boutique-en-ligne (maxaboom)
* @name Address - Model
* @test test/address_model.php
* @file Address.php
* @author: Axel Vair <axel.vair@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Create a new address
*    -|>
*    -|> $address = Address::create([
*    -|>   'title' => 'Home',
*    -|>   'address' => '1 rue de la paix',
*    -|>   'address_complement' => 'Appartement 1',
*    -|>   'city' => 'Paris',
*    -|>   'postal_code' => 75000,
*    -|>   'country' => 'France',
*    -|>   'user_id' => 1
*    -|> ]);
*    -|>
*
 */

// declare the namespace for this `Address` class
namespace Maxaboom\Models;

// use these classes
use datetime;
use PDO;
use PDOException;








/**
 * Class Address / Address Model
 * A class that represents the `addresses` table in the database.
 */
class Address extends Model {

  // Define some constants here ;)


  // Define some properties here ;)


  // protected properties


  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'addresses';


  /**
   * Indicates if the model should automatically connect to the database.
   *
   * @var bool
   */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `addresses` table
   * @var array
   */
  protected array $fields = [
    'id',
    'title',
    'address',
    'address_complement',
    'postal_code',
    'city',
    'country',
    'user_id',

    'created_at',
    'deleted_at'
  ];


  // public properties

  public ?int $id = null;
  public ?string $title = null;
  public ?string $address = null;
  public ?string $address_complement = null;
  public ?int $postal_code = null;
  public ?string $city = null;
  public ?string $country = null;
  public ?int $user_id = null;
  // timestamps
  public ?string $created_at = null;
  public ?string $deleted_at = null;

  
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = true;


  // private properties




  /**
   * Address constructor.
   * NOTE: This constructor is called automatically when the class is instantiated
   */
  public function __construct() {
    // call the parent Model constructor
    parent::__construct();
  }
  

  // PUBLIC STATIC METHODS

  // PUBLIC STATIC GETTERS

  // PUBLIC STATIC SETTERS



  // PUBLIC METHODS

  // PUBLIC GETTERS

  // PUBLIC SETTERS




  // PRIVATE STATIC METHODS
  
  // PRIVATE STATIC GETTERS

  // PRIVATE STATIC SETTERS
  
  
  
  // PRIVATE METHODS  

  // PRIVATE GETTERS

  // PRIVATE SETTERS






  // +++++++ `Axel Vair` - CODE ++++++++

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



    // +++++++ End of `Axel Vair` - CODE ++++++++

}
