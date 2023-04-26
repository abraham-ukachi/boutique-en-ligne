<?php

namespace Maxaboom\Models;

use Maxaboom\Models\Helpers\Database;
use datetime;
use PDO;
use PDOException;

class Category extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->dbConnect();
    }


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

}
