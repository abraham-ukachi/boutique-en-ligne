<?php
// declare a namespace  
namespace Maxaboom\Models\Test;

include __DIR__ . "/../helpers/Database.php";
include __DIR__ . "/../Category.php";


use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Category;

echo "<h1>TEST FOR CATEGORY CLASS</h1><br>";
$category = New Category();
$categories = $category->getAllCategories();
print_r($categories);
echo "<br>";
$categoryIdByName = $category->getCategoryIdByName('pianos');
print_r($categoryIdByName);
echo $categoryIdByName;
echo "<br>";
 $getCategoryById = $category->getCategoryById(2);
 echo $getCategoryById;
 echo "<br>";
 $getSubcategoriesByCategoryId = $category->getSubcategoriesByCategoryId(2);
 print_r($getSubcategoriesByCategoryId);
 $getSubcategoryIdByName = $category->getSubcategoryIdByName('basse');
 echo $getSubcategoryIdByName;

