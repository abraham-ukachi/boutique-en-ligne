<?php

namespace Maxaboom\Routes;
use Maxaboom\Controllers\ReviewController;

use Maxaboom\Models\User;

$router->map( 'GET', '/review/test', function() {
    require __DIR__ . '/../models/test/review.php';
});

$router->map( 'GET', '/api/user/[*:mail]/[a:password]', function($mail, $password) {
    $user = new User();
    $user->connection($mail, $password);
    echo $mail;
});

$router->map( 'GET', '/review/[i:productId]', function($productId) {

    $reviewController = new ReviewController($productId);

    $reviews = $reviewController->getAllReviews();

    $reviewController->showPage();

});