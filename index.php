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
* @name Main / Router - Maxaboom
* @file index.php
* @author: Abraham Ukachi <abraham.ukachi@laplateforme.io>
* @contributors: Axel Vair <axel.vair@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
* @version: 0.0.1
* 
* Usage:
*   1+|> // how-to route with AltoRouter ;)
*    -|>
*
*/


/*
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
* MOTTO: We'll always do more 😜!!!
* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
*/

// ---===--- enabling error reporting ---====---
error_reporting(E_ALL);
ini_set("display_errors", 1);
// ---===---===---===---===---===---===---===---


// require the autoloader
require __DIR__ . '/vendor/autoload.php';
//require __DIR__ . '/vendor/altorouter/';

session_start();


// defining some constants...

const APP_NAME = 'boutique-en-ligne';
// home or base directory of Maxaboom
const MAXABOOM_HOME_DIR = '/' . APP_NAME;








// Create an altorouter instance named `$router`
$router = new AltoRouter();

// Set the base path of the router
$router->setBasePath(MAXABOOM_HOME_DIR);



// Now, let's add some routes to our router ;)


// Include these routes
include __DIR__ . '/routes/home-route.php'; // <- home route
include __DIR__ . '/routes/shop-route.php'; // <- shop route
include __DIR__ . '/routes/api-route.php'; // <- api route
include __DIR__ . '/routes/product-route.php'; // <- product route
include __DIR__ . '/routes/search-route.php'; // <- search route
include __DIR__ . '/routes/checkout-route.php'; // <- checkout route

include __DIR__ . '/routes/login-route.php'; //<- login route
include __DIR__ . '/routes/register-route.php'; //<- register route

include __DIR__ . '/routes/address-route.php'; // <- address route
include __DIR__ . '/routes/review-route.php'; // <- review route
include __DIR__ . '/routes/cards-route.php'; // <- address route

include __DIR__ . '/routes/admin-route.php'; // <- admin route
include __DIR__ . '/routes/account-route.php'; // <- account route
include __DIR__ . '/routes/component-route.php'; // <- component route
include __DIR__ . '/routes/cart-route.php'; // <- cart route
include __DIR__ . '/routes/likes-route.php'; // <- likes route



// match the current request url
$match = $router->match();

// var_dump($match);

// echo "<br>";


// call closure or throw 404 status
if(is_array($match) && is_callable($match['target'])) {
  call_user_func_array($match['target'], $match['params']);
} else {
  // TODO: Create a 404 view / page to handle this

	// no route was matched
	header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}

