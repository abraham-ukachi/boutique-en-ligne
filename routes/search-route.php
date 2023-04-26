<?php
namespace  Maxaboom\Routes;
use Maxaboom\Controllers\SearchController;


$router->map('GET', '/search', function() {
    $searchController = new SearchController();
    $searchController->showSearchPage();
});

$router->map('GET', '/search/[a:query]', function($query){
    $searchController = new SearchController();
    $searchController->searchProduct($query);
})
?>
