<?php

// declare a namespace  
namespace Maxaboom\Models\Test;

include __DIR__ . "/../helpers/Database.php";
include __DIR__ . "/../Product.php";


use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Product;

$product = new Product();

$productId = 4;

// get product with the `productId`
$productData = $product->getProductById($productId);

echo "TEST of <b>Product.php</b>" . "<br>";
echo "<code>Get product data by id (i.e. product->getProductById())</code> <br>";

// tell us about this product data
//print_r($productData);

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
$stock=3;


/*
//OK register product is working
$product->registerProduct($name, $description, $price, $categories_id,
$sub_categories_id, $stock);

//update img of last product
$lastProduct=$product->getLastId();
var_dump($lastProduct);
echo $lastProduct;

$product->updateImageProduct($lastProduct);
*/

//check price filter
$HpriceProducts = $product->getProductHigherPrice();
$LpriceProducts = $product->getProductLowerPrice();
$dateProducts = $product->getProductByDate();
//$deletedProduct = $product->deleteProductByID(90);
//echo $deletedProduct;

//check date filter

$delpro1 = $product->deleteProductByID(10);
echo $delpro1;
//$verifDelete = $product->verifDeleteProduct(90);
//var_dump($verifDelete);
//echo $verifDelete['deleted_at'];