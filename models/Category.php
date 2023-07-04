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
* @name User - Model
* @test test/user_model.php
* @file User.php
* @author: Morgane Marechal <morgane.marechal@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Axel Vair <axel.vair@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Example usage:
*   
*   1+|> // Create a new category
*    -|>
*    -|> $category = Category::create([
*    -|>   'title' => 'Guitars',
*    -|>   'name' => 'guitars',
*    -|>   'is_top' => 1
*    -|>   'image' => 'guitars.jpg'
*    -|> ]);
*    -|>
*   o=|> echo $category->id; // 2
*    -|>
*
*   2+|> // Find a category by id
*    -|>
*    -|> $category = Category::find(2);
*    -|>
*   o=|> echo $category->name; // guitars
*    -|>
*
*   3+|> // Get all categories
*    -|>
*    -|> $categories = Category::all();
*    -|>
*    -|> foreach ($categories as $category) {
*    -|>   echo $category->name;
*    -|> }
*    -|>
*/



// declare a namespace for this User class
namespace Maxaboom\Models;

// use these classes
use datetime;
use PDO;
use PDOException;

/**
 * Class Category / Category Model
 * A class that represents the `categories` table in the database.
 */
class Category extends Model {

  // Define some properties here ;)
  
  // protected properties

  /**
   * The table associated with this model
   *
   * @var string
   */
  protected string $table = 'categories';



  /**
    * Indicates if the model should automatically connect to the database.
    *
    * @var bool
    */
  protected bool $autoConnect = true;


  /**
   * All the supported fields in the `categories` table
   * @var array
   */
  protected array $fields = [
    'id',
    'title',
    'name',
    'is_top',
    'image'
  ];


  // public properties
  public ?int $id = null;
  public ?string $title = null;
  public ?string $name = null;
  public ?bool $is_top = null;
  public ?string $image = null;


  /**
   * Indicates if the model should be timestamped.
   *
   * @var bool
   */
  public bool $timestamps = false;


  

  /**
   * Category constructor.
   * NOTE: This constructor is called automatically when the class is instantiated
   */
  public function __construct() {
    // call the parent Model constructor
    parent::__construct();

  }


  // PUBLIC STATIC SETTERS

  // PUBLIC STATIC GETTERS

  // PUBLIC STATIC METHODS


  
  
  
  
  // PUBLIC SETTERS
  
  // PUBLIC GETTERS
  
  // PUBLIC METHODS

  
    public function getAllCategories(): array {
        $allProducts = $this->db->prepare("SELECT * FROM categories");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    

    public function getCategoryIdByName(string $categoryName): int {
        $allProducts = $this->db->prepare("SELECT id FROM categories WHERE name = '$categoryName'");
        $allProducts->execute([
]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

 
    public function getCategoryById(int $categoryId): string {
        $allProducts = $this->db->prepare("SELECT name FROM categories WHERE id = $categoryId");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        return $result['name'];
    }

    public function getCategoryTitreById(int $categoryId): string {
        $allProducts = $this->db->prepare("SELECT titre FROM categories WHERE id = $categoryId");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        return $result['titre'];
    }

    public function getSubcategoriesByCategoryId(int $categoryId) {
        $subCategorie = $this->db->prepare("SELECT id, name, titre FROM sub_categories WHERE category_id=$categoryId");
        $subCategorie->execute([]);
        $result = $subCategorie->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSubcategoryIdByName(string $subCategoryName){
        $allProducts = $this->db->prepare("SELECT id FROM sub_categories WHERE name = '$subCategoryName'");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        return $result['id'];
    }

    public function getSubcategoryNameById(string $subCategoryId){
        $allProducts = $this->db->prepare("SELECT name FROM sub_categories WHERE id = '$subCategoryId'");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result['name'];
    }

    public function getAllSubCategories(){
        $subCategories = $this->db->prepare("SELECT id, name FROM sub_categories");
        $subCategories->execute([]);
        $result = $subCategories->fetchAll(PDO::FETCH_ASSOC);
        $allSubCategories = $result;
        return $allSubCategories;
    }

    public function createSubCategory($categoryId){
        $sql = "INSERT INTO products (name, description, price, categories_id,
        sub_categories_id, created_at, stock)
                VALUES (:name, :description, :price, :categories_id, :sub_categories_id, :created_at, :stock)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'name' => htmlspecialchars($name),
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouvelle sous-catégorie enregistrée']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }

    public function registerSubCategory($name, $titre, $categoryId){
        $sql = "INSERT INTO sub_categories (name, titre, category_id)
                VALUES (:name, :titre, :category_id)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'name' => htmlspecialchars($name),
            'titre' => htmlspecialchars($titre),
            'category_id' => $categoryId,
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouvelle catégorie enregistrée']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }


    public function deleteSubCategory($idSubCategory){
        $sql="DELETE FROM sub_categories WHERE id = :idsubcategory";
$sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'idsubcategory' => $idSubCategory
        ]);         
        if ($sql_exe) {
            return json_encode(['response' => 'ok', 'reussite' => 'Catégorie supprimée']);
        } else {
            return json_encode(['response' => 'not ok', 'echoue' => 'Problème']);
        }
    }


    public function registerCategory($name, $titre){
        $sql = "INSERT INTO categories (name, titre)
                VALUES (:name, :titre)";
        $sql_exe = $this->db->prepare($sql);
        $sql_exe->execute([
            'name' => htmlspecialchars($name),
            'titre' => htmlspecialchars($titre),
        ]);         
        if ($sql_exe) {
            echo json_encode(['response' => 'ok', 'reussite' => 'Nouvelle catégorie enregistrée']);
        } else {
            echo json_encode(['response' => 'not ok', 'echoue' => 'Problème enregistrement']);
        }
    }




  // PRIVATE STATIC SETTERS

  // PRIVATE STATIC GETTERS

  // PRIVATE STATIC METHODS




  // PRIVATE SETTERS
  
  // PRIVATE GETTERS
  
  // PRIVATE METHODS
  

}
