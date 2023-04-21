<?php
namespace Maxaboom\Routes;
use Maxaboom\Controllers\ProductController;

$router->map( 'GET', '/product', function() {
    require __DIR__ . '/../views/product-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/product/test', function() {
    require __DIR__ . '/../models/test/product.php';
});

$router->map('GET', '/product/[i:productId]', function($productId){
    $showProduct = new ProductController($productId);
    $showProduct->showPageOneProduct();
});

$router->map( 'GET', '/product', function() {
    require __DIR__ . '/../views/product-page.php';
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/product/test', function() {
    require __DIR__ . '/../models/test/product.php';
});

$router->map('GET', '/product/[i:productId]', function($productId){
    $showProduct = new ShopController($productId);
    $showProduct->showOneProductPage($productId);
});