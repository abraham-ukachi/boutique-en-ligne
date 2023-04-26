<?php
use Maxaboom\Controllers\AdminController;

// ------------------------for administrate products --------------------
$router->map( 'GET', '/admin', function() {
    $adminController = new AdminController();
    $adminController->count();
 });

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
// $router->map( 'GET', '/admin/product/create/test', function() {
//     require __DIR__ . '/../models/admin-product-page-test/product.php';
// });


//---------------------------for administrate users --------------

$router->map( 'GET', '/admin/users', function() {
    $adminController = new AdminController();
    $adminController->showAllUsers();
});

$router->map('GET', '/admin/user/[i:userId]', function($userId) {
    $adminController = new AdminController();
    $adminController->showOneUserPage($userId);
 
});

$router->map('POST', '/admin/user/update', function() {
    $adminController = new AdminController();
    $userId = $_POST['userId'];
    $userFirstname = $_POST['firstname'];
    $userLastname = $_POST['lastname'];
    $userMail = $_POST['mail'];
    $userRole = $_POST['role'];
    echo $userRole;
    $adminController->updateUser($userId, $userFirstname, $userLastname, $userMail, $userRole);
});

$router->map('DELETE', '/admin/user/[i:userId]', function($userId) {
    $adminController = new AdminController();
    $response = $adminController->userDelete($userId);

    echo $response; 
});

$router->map('GET', '/admin/user/create', function() {
    require __DIR__ . '/../views/admin-users-create-page.php';
});

$router->map('POST', '/admin/user/create', function() {
    $adminController = new AdminController();
    $userFirstname = $_POST['firstname'];
    $userLastname = $_POST['lastname'];
    $userMail = $_POST['mail'];
    $password = $_POST['password'];
    $checkPassword = $_POST['check-password'];
    $userRole = $_POST['role'];
    //echo $userRole;
    $adminController->createUser($userFirstname, $userLastname, $userMail, $password, $checkPassword, $userRole);

    require __DIR__ . '/../views/admin-users-create-page.php';

});


// -------------------------for administrate category -------------------------


$router->map( 'GET', '/admin/categories', function() {

    $adminController = new AdminController();
    $adminController->showAllCategories();
});

$router->map( 'GET', '/admin/category/[i:categoryId]', function($categoryId){
    $adminController = new AdminController();
    $adminController->showOneCategory($categoryId);
});

$router->map( 'POST', '/admin/category/[i:categoryId]', function($categoryId){
    $adminController = new AdminController();
    $name = $_POST['subcategoryName'];
    $titre = $_POST['subcategoryTitre'];
    $adminController->registerNewSubcategory($name, $titre,$categoryId);
});

$router->map('DELETE', '/admin/category/[i:categoryId]', function($categoryId) {
    $adminController = new AdminController();
    $response = $adminController->categoryDelete($categoryId);
    echo $response; 
});


$router->map( 'GET', '/admin/category/create', function() {


    require __DIR__ . '/../views/admin-categories-create-page.php';
 });

 $router->map( 'POST', '/admin/category/create', function() {
    $name = $_POST['categoryName'];
    $titre = $_POST['categoryTitre'];
    $adminController = new AdminController();
    $adminController->registerNewCategory($name, $titre);
    require __DIR__ . '/../views/admin-categories-create-page.php';
 });