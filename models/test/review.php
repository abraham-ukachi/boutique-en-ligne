<?php

namespace Maxaboom\Models\Test;

use Maxaboom\Models\Review;


$review = new Review();
$review->getReviewsByProductId(1);
echo($review->getComment());




/*
$comment = 'jadore ce produit !';
$user_id = 1;
$product_id = 1;
$ratings = 4.0;
$insertReview = new Maxaboom\Models\Review();
$created_at = date('Y-m-d H:i:s');

$insertReview->insertReview($comment, $user_id, $product_id, $ratings, $created_at);
*/