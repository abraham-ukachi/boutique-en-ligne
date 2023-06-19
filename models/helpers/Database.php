<?php
/**
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
* @name Database - Model Helper
* @test test/database.php
* @file Database.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Establishing a connection to the Maxaboom database
*    -|>
*    -|> $database = new Maxaboom\Models\Helpers\Database(); // <- Instantiates object of `Database` model helper class
*    -|> $database->dbConnect(); // <- connect to the database
*    -|>
*   ~[OR]~
*    -|> // As a parent class
*    -|> class User extends Maxaboom\Models\Helpers\Database {
*    -|>    ...
*    -|>    public function __construct() {
*    -|>      parent::__construct();
*    -|>      
*    -|>      // You can update your database password before connecting ;)
*    -|>      $this->setDatabasePassword('root'); // <- NOTE: this is optional
*    -|>
*    -|>      // connect to the database
*    -|>      $this->dbConnect();
*    -|>    }
*    -|> }
*   
*
*
*   2+|> // Handling database connection error
*    -|>
*    -|> if ($database->db_connect_errno) {
*    -|>    echo $database->db_connect_error;
*    -|> }
*
*
*
*   3+|> // Perform a query with the `pdo` method
*    -|> 
*    -|> $database->pdo->query("SELECT * FROM {Database::TABLE_USERS}");
*    -|> 
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: We'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */


// Declare a namespace for this `Database` model
namespace Maxaboom\Models\Helpers;



// Using some core PHP Classes...

use pdo;
use pdoexception;



// Uncomment the code below, to enable return type in PHP functions
// declare(strict_types=1);

/*
 * Declare a class named 'Database'.
 */
class Database {
  // private constants
  private const DOTENV_PATH = __DIR__  . '/.env';

  // private properties
  private string $db_host;
  private string $db_username;
  private string $db_password;
  private int $db_port;

  // protected properties
  protected string $db_name;

  // initialize some  properties with `null`
  public ?object $pdo = null;
  public ?object $db = null;

  // public constants
  public const ERROR_NOT_FOUND = 0;
  public const ERROR_FOUND = 1;

  // tables - constants
  public const TABLE_USERS = 'users';
  public const TABLE_PRODUCTS = 'products';
  public const TABLE_PRODUCT_TAG = 'product_tag';
  public const TABLE_ADDRESSES = 'addresses';
  public const TABLE_ORDERS = 'orders';
  public const TABLE_ORDERS_ITEMS = 'orders_items';
  public const TABLE_CART = 'cart';
  public const TABLE_CATEGORIES = 'categories';
  public const TABLE_SUB_CATEGORIES = 'sub_categories';
  public const TABLE_REVIEWS = 'comments';
  public const TABLE_LIKES = 'likes';
  public const TABLE_TAGS = 'tags';
  
  // fields - constants
  public const FIELD_ID = 'id';
  public const FIELD_CATEGORY_ID = 'category_id';
  public const FIELD_SUB_CATEGORY_ID = 'sub_category_id';
  public const FIELD_PRODUCT_ID = 'product_id';
  public const FIELD_ORDER_ID = 'order_id';

  public const FIELD_EMAIL = 'mail';
  public const FIELD_PASSWORD = 'password';
  public const FIELD_FIRST_NAME = 'firstname';
  public const FIELD_LAST_NAME = 'lastname';

  public const FIELD_CREATED_AT = 'created_at';
  public const FIELD_UPDATED_AT = 'updated_at';
  public const FIELD_DELETED_AT = 'deleted_at';
  public const FIELD_PAID_AT = 'paid_at';

  public const FIELD_BIRTH_DATE = 'dob';
  public const FIELD_ROLE = 'user_role';
  public const FIELD_STOCK = 'stock';
  public const FIELD_NAME = 'name';
  public const FIELD_PRICE = 'price';
  public const FIELD_TOTAL_PRICE = 'total_price';
  public const FIELD_DESCRIPTION = 'description';
  public const FIELD_IMAGE = 'image';
  public const FIELD_QUANTITY = 'quantity';
  public const FIELD_UNIT_PRICE = 'unit_price';
  public const FIELD_TAX_AMOUNT = 'tax_amount';
  public const FIELD_DISCOUNT = 'discount_percentage';
  public const FIELD_REVIEW = 'comment';
  public const FIELD_RAITING = 'raitings';

  public const FIELD_ADDRESS = 'address';
  public const FIELD_ADDRESS_COMP = 'address_complement';
  public const FIELD_POSTAL_CODE = 'postal_code';
  public const FIELD_CITY = 'city';
  public const FIELD_COUNTRY = 'country';
  public const FIELD_TYPE = 'type';
  public const FIELD_TITLE = 'title';

