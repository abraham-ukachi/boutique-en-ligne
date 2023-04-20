<?php
use Maxaboom\Controllers\AdminController;

$router->map( 'GET', '/admin/product/create', function() {
    require __DIR__ . '/../views/admin-product-create-page.php';
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
    $description = $_POST['productdescription'];
    $price = $_POST['productprice'];
    $categories_id = $_POST['category'];
    $sub_categories_id = $_POST['subcategories'];
    $stock = $_POST['productstock'];

     $image = isset($_FILES['image']) ? $_FILES['image'] : '';


    // créer l'objet de la class adminController comme 'adminController'

     $adminController = new AdminController();

    //create product est la method du controller à ne pas confondre avec registerProduct de la Class Product
     $response = $adminController->createProduct($productName,$description, $price, $categories_id, $sub_categories_id, $stock, $image);

    // var_dump($response);

    $response = [ 'success' => true ];
  
    echo json_encode($response);
});



$router->map('GET', '/admin/products', function () {
    $adminController = new AdminController();
    // TODO: do something awesome here before showing the shop page ;)
    // show the shop page
    $adminController->showProductsPage();
});

$router->map('GET', '/admin/product/[i:productId]', function($productId) {
    $adminController = new AdminController();
    $adminController->showOneProductPage($productId);
 
});

$router->map('POST', '/admin/product/update', function() {
    $adminController = new AdminController();
    $productId = $_POST['productId'];
    $productName = $_POST['productname'];
    $description = $_POST['productdescription'];
    $price = $_POST['productprice'];
    $categories_id = $_POST['category'];
    $sub_categories_id = $_POST['subcategories'];
    $stock = $_POST['productstock'];

    $adminController->updateProduct($productId, $productName, $description, $price,
     $categories_id, $sub_categories_id, $stock);
 
});


$router->map('DELETE', '/admin/product/[i:productId]', function($productId) {
    $adminController = new AdminController();
    $response = $adminController->delete($productId);

    echo $response; 
});


//juste pour les test
// TODO: REMOVE AFTER
$router->map( 'GET', '/admin/product/create/test', function() {
    require __DIR__ . '/../models/admin-product-page-test/product.php';
});

