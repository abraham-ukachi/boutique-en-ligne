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
* @name Card - Model
* @test test/card_model.php
* @file Card.php
* @author: Axel Vair <axel.vair@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Create a new card
*    -|>
*    -|> $card = Card::create([
*    -|>   'type' => 'visa',
*    -|>   'user_id' => 1,
*    -|>   'card_no' => 1234567890123456,
*    -|>   'expiry_month' => 12,
*    -|>   'expiry_year' => 2023,
*    -|>   'cvv' => 123
*    -|> ]);
*    -|>
*
*/


// declare the namespace for this `Card` class
namespace Maxaboom\Models;


// use these classes
use PDO;
use PDOException;



/**
 * Class Card / Card Model
 * A class that represents the `cards` table in the database.
 */
class Card extends Model {

  // Define some constants here ;)


  // Define some properties here ;)


  // protected properties


  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'cards';


  /**
   * Indicates if the model should automatically connect to the database.
   *
   * @var bool
   */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `cardds` table
   * @var array
   */
  protected array $fields = [
    'id',
    'type',
    'user_id',
    'card_no',
    'expiry_month',
    'expiry_year',
    'cvv',

    'created_at',
    'updated_at',
    'deleted_at'
  ];


  // public properties

  public ?int $id = null;
  public ?string $type = null;
  public ?int $user_id = null;
  public ?int $card_no = null;
  public ?int $expiry_month = null;
  public ?int $expiry_year = null;
  public ?int $cvv = null;
  // timestamps
  public ?string $created_at = null;
  public ?string $updated_at = null;
  public ?string $deleted_at = null;

  
  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = true;


  // private properties




  /**
   * Card constructor.
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






  // +++++++ OLD - `Axel Vair` - CODE ++++++++
  // USE: `Card::create([...])` instead to create a new card
  //      `Card::find($id)` to find a card by its id
  //      `Card::all()` to get all the cards
  //      `Card::where($field, $value)` to retrieve a card by a specific field

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

    /**
     * Returns all the cards of the given `user_id`
     *
     * @param int $user_id - The user id
     *
     * @return array - The cards of the user
     */
    public function getAll(int $user_id): array {
      // create an sql query string as `sql`
      $sql = "SELECT * FROM cards where user_id = :user_id";

      // prepare the sql query string, and assign it to a `sql_exe` variable
      $sql_exe = $this->db->prepare($sql);

      // execut the sql query
      $sql_exe->execute([
        'user_id' => $user_id
      ]);

      // fetch all the results from the sql query as `cards`
      $cards = $sql_exe->fetchAll(PDO::FETCH_ASSOC);

      // TODO: Do something awesome with `cards` here ;)

      // return the `cards`
      return $cards;
    }


    public function getOne(int $userId, int $cardId){
        $sql = "SELECT * FROM cards WHERE user_id=$userId AND id = $cardId";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
        ]);
        $result = $sql_exe->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


  // +++++ End of OLD - `Axel Vair` - CODE +++++ 


}
