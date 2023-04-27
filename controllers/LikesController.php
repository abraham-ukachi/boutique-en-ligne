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
* @name Likes - Controller 
* @file LikesController.php
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


// declare a namespace
namespace Maxaboom\Controllers;


// use the `User` model
use Maxaboom\Models\User;
// use the `Product` model
use Maxaboom\Models\Product;
// use the `Likes` model
use Maxaboom\Models\Likes;


// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;





// Declare a class that represents the `Likes` controller,
// which is a child of the `Controller` class
class LikesController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;
  
  // declare some constants...
  
  const LIKED_PRODUCTS_LIMIT = 5; // <- the maximum number of liked products to show on the likes page

  // declare some properties...

  // private properties
  private User $user;
  private Product $product;
  private Likes $likes;


  // public properties
  


  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   *
   * @param ?string $theme : the theme to use
   * @param ?string $lang : the language to use
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
   */
  public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
    // call the parent's constructor
    parent::__construct($theme, $lang, $useDefaultBrowserLang);

    // TODO: write something awesome code here ;)
    
    // instantiate some models 
    $this->user = new User();
    $this->product = new Product();
    $this->likes = new Likes();
     
    
    // DEBUG [4dbsmaster]: tell me about the `user` property 
    // var_dump($this->user); 

  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS

  // PUBLIC METHODS


  /**
   * Shows the likes page
   *
   * @return void
   */
  public function showPage(): void {
    // TODO: do something awesome here before showing the home page ;)
    
    // Initialize some variables
    $likedProducts = [];
    $totalLikedProducts = 0;

    // if the user is connected
    if ($this->user->isConnected()) {
      // get a limited list of the user's liked products as `$likedProducts`
      $likedProducts = $this->likes->getAll($this->user->id, 0, $this::LIKED_PRODUCTS_LIMIT);
      
      // get the total number of products liked by the user as `$totalLikedProducts` 
      $totalLikedProducts = $this->likes->countAll($this->user->id);

    } 
    
    // require [once] the home page from the `views` folder
    require_once __DIR__ . '/../views/likes-page.php';
  }


  /**
   * Adds a product to the user's liked products
   *
   * @param int $productId : the id of the product to add to the user's liked products
   * @return void
   */
  public function addToLikes(int $productId): void {
  
  }


  /**
   * Removes a product from the user's liked products
   *
   * @param int $productId : the id of the product to remove from the user's liked products
   * @return void
   */
  public function removeFromLikes(int $productId): void {
    
  }
  
  
  
  // PRIVATE SETTERS


  // PRIVATE GETTERS
  
  // PRIVATE METHODS

};





