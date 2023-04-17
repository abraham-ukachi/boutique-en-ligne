<?php
namespace Maxaboom\Controllers;
use Maxaboom\Models\Product;

class AdminController{

    public function registerProduct($productname,$description, $price, $categories_id, $sub_categories_id, $stock){
        $newproduct = New Product();
        $success = $newproduct->registerProduct($productname,$description, $price, $categories_id, $sub_categories_id, $stock);

        return ['success' => $success];

    }
}