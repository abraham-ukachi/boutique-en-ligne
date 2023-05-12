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
* @name Product - Controller 
* @file ProductController.php
* @author: Axel Vair <axel.vair@laplateforme.io>
* @contributors: Abraham Ukachi <abraham.ukachi@laplateforme.io>, Morgane Marechal <morgane.marechal@laplateforme.io>, Catherine Tranchand <catherine.tranchand@laplateforme.io>
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


namespace Maxaboom\Controllers;

use Maxaboom\Models\Product;
use Maxaboom\Models\Review;
use Maxaboom\Models\User;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;

// Create a class that represents the product controller
class ProductController extends controller 
{
  // Use the `ResponseHandler` trait
  use ResponseHandler;

  // Define some constants


  // Define some properties
  public Product $productModel;
  public Review $reviewModel;
  public User $user;

  // public ?int $productId;
  // public ?array $productReview;

  /**
   * Constructor of the class
   * This method is executed automatically whenever this class is instantiated
   *
   * @param ?string $theme : the theme to use
   * @param ?string $lang : the language to use
   * @param bool $useDefaultBrowserLang : whether or not to use the default browser language
   */
  //public function __construct(?int $productId = null, ?array $productReview = null)
  public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true) {
    // call the parent's constructor
    parent::__construct($theme, $lang, $useDefaultBrowserLang);
    
    // Instantiate some models
    $this->productModel = new Product();
    $this->reviewModel = new Review();
    $this->user = new User();

    // $this->productId = $productId;
    // $this->productReview = $productReview;

  }

    /**
     * Function for show one product
     *
     * @param int $productId - id of the product
     */
    public function showPageOneProduct(int $productId):void
    {
        $product = $this->productModel->getProductById($productId);
        $productReview = $this->reviewModel->getReviewsByProductId($productId);
        $user = $this->user->getInitials();
  
        require __DIR__ . '/../views/product-page.php';

        // var_dump($product);
        // var_dump($productId);
    }
}
