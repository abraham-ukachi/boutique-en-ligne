<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Product;
use PDO;

class ProductController extends Database
{
    const DEFAULT_THEME = 'light';

    public object $productModel;
    public ?int $productId;
    public ?array $productReview;

    public function __construct(?int $productId = null, ?array $productReview = null)
    {
        $this->productModel = new Product();
        $this->productId = $productId;
        $this->productReview = $productReview;

    }

    /**
     * Function for show one article
     * @param $productId
     *
     */
    public function showPageOneProduct($theme = self::DEFAULT_THEME):void
    {
        $productId = $this->productModel->getProductById($this->productId);
        $productReview = $this->productModel->getReviewByProductId($this->productId);
        require_once __DIR__ . '/../views/product-page.php';
    }
}