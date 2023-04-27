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
* @name Home - Controller 
* @file HomeController.php
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
// use the `Category` model
use Maxaboom\Models\Category;
// use the `Cart` model
use Maxaboom\Models\Cart;


// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;





// Declare a class that represents the `Home` controller,
// which is a child of the `Controller` class
class HomeController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;
  
  // declare some constants...

  // actions 

  // screens
  const SCREEN_SPLASH = 'splash';
  const SCREEN_WELCOME = 'welcome';

  // pages
  const PAGE_HOME = 'home';

  // sections
  const HERO_PRODUCTS_LIMIT = 5; // <- the number of products to display in the hero section
  const LATEST_PRODUCTS_LIMIT = 8; // <- the number of products to display in the latest products section
  const POPULAR_PRODUCTS_LIMIT = 8; // <- the number of products to display in the popular products section
  const CHEAPEST_PRODUCTS_LIMIT = 8; // <- the number of products to display in the cheapest products section

  // top categories
  const TOP_CATEGORY_PIANOS = 'pianos';
  const TOP_CATEGORY_GUITARS = 'guitars';
  const TOP_CATEGORY_DRUMS = 'percussion';
  const TOP_CATEGORY_VIOLINS = 'violin';
  const TOP_CATEGORY_DJ = 'dj';
  const TOP_CATEGORY_WIND_INSTRUMENTS = 'wind-instruments';

  // defaults
  const DEFAULT_AVG_RATING = 4.5; // <- the default average rating to use when there is no rating
  const DEFAULT_NB_COMMENTS = 0; // <- the default number of comments to use when there is no comment  

  // declare some properties...

  // private properties
  private User $user;
  private Product $product;
  private Category $category;
  private Cart $cart;


  // public properties
  // splash & welcome screen timeous
  public int $splashScreenTimeout = 30; // <- in seconds
  public int $welcomeScreenTimeout = 30; // <- in seconds
  


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
    $this->category = new Category();
    $this->cart = new Cart();
     
    
    // DEBUG [4dbsmaster]: tell me about the `user` property and display all the users
    // var_dump($this->user); 
    // var_dump($user->displayUsers());

  }


  // PUBLIC SETTERS
  // PUBLIC GETTERS

  /**
   * Method used to return a greeting based on the current hour
   *
   * @param string $timezone : the timezone to use
   *
   * @return string
   */
  public function getCurrentGreeting($timezone = 'Europe/Paris'): string {
    // set the default timezone
    date_default_timezone_set($timezone);

    // get the current hour
    $currentHour = (int) date('H');

    /* DEBUG [4dbsmaster]: tell me about the current hour */
    // var_dump($currentHour);
    
    // return the greeting based on the current hour
    if ($currentHour >= 0 && $currentHour < 12) {
      return $this->i18n->getString('gm');
    } else if ($currentHour >= 12 && $currentHour < 18) {
      return $this->i18n->getString('ga');
    } else {
      return $this->i18n->getString('ge');
    }
  }


  /**
   * Returns a list of the top categories
   * 
   * @param int $limit : the number of categories to return
   *
   * @return array 
   */
  public function getTopCategories($limit = 6): array {
    // get all the categories from the database
    $categories = $this->category->getAllCategories();
    // slice `categories` to get only the first `$limit` categories as `topCategories`
    $topCategories = array_slice($categories, 0, $limit);
    
    // return `topCategories`
    return $topCategories;
  }


  /**
   * Returns a list of the easy-to-follow steps of Maxaboom ;)
   *
   * @return array 
   */
  public function getSteps(): array {
    // Create an multi-dimensional array of steps as `result` and return it
    $result = Array(
      
      [ 
        "id" => "search", 
        "title" => $this->i18n->getString('stepSearchTitle'),
        "description" => $this->i18n->getString('stepSearchDescription'),
      ], // <- step 1: search


      [ 
        "id" => "tap", 
        "title" => $this->i18n->getString('stepTapTitle'),
        "description" => $this->i18n->getString('stepTapDescription'),
      ], // <- step 2: tap


      [ 
        "id" => "play", 
        "title" => $this->i18n->getString('stepPlayTitle'),
        "description" => $this->i18n->getString('stepPlayDescription'),
      ] // <- step 3: play


    );

    // return the result
    return $result;
  }

  // PUBLIC METHODS

  /**
   * Method used to get the total number of the cart products
   * NOTE: If the user is connected, the total will be retrieved from the database
   * NOTE: If the user is not connected, the total will be retrieved from the `cart` session variable
   *
   * @return int : the total number of the cart products
   *
   * @return int
   */
  public function getCartCount(): int {
    // get the cart count from the cart model
    return $this->user->isConnected() ? $this->cart->countAll($this->user->id) : count($_SESSION['cart'] ?? []);
  }

  

  /**
   * Shows the splash screen
   *
   * @return void
   */
  public function showSplashScreen(): void {
    // TODO: do something awesome here before showing the splash screen ;)

    // require [once] the splash screen from the `views` folder
    require_once __DIR__ . '/../views/splash-screen.php';

    // set the splash screen timestamp to the current timestamp 
    $this->setSplashScreenTimestamp($this->currentTimestamp() + $this->splashScreenTimeout);
  }


  /**
   * Shows the welcome screen
   *
   * @return void
   */
  public function showWelcomeScreen(): void {
    // TODO: do something awesome here before showing the welcome screen ;)

    // require [once] the welcome screen from the `views` folder
    require_once __DIR__ . '/../views/welcome-screen.php';

    // set the welcome screen timestamp to the current timestamp 
    $this->setWelcomeScreenTimestamp($this->currentTimestamp() + $this->welcomeScreenTimeout);
  }


  /**
   * Shows the home page
   *
   * @return void
   */
  public function showHomePage(): void {
    // TODO: do something awesome here before showing the home page ;)

    // get 5 random products from the database as `$heroProducts`
    $heroProducts = $this->product->getRandomProducts($this::HERO_PRODUCTS_LIMIT);

    // get all steps as `$steps`
    $steps = $this->getSteps();
    
    // get top categories as `$topCategories`
    $topCategories = $this->getTopCategories();

    // get a list of the latest products as `$latestProducts`
    $latestProducts = $this->product->getLatestProducts($this::LATEST_PRODUCTS_LIMIT);
    // $latestProducts = $this->product->getProductsByDate($this::LATEST_PRODUCTS_LIMIT);

    $cartCount = $this->getCartCount();
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    // var_dump($latestProducts);

    // TODO: get a list of the most popular products as `$popularProducts`
    $popularProducts = $this->product->getPopularProducts($this::POPULAR_PRODUCTS_LIMIT);
    // $popularProducts = [];
    
    // TODO: get a list of the cheapest products as `$cheapestProducts`
    // $cheapestProducts = $this->product->getCheapestProducts($this::CHEAPEST_PRODUCTS_LIMIT);
    $cheapestProducts = $this->product->getProductLowerPrice($this::CHEAPEST_PRODUCTS_LIMIT);
    
    // DEBUG [4dbsmaster]: tell me about it ;)
    //var_dump($topCategories);

    // require [once] the home page from the `views` folder
    require_once __DIR__ . '/../views/home-page.php';
  }


  

  /**
   * Checks if the splash screen should be displayed
   * NOTE: This method checks if the current timestamp is greater than or equal to the splash-screen timestamp
   *
   * @return bool : whether or not the splash screen should be displayed
   */
  public function checkSplashScreen(): bool {
    // get the splash screen timestamp as `$splashScreenTimestamp`
    $splashScreenTimestamp = $this->getSplashScreenTimestamp();
    // get the current timestamp as `$currentTimestamp`
    $currentTimestamp = $this->getCurrentTimestamp();

    // return whether or not the `$currentTimestamp` is greater than or equal to the `$splashScreenTimestamp`
    return $currentTimestamp >= $splashScreenTimestamp;
  }

  

  /**
   * Checks if the welcome screen should be displayed
   * NOTE: This method checks if the current timestamp is greater than or equal to the welcome-screen timestamp
   *
   * @return bool : whether or not the splash screen should be displayed
   */
  public function checkWelcomeScreen(): bool {
    // get the welcome screen timestamp as `$welcomeScreenTimestamp`
    $welcomeScreenTimestamp = $this->getWelcomeScreenTimestamp();

    // get the current timestamp as `$currentTimestamp`
    $currentTimestamp = $this->getCurrentTimestamp();

    // return whether or not the `$currentTimestamp` is greater than or equal to the `$welcomeScreenTimestamp`
    return $currentTimestamp >= $welcomeScreenTimestamp;
  }

  

  
  
  // PRIVATE SETTERS


  /**
   * Sets the splash screen timestamp 
   *
   * @param int $timestamp : the timestamp to set 
   *
   * @return void
   * @private
   */
  private function setSplashScreenTimestamp($timestamp): void {
    // if there's a `config` session variable...
    if (isset($_SESSION['config'])) {
      // ...then set the `splashScreenTimestamp` property of the `config` session variable
      $_SESSION['config']['splashScreenTimestamp'] = $timestamp;
       
      // TODO: create & update the `splashScreenTimestamp` property of the class
      // $this->splashScreenTimestamp = $timestamp;
    }

  }

  /**
   * Sets the welcome screen timestamp 
   *
   * @param int $timestamp : the timestamp to set 
   *
   * @return void
   * @private
   */
  private function setWelcomeScreenTimestamp($timestamp): void {
    // if there's a `config` session variable...
    if (isset($_SESSION['config'])) {
      // ...then set the `welcomeScreenTimestamp` property of the `config` session variable
      $_SESSION['config']['welcomeScreenTimestamp'] = $timestamp;
       
      // TODO: create & update the `welcomeScreenTimestamp` property of the class
      // $this->welcomeScreenTimestamp = $timestamp;
    }

  }


  // PRIVATE GETTERS

  /**
   * Returns the splash screen timestamp from the `config` session variable, 
   * or the default / current timeout if the `config` session variable is not set
   * 
   * @return int
   * @private
   */
  private function getSplashScreenTimestamp(): int {
    return (isset($_SESSION['config'])) ? $_SESSION['config']['splashScreenTimestamp'] : $this->getCurrentTimestamp();
  }

  /**
   * Returns the welcome screen timestamp from the `config` session variable, 
   * or the default / current timeout if the `config` session variable is not set
   * 
   * @return int
   * @private
   */
  private function getWelcomeScreenTimestamp(): int {
    return (isset($_SESSION['config'])) ? $_SESSION['config']['welcomeScreenTimestamp'] : $this->getCurrentTimestamp();
  }


  /**
   * Returns the current timestamp
   *
   * @return int
   */
  private function getCurrentTimestamp(): int {
    // TODO: Do something awesome here to get the current timestamp
    
    return time(); // <- For now... super simple, isn't it? 😜
  }

  
  // PRIVATE METHODS

};





