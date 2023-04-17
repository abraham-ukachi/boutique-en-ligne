<?php
use Maxaboom\Controllers\AdminController;
$router->map( 'GET', '/admin/product/create', function() {
    require __DIR__ . '/../views/admin-product-page.php';
});


// $router->map('POST', '/admin/product/create', function() {
//     $bodyJSONString = file_get_contents('php://input');

//     $bodyJSON = json_decode($bodyJSONString);

//     $bodyData = (array) $bodyJSON;

//     $productImage = $bodyData['image'] ?? [];
//     $productImageName = $productImage['name'] ?? 'nn';


//     $data = [
//         'name' => $bodyData['name'],
//         'productImageName' => $productImageName,
//         'files' => $_FILES
//     ];

//     $response = ['success' => true, 'data' => $data];

//     echo json_encode($response);
// });



$router->map('POST', '/admin/product/create', function() {

    $productName = $_POST['productname'];

    $fileName = isset($_FILES['image']) ? $_FILES['image']['name'] : '';


    $data = [
        'productName' => $productName,
        'fileName' => $fileName
    ];


    $response = array(
        'success' => true, 
        'data' => $data
    );

    echo json_encode($response);
});





//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/admin/product/create/test', function() {
    require __DIR__ . '/../models/admin-product-page-test/product.php';
});

