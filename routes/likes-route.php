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
* @name Likes - Route
* @file likes-route.php
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

// use maxaboom's `LikesController` class
use Maxaboom\Controllers\LikesController;





/**
 * ============================
 *  Likes Routes
 * ============================
 */






/**
 * Route used to display the 'likes' page
 * 
 * @method GET
 * @url /likes
 *
 */
$router->map('GET', '/likes', function(): void {

  // create an object of `LikesController` class
  $likesController = new LikesController();

  // show the likes page
  $likesController->showPage();

});


/**
 * Route used to add a product to the user's likes
 *
 * @method POST
 * @url /likes/[i:productId]
 *
 * @param int $productId
 */
$router->map('POST', '/likes/[i:productId]', function($productId): void {

  // create an object of `LikesController` class
  $likesController = new LikesController();
  
  // add the given product to the user's likes
  $response = $likesController->addToLikes($productId);

  // return the response
  echo json_encode($response);

});


/**
 * Route used to remove a product from the user's likes
 *
 * @method DELETE
 * @url /likes/[i:productId]
 *
 * @param int $productId
 */
$router->map('DELETE', '/likes/[i:productId]', function($productId): void {
  
    // create an object of `LikesController` class
    $likesController = new LikesController();

    // remove the given product from the user's likes
    $response = $likesController->removeFromLikes($productId);
     
    // return the response
    echo json_encode($response);
  
  });






