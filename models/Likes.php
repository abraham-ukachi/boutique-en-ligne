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
* @name Likes - Model
* @test test/likes.php
* @file Likes.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // ??
*    -|>
*    -|> $likes = new Likes();
*/


/*
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * MOTTO: We'll always do more 😜!!!
 * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 */






// Declare the namespace of this `Likes` class / model
namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;

use datetime;
use PDO;
use PDOException;


/**
 * Likes - Model
 * 
 * @package Maxaboom\Models
 */
class Likes extends Database {

  /**
   * Likes constructor.
   */
  public function __construct() {
    parent::__construct();

    // connect to the database
    $this->dbConnect();
  }

  /**
   * Adds a product with the given `product_id` to the likes table
   *
   * @param int $product_id - The id of the product to add to the likes table
   * @param int $user_id - The id of the user who likes the product
   *
   * @return bool - Returns TRUE if the product was successfully added to the likes table, FALSE otherwise.
   */
  public function add(int $product_id, int $user_id): bool {
    // create a sql query 
    $sql = "INSERT INTO likes (product_id, user_id) VALUES (:product_id, :user_id)";
    // prepare the sql query
    $stmt = $this->db->prepare($sql);

    // bind the values
    $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    // execute the sql query
    $stmt->execute();

    // fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // return the result
    return $result;
  }

  
  /**
   * Deletes a product with the given `product_id` from the likes table
   *
   * @param int $product_id - The id of the product to delete from the likes table
   * @param int $user_id - The id of the user who likes the product
   *
   * @return bool - Returns TRUE if the product was successfully deleted from the likes table, FALSE otherwise.
   */
  public function delete(int $product_id, int $user_id): bool {
    // create a sql query 
    $sql = "DELETE FROM likes WHERE product_id = :product_id AND user_id = :user_id";
    // prepare the sql query
    $stmt = $this->db->prepare($sql);

    // bind the values
    $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    // execute the sql query
    $stmt->execute();

    // fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // return the result
    return $result;
  }


  /**
   * Gets all products liked by the user with the given `user_id`
   *
   * @param int $user_id - The id of the user who likes the product
   * @param int $start - The start of the range
   * @param int $limit - The limit of the range
   *
   * @return array - Returns an array of products liked by the user with the given `user_id`
   */
  public function getAll(int $user_id, int $start, int $limit): array {
    // create a sql query 
    $sql = "SELECT * FROM likes WHERE user_id = :user_id LIMIT :start, :limit";
    // prepare the sql query
    $stmt = $this->db->prepare($sql);

    // bind the values
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

    // execute the sql query
    $stmt->execute();

    // fetch the result
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // return the result
    return $result;
  }


  /**
   * Gets the number of products liked by the user with the given `user_id`
   *
   * @param int $user_id - The id of the user who likes the product
   *
   * @return int - Returns the number of products liked by the user with the given `user_id`
   */
  public function countAll(int $user_id): int {
    // create a sql query 
    $sql = "SELECT COUNT(*) FROM likes WHERE user_id = :user_id";
    // prepare the sql query
    $stmt = $this->db->prepare($sql);

    // bind the values
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    // execute the sql query
    $stmt->execute();

    // fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // return the result
    return $result['COUNT(*)'];
  }

 
  /**
   * Checks if the user with the given `user_id` likes the product with the given `product_id`
   *
   *
   * @param int $user_id - The id of the user who likes the product
   * @param int $product_id - The id of the product to check
   *
   * @return bool - Returns TRUE if the user with the given `user_id` likes the product with the given `product_id`, FALSE otherwise.
   */
  public function check(int $user_id, int $product_id): bool {
    // create a sql query 
    $sql = "SELECT * FROM likes WHERE user_id = :user_id AND product_id = :product_id";
    // prepare the sql query
    $stmt = $this->db->prepare($sql);

    // bind the values
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);

    // execute the sql query
    $stmt->execute();

    // fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // return the result
    return $result;

  }


}
