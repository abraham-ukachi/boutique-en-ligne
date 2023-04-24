<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\Product;
use Maxaboom\Models\Category;
use Maxaboom\Models\User;

class AdminController{


    public object $productModel;
    public object $productCategory;
    public object $userModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->productCategory = new Category();
        $this->userModel = new User();
    }

    //pour enregistrer un nouveau produit
    public function createProduct($productname,$description, $price, $categories_id, $sub_categories_id, $stock, $image){
        $newproduct = New Product();
        $success = $newproduct->registerProduct($productname,$description, $price, $categories_id, $sub_categories_id, $stock);
         $lastId = $newproduct->getLastId();
        
         $tmpName = $image['tmp_name'];
         $name = 'img_' . $lastId . '.png';

         move_uploaded_file($tmpName, 'assets/images/products'.$name);
         $updateNameImage = $newproduct->updateImageProduct($lastId);

         $data = [
             'image_name' => $name,
             'product_id' => $lastId,
             'product_name' => $productname
         ];

         return ['success' => $success, 'data' => $data];
         
    }

    //pour afficher tous les produits
    public function showProductsPage(): void {
        $products = $this->productModel->getAllProducts();
        require __DIR__ . '/../views/admin-products-page.php';
    }


    public function showOneProductPage($productId): void {

        $theProduct = $this->productModel->getProductById($productId);
        $theCategoryId = $theProduct['categories_id'];
        $theProductCategoryName = $this->productCategory->getCategoryById($theCategoryId);
        $theSubCategoryId = $theProduct['sub_categories_id'];
        $theProductSubCategoryName = $this->productCategory->getSubcategoryNameById($theSubCategoryId);
        require __DIR__ . '/../views/admin-product-details-page.php';
    }

    public function updateProduct($id,$productname,$description, $price, $categories_id, $sub_categories_id, $stock){
        $newproduct = New Product();
        $success = $newproduct->updateProduct($id, $productname, $description, $price, $categories_id, $sub_categories_id, $stock);
    }

    public function delete($idProduct){
        $deleteProduct = New Product();
        return $deleteProduct->deleteProductByID($idProduct);
    }

    //functions for users management

    public function showAllUsers(){
        $users = new User();
        $allUsers = $users->displayUsers();
        require __DIR__ . '/../views/admin-users-page.php';
    }

    public function showOneUserPage($userId){
        $oneUser=$this->userModel->getUserInfo($userId);
        require __DIR__ . '/../views/admin-user-details-page.php';
    }

    public function count(){
        $countUsers=$this->userModel->usersCount();
        $countProducts=$this->productModel->productsCount();
        require __DIR__ . '/../views/admin-home-page.php';

    }

    public function updateUser($userId, $userFirstname, $userLastname, $userMail, $userRole){
        $success=$this->userModel->updateUser($userId, $userFirstname, $userLastname, $userMail, $userRole);
    }

    public function userDelete($userId){
        $deleteUser = New User();
        return $deleteUser->deleteUser($userId);
    }

    public function createUser($userFirstname, $userLastname, $userMail, $password, $checkPassword, $userRole){
        $createUser=$this->userModel->createUser($userFirstname, $userLastname, $userMail, $password, $checkPassword, $userRole);
        require __DIR__ . '/../views/admin-users-create-page.php';
    }

    //function for categories management

    public function showAllCategories(){
        $allCategories=new Category();
        $categories=$allCategories->getAllCategories();
        $subcategories=$allCategories->getAllSubCategories();
        require __DIR__ . '/../views/admin-categories-page.php';
    }

    public function showOneCategory($categoryId){
        $oneCategoryName=$this->productCategory->getCategoryById($categoryId);
        $oneCategoryTitre=$this->productCategory->getCategoryTitreById($categoryId);
        $specificSubCategories=$this->productCategory->getSubcategoriesByCategoryId($categoryId);
        require __DIR__ . '/../views/admin-category-details-page.php';   
    }

    public function registerNewSubcategory($name, $titre, $categoryId){
        $newSubCategory=$this->productCategory->registerSubCategory($name, $titre,$categoryId);
    }

    public function categoryDelete($idSubCategory){
        return $this->productCategory->deleteSubCategory($idSubCategory);
    }

    public function registerNewCategory($name, $titre){
        $newCategory=$this->productCategory->registerCategory($name, $titre);
    }


}