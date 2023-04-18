<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\Product;

class AdminController{


    public object $productModel;

    public function __construct() {
        $this->productModel = new Product();
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
    public function showProductPage() :void {

        $products = $this->productModel->getAllProducts();

        require __DIR__ . '/../views/admin-product-page.php';
    }


}