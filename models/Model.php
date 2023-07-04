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
* @name Abstract Model
* @file Model.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // 
*    -|>
*
*/

// Declare the namespace for this `Model` class
namespace Maxaboom\Models;

// Import the `Database` class from the `Helpers` namespace
use Maxaboom\Models\Helpers\Database;




/**
 * A class that represents our abstract Model ;)
 * NOTE: This class allows the creation of dynamic properties
 */
#[\AllowDynamicProperties]
abstract class Model extends Database implements ModelInterface {

  // declare some constanst
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
  const COMPLETED_AT = 'completed_at';


  // protected variables

  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table;


  /**
   * The fields associated with this model
   *
   * @var array
   */
  protected array $fields = [];


  /**
   * The primary key associated with the table. 
   *
   * @var string
   */
  protected string $primaryKey = 'id';

  
  /**
   * The database connection that should be used by the model.
   * 
   * @var string
   */
  protected string $connection = 'pdo';
  

  /**
   * Indicates if the model should automatically connect to the database.
   *
   * @var bool
   */
  protected bool $autoConnect = true;



  // public variables


  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = true;



  // private variables

  /**
   * The original properties of the model.
   *
   * @var array
   */
  private array $originalProperties = [];


  /**
   * The last result of the model.
   *
   * @var array
   */
  private array $latestResult = [];
  
   
  /**
   * Constructor of the Model class
   */
  public function __construct() {
    // Call the parent constructor
    parent::__construct($this->connection, $this->autoConnect);
    
  }


  // PUBLIC STATIC METHODS

  /**
   * Creates a new row in `$table`, using the given `$params`,
   * NOTE: This method will insert all the `fieldValues` in `$params` to their corresponding `fieldKey`
   *
   * @param array $params
   * @return self 
   */
  public static function create(array $params): self {
    // Get an instance of the current model
    $instance = self::getInstance(); 

    // Verify the `$params` argument
    self::verifyParams($params, $instance);
    
    // get the sql query string from the given `params` as `sqlFieldKeys`
    $sqlFieldKeys = self::getSqlKeysFromParams($params);

    // Create the sql query string to create a new row in `$table` as `$create_sql`,
    // while adding the timestamps if `$timestamps` is true
    $create_sql = self::addTimestamps("INSERT INTO `$instance->table` SET $sqlFieldKeys", $instance);
    
    // Prepare the `$create_sql` query as `$stmt` (i.e. pdo statement)
    $stmt = $instance->pdo->prepare($create_sql);

    // Execute the `$stmt` query
    $stmt->execute($params);
    
    // Add the `id` or `$primaryKey` to the `$params` array
    $params[$instance->primaryKey] = $instance->pdo->lastInsertId();
    
    // Populate the model's instance with the given `$params` array
    $instance = self::populate($params, $instance);
     
    // Return the instance of the model
    return $instance;
  }
  

  /**
   * Finds a row in `$table` with the given `$id`
   *
   * @param int $id
   * @return self 
   */
  public static function find(int $id): self {
    // Get an instance of the current model
    $instance = self::getInstance();
     
    // Create the sql query string to find a row in `$table` with the given `$id` as `$find_sql`
    $find_sql = "SELECT * FROM `$instance->table` WHERE `$instance->primaryKey` = :id";
    
    // Prepare the `$find_sql` query as `$stmt` (i.e. pdo statement)
    $stmt = $instance->pdo->prepare($find_sql);
    
    // Execute the `$stmt` query
    $stmt->execute(['id' => $id]);

    // Fetch the result as an associative array
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);

    // converting the result special chars to html entities for security (i.e. XSS attack prevention)
    $result = self::convertSpecialChars($result);

    // set the last result of the model
    $instance->setLatestResult($result);

    
    // If the `result` is an array...
    if (is_array($result)) {
      // ...populate the model's instance with the given `$result` array
      $instance = self::populate($result, $instance);
    }
    
