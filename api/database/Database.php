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
* @project boutique-en-ligne 
* @name Database - API
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
*    -|> include_once 'Database.php';
*    -|>
*    -|> Use Api\Database as db; // <- creates a shortcut of the Api\Database namespace as `db`
*    -|> $database = new db\Database(); // <- Instantiates object of class db\Database class
*    -|> 
*    -|> $database->dbConnect(); // <- connect to the database
*    -|>
*   ~[OR]~
*    -|> // As a parent class
*    -|> class User extends Database {
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
*   2+|> // Handling database connection error
*    -|>
*    -|> if ($database->db_connect_errno) {
*    -|>    echo $database->db_connect_error;
*    -|> }
*
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: We'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */


// Declare a namespace named `Api\classDatabase`
namespace Api\classDatabase;


// Using some core PHP Classes...

use pdo;



// Uncomment the code below, to enable return type in PHP functions
// declare(strict_types=1);

/*
 * Declare a class named 'Database'.
 */
class Database {

  // private properties
  private $db_host = '127.0.0.1';
  private $db_username = 'abraham-ukachi';
  private $db_password = 'root';
  private $db_port = -1;

  // protected properties
  protected $db_name = 'db_maxaboom';
  protected $db_table_users = 'users';
  protected $db_table_products = 'products';
  protected $db_table_comments = 'comments';

  // initialize some protected properties with `null`
  protected ?object $db = null;


  // public constants
  public const ERROR_NOT_FOUND = 0;
  public const ERROR_FOUND = 1;

  // fields - constants
  public const FIELD_ID = 'id';
  public const FIELD_EMAIL = 'email';
  public const FIELD_PASSWORD = 'password';
  public const FIELD_FIRST_NAME = 'prenom';
  public const FIELD_LAST_NAME = 'nom';

  // public properties
  // - connection errors
  public int $db_connect_errno;
  public string $db_connect_error;



  // PUBLIC SETTERS

  /**
   * Method used to set or update the database username with the given `db_username`
   *
   * @param string $db_username
   * @protected
   */
  public function setDatabaseUsername($db_username) {
    $this->db_username = $db_username;
  }

  /**
   * Method used to set or update the database password with the given `db_password`
   *
   * @param string $db_password
   * @protected
   */
  public function setDatabasePassword($db_password) {
    $this->db_password = $db_password;
  }

  /**
   * Method used to set or update the database port with the given `db_port`
   *
   * @param int $db_port
   * @protected
   */
  public function setDatabasePort($db_port) {
    $this->db_port = $db_port;
  }

  // PUBLIC GETTERS

  // PUBLIC METHODS
  

  /**
   * Constructor that is automatically called whenever an object of this database gets created.
   *
   * @param bool $autoConnect - if TRUE, a connection to the database will be attempted automatically or during object instantiation of this class
   */
  public function __construct($autoConnect = false) {

    // Intializing some properties...

    // connection errors
    $this->db_connect_errno = 0;
    $this->db_connect_error = "";

    // If `autoConnect` is TRUE...
    if ($autoConnect) {
      // ...connect to the database
      $this->dbConnect();
    }

  } 

  /**
   * Method used to connect to the database
   * 
   * @return null|object $db - The PDO connection object to the database
   * @private
   */
  public function dbConnect(): null|object {
    // initialize the `db` variable by setting it to null
    $db = null;

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
      $db = new pdo($db_dsn, $this->db_username, $this->db_password, $db_options);

      // Update `db` protected property of this class
      $this->db = $db;

      // DEBUG [4dbsmaster]: tell me about it ;)
      // echo "Database connected successfully via PDO";
    
    } catch (PDOException $e) { 
       // update the connection errors
      $this->updateConnectErrors($this::ERROR_FOUND, "[dbConnect]: Failed to connect to database - " . $e->getMessage());
    } 
    
    
    // Return `db`
    return $db; 
  }



  /**
   * Closes the current database connection
   */
  public function dbClose() {
    // close the `pdo` connection by setting the `db` object to null
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
  private function getDSN() {
    $default_dsn = "mysql:host=$this->db_host;dbname=$this->db_name";
    
    return ($this->db_port !== -1) ? "$default_dsn;port={$this->db_port}" : $default_dsn;
  }

  // PRIVATE METHODS


  /**
   * Resets the connection error variables (i.e. `connect_errno` and `connect_error`)
   */
  private function resetConnectErrors() {
    $this->db_connect_errno = 0;
    $this->db_connect_error = "";
  }


  /**
   * Updates the connection errors
   *
   * @param int errno - Error code
   * @param string error - Error message
   */
  private function updateConnectErrors($errno, $error) {
    $this->db_connect_errno = $errno;
    $this->db_connect_error = $error;
  }

}