  // role - constants
  public const ROLE_CUSTOMER = 'customer';
  public const ROLE_GUEST = 'guest';
  public const ROLE_ADMIN = 'admin';



  // public properties
  // - connection errors
  public int $db_connect_errno;
  public string $db_connect_error;



  /**
   * Constructor that is automatically called whenever an object of this database gets created.
   *
   * @param string $connection - the type of connection to be used. Default is `pdo`
   * @param bool $autoConnect - if TRUE, a connection to the database will be attempted automatically or during object instantiation of this class
   */
  public function __construct(string $connection = 'pdo', bool $autoConnect = false) {
    // Instantiate the DotEnv class as `$dotEnv`
    $dotEnv = new DotEnv(self::DOTENV_PATH);
    // load the environment variables
    $dotEnv->load();

    // populate the database properties 
    $this->db_host = $_ENV['DATABASE_HOST'];
    $this->db_username = $_ENV['DATABASE_USERNAME'];
    $this->db_password = $_ENV['DATABASE_PASSWORD'];
    $this->db_port = $_ENV['DATABASE_PORT'];
    $this->db_name = $_ENV['DATABASE_NAME'];


    // Intializing other properties...
    
    // connection errors
    $this->db_connect_errno = 0;
    $this->db_connect_error = "";

    // If `autoConnect` is TRUE...
    if ($autoConnect) {
      // ...connect to the database
      $this->dbConnect();
    }

  } 



  // PUBLIC SETTERS

  /**
   * Method used to set or update the database username with the given `db_username`
   *
   * @param string $db_username
   * @protected
   */
  public function setDatabaseUsername(string $db_username): void {
    $this->db_username = $db_username;
  }

  /**
   * Method used to set or update the database password with the given `db_password`
   *
   * @param string $db_password
   * @protected
   */
  public function setDatabasePassword(string $db_password): void {
    $this->db_password = $db_password;
  }

  /**
   * Method used to set or update the database port with the given `db_port`
   *
   * @param int $db_port
   * @protected
   */
  public function setDatabasePort(int $db_port): void {
    $this->db_port = $db_port;
  }

  // PUBLIC GETTERS

  // PUBLIC METHODS
  

  /**
   * Method used to connect to the database
   * 
   * @return ?object $pdo - The PDO connection object to the database
   * @private
   */
  public function dbConnect(): ?object {
    // initialize the `pdo` variable by setting it to null
    $pdo = null;

    // Reset the connection errors
    $this->resetConnectErrors();

    // define some options for the pdo connection as `db_options`
    $db_options = [
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //ERROR TYPE
      PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
    ];

    // get our current Data Source Name as `db_dsn`
    $db_dsn = $this->getDSN();
    
    // Let's try to establish a database connection, shall we?
    try {

      // ...connect to our database, using the `db_name` variable
      $pdo = new pdo($db_dsn, $this->db_username, $this->db_password, $db_options);

      // Update `pdo`  property of this class
      $this->pdo = $pdo;
      $this->db = $pdo; // <- #NN - For those who prefer using the deprecated `db` method instead ;)

      // DEBUG [4dbsmaster]: tell me about it ;)
      // echo "Database connected successfully via PDO";
    
    } catch (PDOException $e) { 
       // update the connection errors
      $this->updateConnectErrors($this::ERROR_FOUND, "[dbConnect]: Failed to connect to Maxaboom database - " . $e->getMessage());
    } 
    
    
    // Return `pdo`
    return $pdo; 
  }



  /**
   * Closes the current database connection
   */
  public function dbClose(): void {
    // close the database connection by setting the `pdo` & `db` objects to null
    $this->pdo = null;
    $this->db = null;
  }

  // PROTECTED SETTERS

  // PROTECTED GETTERS

  // PROTECTED METHODS
  



  

  // PRIVATE SETTERS

  // PRIVATE GETTERS
  
  /**
   * Returns the Data Source Name (dsn) of our database,
   * using some predefined attributes like `db_host` and `db_name`.
   *
   * @return string
   */
  private function getDSN(): string {
    $default_dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
    
    return ($this->db_port !== -1) ? "$default_dsn;port={$this->db_port}" : $default_dsn;
  }

  // PRIVATE METHODS


  /**
   * Resets the connection error variables (i.e. `connect_errno` and `connect_error`)
   */
  private function resetConnectErrors(): void {
    $this->db_connect_errno = 0;
    $this->db_connect_error = "";
  }


  /**
   * Updates the connection errors
   *
   * @param int errno - Error code
   * @param string error - Error message
   */
  private function updateConnectErrors($errno, $error): void {
    $this->db_connect_errno = $errno;
    $this->db_connect_error = $error;
  }

}