    // Return the instance of the model
    return $instance;
  }

  
  /**
   * Finds all the rows in `$table`
   *
   * @return array - An array of instances of the current model
   */
  public static function all(): array {
    // Get an instance of the current model
    $instance = self::getInstance();
    
    // Create the sql query string to find all the rows in `$table` as `$all_sql`
    $all_sql = "SELECT * FROM `$instance->table`";
    
    // Prepare the `$all_sql` query as `$stmt` (i.e. pdo statement)
    $stmt = $instance->pdo->prepare($all_sql);
    
    // Execute the `$stmt` query
    $stmt->execute();
     
    // Fetch the result as an associative array
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    // converting the result special chars to html entities for security (i.e. XSS attack prevention)
    $result = self::convertSpecialChars($result); 

    // set the last result of the model
    $instance->setLatestResult($result);

    // Initialize the `instances` variable
    $instances = [];
    
    // If the `result` is an array...
    if (is_array($result)) {
      // ...loop through all the `result`
      foreach ($result as $row) {
        // ...create a new instance of the current model
        $instance = self::getInstance();

        // populate the model's instance with the given `$row` array
        $instance = self::populate($row, $instance);
        // add the instance to the `instances` array
        $instances[] = $instance;

      }
    }
    
    // Return the `instances` array
    return $instances;
  }


  /**
   * Specifically find all rows in `$table` where the 1st argument (i.e. `$column`) is
   * equal to the 2nd or 3rd argument (i.e. `$value`)
   *
   * @example User::where('name', 'John Doe');
   * @example User::where('name', '=', 'John Doe');
   *
   * @return self|array - An array of instances of the current model
   */
  public static function where(): self|array {
    // Get an instance of the current model
    $instance = self::getInstance();

    // get all the arguments passed to this method as `$args`
    $args = func_get_args();
    

    // Initialize the `column`, `separator` and `value` variables
    $column = $args[0];
    $separator = count($args) === 3 ? $args[1] : '=';
    $value = count($args) === 3 ? $args[2] : $args[1];

    // Create an sql query string as `$where_sql`
    $where_sql = "SELECT * FROM `$instance->table` WHERE `$column` $separator :value";

    // Prepare the `$where_sql` query as `$stmt` (i.e. pdo statement)
    $stmt = $instance->pdo->prepare($where_sql);
     
    // Execute the `$stmt` query
    $stmt->execute(['value' => $value]);
    
    // Fetch the result as an associative array
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    
    // converting the result special chars to html entities for security (i.e. XSS attack prevention)
    $result = self::convertSpecialChars($result);

    // Initialize the `instances` variable
    $instances = [];

    // If the `result` is an array...
    if (is_array($result)) {
      // ...loop through all the `result`
      foreach ($result as $row) {
        // ...create a new instance of the current model
        $instance = self::getInstance();

        // populate the model's instance with the given `$row` array
        $instance = self::populate($row, $instance);
        // add the instance to the `instances` array
        $instances[] = $instance;
      }
    }


    // set / update the latest result with `instances`
    $instance->setLatestResult($instances);

    // Return this instance of the model
    return $instance;
  }


  /**
   * Verifies the given `$params` argument
   * NOTE: This method will throw an exception if the `$params` argument is invalid.
   *
   * @param array $params
   * @param self $instance
   *
   * @return bool 
   */
  public static function verifyParams(array $params, self $instance): bool {
    // Initialize the `result` variable 
    $result = true;
    
    // Throw an exception, if the `$params` is empty
    if (empty($params)) {
      throw new \Exception("The \$params argument cannot be empty");
    } else if (!is_array($params)) {
      throw new \Exception("The \$params argument must be an array");
    } 
    
      
    // loop through all the `params`
    foreach ($params as $fieldKey => $fieldValue) {
      // Throw an exception, if the `$fieldKey` is not found in the `$fields` array
      if (!in_array($fieldKey, $instance->fields)) {
        throw new \Exception("The fieldKey ($fieldKey) is not supported; it doesn't exists or cannot be found in the `fields` array");
      }
    }

    // Return the `result`
    return $result;
  }


  // PUBLIC STATIC SETTERS

  // PUBLIC STATIC GETTERS
  
  
  
  // PRIVATE STATIC METHODS

  /**
   * Method used to convert all html special character of the values,
   * of the given `$result` array to html entities
   * NOTE: 🔐 This method is used to prevent XSS attacks (i.e. Cross-Site Scripting) 😜⛑
   *
   * @param array $result - eg. ['name' => 'Abraham', 'email' => '<script>alert("Hello")</script>']
   *
   * @return array - eg. ['name' => 'Abraham', 'email' => '&lt;script&gt;alert(&quot;Hello&quot;)&lt;/script&gt;']
   * @private
   */
  private static function convertSpecialChars(array $result): array {
    // Initialize the `convertedResult` variable
    $convertedResult = [];
    
    // loop through all the `result`
    foreach ($result as $fieldKey => $fieldValue) {
      // If the `fieldValue` is an array...
      if (is_array($fieldValue)) {
        // ...convert the `fieldValue` to html entities
        $fieldValue = self::convertSpecialChars($fieldValue);

      } else if (is_string($fieldValue)) {
        // ...update & convert the `fieldValue` to html entities
        $fieldValue = htmlspecialchars($fieldValue, ENT_QUOTES, 'UTF-8');
      }

      // append the `filedValue` to the `convertedResult` array
      $convertedResult[$fieldKey] = $fieldValue;

    }
    
    // Return the `convertedResult`
    return $convertedResult;
  }


  // PRIVATE STATIC SETTERS

  // PRIVATE STATIC GETTERS

  /**
   * Returns the sql query string from the given `params` as `sqlFieldKeys`
   *
   * @param array $params - eg. ['name' => 'Abraham', 'email' => 'elon@musk.com', 'password' => '123456']
   *
   * @return string - eg. "`name` = :name, `email` = :email, `password` = :password" 
   * @private
   */
  private static function getSqlKeysFromParams(array $params): string {
    // Initialize the `sqlFieldKeys` variable 
    $sqlFieldKeys = '';
    
    // loop through all the `params`
    foreach ($params as $fieldKey => $fieldValue) {
      // Append the `fieldKey` to the `sqlFieldKeys` variable
      $sqlFieldKeys .= "`$fieldKey` = :$fieldKey" . ', '; // <- eg. (`name` = :name)
    }
    
    // Remove the last comma from the `sqlFieldKeys` variable
    $sqlFieldKeys = rtrim($sqlFieldKeys, ', ');

    // Return the `sqlFieldKeys`
    return $sqlFieldKeys;
  }


  /**
   * Adds the timestamp to the given `$sql` query string
   * NOTE: This method will add the `CREATED_AT` and `UPDATED_AT` fields to the given `$sql` query string
   *
   * @param string $sql
   * @param self $instance
   *
   * @return string
   * @private
   */
  private static function addTimestamps(string $sql, self $instance): string {
    // Do nothing if the timestamps are disabled
    if (!$instance->timestamps) {
      return $sql;
    }


    // Initialize the `result` variable
    $result = $sql;

    // Check if the 'INSERT INTO' keyword is found in the `$sql` query string
    if (strpos($sql, 'INSERT INTO') !== false) {
      // Add the `CREATED_AT` field to the `$sql`
      $result .= ", `" . self::CREATED_AT . "` = NOW()";
    }

    // Check if the 'UPDATE' keyword is found in the `$sql` query string
    if (strpos($sql, 'UPDATE') !== false) {
      // Add the `UPDATED_AT` field to the `$sql` 
      $result .= ", `" . self::UPDATED_AT . "` = NOW()";
    }

    // Return the `result`
    return $result;
  }


  /**
   * Populates the given `$instance` with the given `$params` array
   *
   * @param array $params
   * @param self $instance
   *
   * @return self
   * @private
   */
  private static function populate(array $params, self $instance): self {
    // Initialize the `originalProperties` associative array
    $originalProperties = [];
    

    // loop through all the `params`
    foreach ($params as $fieldKey => $fieldValue) {
      // Set the `$fieldKey` to the `$fieldValue` in the `$instance`
      $instance->$fieldKey = $fieldValue;

      // Append the `$fieldKey` and `$fieldValue` to the `originalProperties` associative array
      $originalProperties[$fieldKey] = $fieldValue;
    }
    
    // If the `originalProperties` array of the current instance is empty...
    if (empty($instance->originalProperties)) {
      // ...set the `originalProperties` to the `originalProperties` associative array
      $instance->originalProperties = $originalProperties;
    }
    
    // Return the `$instance`
    return $instance;
  }



  // PUBLIC METHODS


  /**
   * Sets the last result to the given `$result`
   *
   * @param array $result
   */
  public function setLatestResult(array $result) {
    $this->latestResult = $result;
  }

  

  /**
   * Saves all the dirty or changed properties of the current instance to the database
   *
   * @return bool - Returns TRUE if the current instance is saved; otherwise, FALSE
   */
  public function save(): bool {
    // Initialize the `result` boolean variable
    $result = false;

    // If there's a dirty property...
    if ($this->isDirty()) {
      // ... get the changed properties (i.e. `role` = :role, `email` = :email)
      $changedProperties = $this->getChangedProperties();

      // get the sql SET query string of the changed properties 
      $setQueryString = $this->getSqlKeysFromParams($changedProperties);

      // save the current instance and update the `result` variable
      $result = $this->saveInstance($setQueryString, $changedProperties);

    }

    // return the `result`
    return $result;
  }


  /**
   * Checks if one or more properties have changed 
   *
   * @return bool - Returns TRUE there's a changed property; otherwise, FALSE
   * @public
   */
  public function isDirty(?string $propName = null): bool {
    // Initialize the `result` variable
    $result = false;

    // Get the changed properties
    $changedProperties = $this->getChangedProperties();

    // if there's a `propName` argument...
    if (isset($propName)) {
      // ...find the `propName` in the `changedProperties` array
      $result = isset($changedProperties[$propName]) ? true : false;

    }else {
      // ...else, check if the `changedProperties` array is not empty
      $result = count($changedProperties) > 0 ? true : false;
    }
    
    // return the `result`
    return $result;
  }


  /**
   * Checks if none of the properties have changed
   *
   * @return bool - Returns TRUE if none of the properties have changed; otherwise, FALSE
   * @public
   */
  public function isClean(): bool {
    return !$this->isDirty();
  }


  // PUBLIC SETTERS

  // PUBLIC GETTERS

  /**
   * Returns the latest result of the current instance
   *
   * @return array
   */
  public function getLatestResult(): array {
    return $this->latestResult;
  }


  /**
   * Returns all the info of this model
   *
   * @param array $acceptedFields - an array of the accepted fields to return
   *
   * @return array - an associative array of all the field properties.
   */
  public function info(array $acceptedFields = []): array {
    // Intialize the `output` associative array
    $output = [];
    
    // loop throught the `fields` property
    foreach ($this->fields as $field) {
      // If the `$acceptedFields` array is not empty...
      if (!empty($acceptedFields)) {
        // ...check if the current `$field` is in the `$acceptedFields` array
        if (!in_array($field, $acceptedFields)) {
          // ...if not, continue to the next `$field`
          continue;
        }
      }

      // Append the `field` to the `output` associative array
      $output[$field] = isset($this->$field) ? $this->$field : null;
    }

    // Return the `output`
    return $output;
  }

  /**
   * Checks if this instance exists in the database, using its primary key
   *
   * @returnsbool
   * @public
   */
  public function exists(): bool {
    return isset($this->id);
  }

  /**
   * Returns the latest result of the current instance
   *
   * @return array
   */
  public function get(bool $infoOnly = false): array {
    // get the lastest result by mapping it to an array of the `info` of each instance
    $latestResult = $this->getLatestResult();

    // if the `$infoOnly` argument is true...
    if ($infoOnly) {
      // ...map the `latestResult` to an array of the `info` of each instance
      $latestResult = array_map(function($instance) {

        return $instance->info();

      }, $latestResult);
    }

    // clear the `latestResult` property
    $this->setLatestResult([]);

    // return the `latestResult`
    return $latestResult;
  }


  // PRIVATE METHODS

  // PRIVATE SETTERS

  // PRIVATE GETTERS

  /**
   * Saves the current instance to the database
   * NOTE: This method updates the database using its `$primarKey` and given `$sql` query string
   *
   * @param string $setQueryString - eg. "`role` = :role, `email` = :email, `password` = :password"
   * @param array $properties - eg. ['role' => 'admin', 'email' => '...', 'password' => '...']
   *
   * @return bool - Returns TRUE if the current instance is saved; otherwise, FALSE
   */
  private function saveInstance(string $setQueryString, array $properties): bool {
    // TODO: Create a Builder class to handle the sql queries

    // Create an sql query to update the current instance
    $update_sql = "UPDATE `$this->table` SET $setQueryString";

    // If the `$timestamps` is enabled... 
    if ($this->timestamps) {
      // ...add the timestamps to the `$update_sql` query string
      $update_sql = self::addTimestamps($update_sql, $this);
    }
    
    // add the where clause to the `$update_sql` query string
    $update_sql .= " WHERE `$this->primaryKey` = :$this->primaryKey";

    // Prepare the sql query as a PDO statement (i.e. $stmt)
    $stmt = $this->pdo->prepare($update_sql);

    // Add the primary key to the `$properties` array
    $properties[$this->primaryKey] = $this->originalProperties[$this->primaryKey];

    // Execute the `$stmt`
    $result = $stmt->execute($properties);

    // if the current instance is saved successfully...
    if ($result) {
      // ...update the `originalProperties` array
      $this->originalProperties = array_merge($this->originalProperties, $properties);

      // populate the current instance with the `originalProperties` array
      self::populate($this->originalProperties, $this);
    }
    
    // Return the `result`
    return $result;
  }


  /**
   * Returns an associative array of the changed properties
   * NOTE: This method will return an empty array if there's no changed property
   *
   * @return array
   * @private
   */
  private function getChangedProperties(): array {
    // Initialize the `changedProperties` associative array 
    $changedProperties = [];
    
    // loop through all the `originalProperties` 
    foreach ($this->originalProperties as $propName => $propValue) {
      // if the `$propValue` is not equal to the `$this->$propName`...
      if ($propValue !== $this->$propName) {
        // ...append the `$propName` and `$this->$propName` to the `changedProperties` associative array
        $changedProperties[$propName] = $this->$propName;
      }
    }

    // Return the `changedProperties` associative array
    return $changedProperties;
  }

  // PROTECTED METHODS

  // PROTECTED SETTERS

  // PROTECTED GETTERS

  /**
   * Returns an instance of the current model
   *
   * @return self
   * @protected
   */
  protected static function getInstance(): self {
    // Get the class name of the current model
    $className = get_called_class(); // <- returns eg. 'App\Models\User'

    // Return an instance of the current model
    return new $className();
  }

  
}
