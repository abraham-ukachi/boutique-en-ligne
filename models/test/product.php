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




