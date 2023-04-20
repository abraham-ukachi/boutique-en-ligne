<?php
/**
 * @license MIT
 * boutique-en-ligne (maxaboom)
 * Copyright (c) 2023 Abraham Ukachi, Axel Vair, Morgane Marechal, Catherine Tranchand. The Maxaboom Project Contributors.
 * All rights reserved.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 * @project boutique-en-ligne
 * @name API - Route
 * @file api-route.php
 * @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
 * @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
 * @version: 0.0.1
 *
 * Usage:
 *   1+|> // user authentication
 *    -|>
 *    -|> let response = await fetch(`api/user/auth`, {
 *    -|>   method: 'POST',
 *    -|>   headers: {
 *    -|>     'Content-Type': 'application/json'
 *    -|>   },
 *    -|>   body: JSON.stringify({email, password})
 *    -|> });
 *    -|>
 *    -|> let isJson = response.header.get('Content-Type').includes('application/json');
 *    -|> response = isJson ? await response.json() : await response.text();
 *    -|>
 *    -|> if (response.status === 'success') {
 *    -|>   // do something
 *    -|> } else {
 *    -|>   // do something else
 *
 */


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare a namespace
namespace Maxaboom\Routes;

// use maxaboom's `APIController` class
use Maxaboom\Controllers\APIController;

use Maxaboom\Models\Category;
use Maxaboom\Models\Product;


/**
 * API - Route
 */


/**
 * Router used to authenicate the user
 *
 * @method POST
 * @action /api/user/auth
 *
 * @param string $email - the user's email
 * @param string $password - the user's password
 *
 * @echo json $response - the response in json format
 */
$router->map('GET', '/api/user/auth/[a:email]/[a:password]', function (string $email, string $password) {
    // get the api controller
    $apiController = new APIController();

    // call the user authentication method
    $response = $apiController->authUser($email, $password);

    // echo the response
    echo $response;
});


$router->map('GET', '/test/[a:name]?', function ($name) {
    echo "<p><b>TEST</b>: <code>name: $name</code></p>";
});

//url exemple : '/api/sub_categories/2'
$router->map('GET', '/api/sub_categories/[i:categoryId]', function (int $categoryId) {
    $categoryModel = new Category();
    $subCategories = $categoryModel->getSubcategoriesByCategoryId($categoryId);
    echo json_encode($subCategories);
});


$router->map('GET', '/api/products/[i:categoryId]/[i:subCategoryId]?', function (int $categoryId, ?int $subCategoryId = null) {
    $productModel = new Product();
    if ($subCategoryId) {
        $products = $productModel->getProductsBySubCategoryId($subCategoryId);

    } else {
        $products = $productModel->getProductsByCategoryId($categoryId);
    }
    echo json_encode($products);

});



