<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\Product;
use Maxaboom\Models\Category;

class AdminController{


    public object $productModel;
    public object $productCategory;

    public function __construct() {
        $this->productModel = new Product();
        $this->productCategory = new Category();

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


}