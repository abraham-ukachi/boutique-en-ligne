<?php

namespace Maxaboom\Routes;
use Maxaboom\Controllers\ReviewController;
use Maxaboom\Models\Review;
use Maxaboom\Models\User;

// add
$router->map( 'GET', '/review/test', function() {
    $review = new Review();
    $review->getReviewsByProductId();
    require __DIR__ . '/../models/test/review.php';
});

$router->map( 'GET', '/api/user/[*:mail]/[a:password]', function($mail, $password) {
    $user = new User();
    $user->connection($mail, $password);
    echo $mail;
});

$router->map( 'GET', '/review/[i:productId]', function($productId) {

    $reviewController = new ReviewController($productId);

    //$reviews = $reviewController->getAllReviews();
    $reviews = $reviewController->reviewModel->getReviewsByProductId($productId);

    //echo "reviews = " . json_encode($reviews);

    $reviewController->showPage($reviews);

});

$router->map('POST', '/review', function() {
    $comment = $_POST['review-input'];
    $userModel = new User();
    $user = $userModel->id;
    $productId = $_POST['product-id'];
    $ratings = $_POST['etoiles'];
    $reviewController = new ReviewController($productId);
    $response = $reviewController->createReview($comment, $user, $productId, $ratings);
    echo json_encode($response);
});