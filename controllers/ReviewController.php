<?php
namespace Maxaboom\Controllers;

use Maxaboom\Models\Review;

class ReviewController{

    public int $productId;

    public object $reviewModel;

    public function __construct($productId) {
        $this->productId = $productId;

        $this->reviewModel = new Review();

    }

    public function showPage($reviews){
        require __DIR__ . '/../views/review-page.php';
    }

    public function getAllReviews() {
        $allReviews = $this->reviewModel->getReviewsByProductId($this->productId);

        // do something with $allReviews

        return $allReviews;

        //fetch('api/user/login/axel/2343')
    }

}