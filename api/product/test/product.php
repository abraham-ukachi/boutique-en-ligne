<?php

// PRODUCT TEST

include "../Product.php";

use Api\classProduct as maxaboom;

$product = new maxaboom\Product();

$productId = 3;

// get product with the `productId`
$productData = $product->getProductById($productId);

echo "TEST of <b>Product.php</b>" . "<br>";
echo "<code>Get product data by id (i.e. product->getProductById())</code> <br>";

// tell us about this product data
print_r($productData);




