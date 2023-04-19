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
 * @name Shop - Route
 * @file shop-route.php
 * @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
 * @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
 * @version: 0.0.1
 *
 * Usage:
 *   1+|> //
 *    -|>
 */


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/


// declare the `routes` namespace
namespace Maxaboom\Routes;


// use maxaboom's `ShopController` class
use Maxaboom\Controllers\ShopController;
//use Maxaboom\Models\Product;

/**
 * Home - Route
 */


/**
 * Route used to display the splash, welcome or home view
 *
 * @method GET
 * @url /shop
 *
 * @echo string $shopPage - the shop page
 */
$router->map('GET', '/shop', function (): void {
    // instantiate the `ShopController` class as `$shopController`
    $shopController = new ShopController();
    // show the shop page
    $shopController->showPage();
});

/** Route used for filter products by categories
 *
 *@method GET
 *@url /shop/category
 *
 */


$router->map('GET', '/shop/[a:categoryName]/[:subCategoryName]', function ($categoryName, $subCategoryName){
    $subCategoryName = str_replace('-', ' ', $subCategoryName);
    $shopController = new ShopController($categoryName, $subCategoryName);
    $shopController->showPageBySubCategory();
});

$router->map('GET', '/shop/[a:categoryName]', function ($categoryName){
    $filterByCategory = new ShopController($categoryName);
    $filterByCategory->showPageByCategory();
});







