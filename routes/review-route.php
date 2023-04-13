<?php

namespace Maxaboom\Routes;


$router->map( 'GET', '/review/test', function() {
    require __DIR__ . '/../models/test/review.php';
});

$router->map( 'GET', '/review', function() {
    require __DIR__ . '/../views/review-page.php';
});