<?php
namespace Maxaboom\Controllers;

use Maxaboom\Models\Review;
// add
class ReviewController {

    public int $productId;

    public object $reviewModel;

    public function __construct($productId) {
        $this->productId = $productId;

        $this->reviewModel = new Review();

    }

    public function showPage($reviews){
        require __DIR__ . '/../views/review-page.php';
    }

    public function createReview($comment, $user_id, $product_id, $ratings){
        $response = $this->reviewModel->insertReview($comment, $user_id, $product_id, $ratings);
        if($response['success'] = true){
            $reviewId = $response['data']['review_id'];
            $response['data'] = $this->reviewModel->getReviewById($reviewId);
        }
        return $response;
    }

    public function getAllReviews() {
        $allReviews = $this->reviewModel->getReviewsByProductId($this->productId);
        // do something with $allReviews
        return $allReviews;
        //fetch('api/user/login/axel/2343')
    }

}