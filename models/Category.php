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


    public function getSubcategoriesByCategoryId(int $categoryId){
        $subCategorie = $this->db->prepare("SELECT id, name FROM sub_categories WHERE category_id=$categoryId");
        $subCategorie->execute([]);
        $result = $subCategorie->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getSubcategoryIdByName(string $subCategoryName){
        $allProducts = $this->db->prepare("SELECT id FROM sub_categories WHERE name = '$subCategoryName'");
        $allProducts->execute([
        ]);
        $result = $allProducts->fetch(PDO::FETCH_ASSOC);
        var_dump($result);
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

}