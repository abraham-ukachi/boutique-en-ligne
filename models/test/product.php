<?php

// declare a namespace  
namespace Maxaboom\Models\Test;

include "../helpers/Database.php";
include "../Product.php";


use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Product;

$product = new Product();

$productId = 4;

// get product with the `productId`
$productData = $product->getProductById($productId);

echo "TEST of <b>Product.php</b>" . "<br>";
echo "<code>Get product data by id (i.e. product->getProductById())</code> <br>";

// tell us about this product data
print_r($productData);

// get all infos of all products
$allProducts = $product->getAllProducts();
//var_dump($allProducts);

//get all infos of products in a specific categorie
$productPiano = $product->productsCategories(1);
//var_dump($productPiano);

$productBass = $product->subCategorie(6);
//var_dump($productBass);

$name="Super Guitare";
$description="C'est vraiment une belle guitare";
$price=23400;
$categories_id=2;
$sub_categories_id=5;
$image='newimage.png';
$stock=3;

$product->registerProduct($name, $description, $price, $categories_id,
$sub_categories_id, $stock);
$lastId=$product->getLastId();
var_dump($lastId);
//echo $lastId[0]['MAX(id)'];


