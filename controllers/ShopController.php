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
 * @name Shop - Controller
 * @file ShopController.php
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

// use these models
use Maxaboom\Models\Product;
use Maxaboom\Models\Category;
use Maxaboom\Models\SubCategory;
use Maxaboom\Models\User;
use PDO;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


/**
 * Class ShopController
 * NOTE: This class is a controller for the shop page 
 */
class ShopController extends Controller {
  // Using some traists (a.k.a. step parents) in this class
  use ResponseHandler;

  // declare some constants...

  // declare some properties...i
  
  // private properties

  // public properties
  // model objects
  public Product $product;
  public Category $category;
  public SubCategory $subCategory;
  public User $user;

  public ?string $categoryName = null;
  public ?string $subCategoryName = null;
  public ?string $categoryImage = null;
  public ?int $categoryId = null;
  public ?int $subCategoryId = null;

  private string $categoryNameValue = '';
  private string $subCategoryNameValue = '';
  private ?string $shopTitle = null;
  


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


    // instantiate the models
    $this->product = new Product();
    $this->category = new Category();
    $this->subCategory = new SubCategory();
    $this->user = new User();

    // initialize the shop title
    $this->shopTitle = $this->i18n->getString('shop@Maxaboom');

    // $this->categoryId = ($categoryName) ? $this->category->getCategoryIdByName($categoryName) : -1;
    
  }


  // PUBLIC SETTERS

  // PUBLIC GETTERS

  // PUBLIC METHODS

  
  /**
   * Shows the shop page
   * NOTE: This page dynamically displays the top categories and the products based on the category and sub-category
   *
   * @param ?string $categoryName : the name of the category
   * @param ?string $subCategoryName : the name of the sub-category
   *
   * @return void
   */
  public function showPage(?string $categoryName = null, ?string $subCategoryName = null): void {
    
    // Intialize some variables
    $categories = [];
    $subCategories = [];

    $categoryId = null;
    $subCategoryId = null;
    $categoryImage = null;

    // get the top categories as `topCategories`
    $topCategories = $this->getTopCategories(); 

    // if theres a category name...
    if (isset($categoryName)) {
      // ...get the category id
      $categoryId = $this->getCategoryIdByName($categoryName);
      // get the sub categories of this `categoryId`
      $subCategories = $this->getSubCategories($categoryId);
      // get the category image
      $categoryImage = $this->getCategoryImage($categoryId);
      
      /* var_dump($categoryImage); */

    }

    // if theres a sub-category name...
    if (isset($subCategoryName)) {
      // ...get the sub-category id
      $subCategoryId = $this->getSubCategoryIdByName($subCategoryName);
    }



    // Update the corresponding properties
    $this->updateCategoryProps([
      'categoryName' => $categoryName, 
      'subCategoryName' => $subCategoryName,
      'categoryId' => $categoryId,
      'subCategoryId' => $subCategoryId,
      'categoryImage' => $categoryImage,
    ]); 

    // update the shop title
    $this->updateShopTitle($categoryName, $subCategoryName);
     
    // show the shop page
    require_once __DIR__ . '/../views/shop-page.php';
  }



  public function showPageByCategory(): void
  {
      $categoryId = $this->category->getCategoryIdByName($this->categoryName); // returns ex: 1
      $products = $this->product->getProductsByCategoryId($categoryId); // returns: Array(...['id' => 10, 'name' => 'Piano Yamaha'...])
      $categories = $this->category->getAllCategories();
      $subCategories = $this->category->getAllSubCategories();

      // show the splash screen
      require_once __DIR__ . '/../views/shop-page.php';
  }


  public function showPageBySubCategory(): void
  {
      $subCategoryId = $this->category->getSubcategoryIdByName($this->subCategoryName);
      $products = $this->product->getProductsBySubCategoryId($subCategoryId);
      $categories = $this->category->getAllCategories();
      $subCategories = $this->getAllSubCategories();

      require_once __DIR__ . '/../views/shop-page.php';
  }

  public function getAllProducts()
  {
      return $this->product->getAllProducts();
  }

  public function getAllCategories()
  {
      return $this->category->getAllCategories();
  }

  public function getProductByCategory($category)
  {
      return $this->category->getCategoryIdByName($category);
  }

  public function getAllSubCategories()
  {
      return $this->category->getAllSubCategories();
  }


  // PRIVATE SETTERS

  // PRIVATE GETTERS

  // PRIVATE METHODS

  /**
   * Method used to update the category properties
   *
   * @param array $categoryProperties : the properties to update (eg. ['categoryName' => '...', 'subCategoryName' => '...', ...])
   * @return void
   */
  private function updateCategoryProps(array $categoryProperties): void {
    // loop through each category property...
    foreach ($categoryProperties as $categoryProperty => $categoryPropertyValue) {
      // ...update the corresponding property
      $this->$categoryProperty = $categoryPropertyValue;
    }
    
    // update the corresponding properties
    /*
    $this->categoryName = $props['categoryName'];
    $this->subCategoryName = $props['subCategoryName'];
    $this->categoryId = $props['categoryId'];
    $this->subCategoryId = $props['subCategoryId'];
    $this->categoryImage = $props['categoryImage'];
     */
  }


  /**
   * Updates the shop title
   *
   * @param ?string $categoryName : the name of the category
   * @param ?string $subCategoryName : the name of the sub-category
   *
   * @return void
   */
  private function updateShopTitle(?string $categoryName = null, ?string $subCategoryName = null): void {
    // if theres a category name...
    if (isset($categoryName)) {
      // ...update the category name value & shop title
      $this->categoryNameValue = $this->i18n->getString($categoryName);
      $this->shopTitle = str_replace('%s', $this->categoryNameValue, $this->i18n->getString('x@Maxaboom'));

    } else { // <_ if theres no category name...
      $this->shopTitle = $this->i18n->getString('shop@Maxaboom');
    }

  }


  /**
   * Method used to get the top categories
   *
   * @return array
   */
  private function getTopCategories(): array {
    // retrieve the top categories from the database using the `Category` model as `topCategories`
    $topCategories = Category::where('is_top', 1)->get(true);
    
    // return the `topCategories` array
    return $topCategories;
  }

  /**
   * Method used to get the category id by name
   *
   * @param ?string $categoryName : the name of the category
   * @return int
   */
  private function getCategoryIdByName(?string $categoryName = null): int {
    // return the category id
    $categoryId = Category::where('name', $categoryName)->get(true)[0]['id'];

    // return the `categoryId`
    return $categoryId;
  }

  /**
   * Method used to get the category image using the `categoryId`
   *
   * @param int $categoryId : the id of the category
   * @return string
   */
  private function getCategoryImage(int $categoryId): ?string {
    // return the category image
    $categoryImage = Category::find($categoryId)->info()['image'];

    // return the `categoryImage`
    return $categoryImage;
  }


  /**
   * Method used to get all the sub-categories of the given `categoryId`
   *
   * @param int $categoryId : the id of the category
   *
   * @return array
   * @private
   */
  private function getSubCategories(int $categoryId): array {
    // get all the sub-categories with `categoryId` as `subCategories`
    $subCategories = SubCategory::where('category_id', $categoryId)->get();

    /* var_dump($subCategories); */

    // return the `subCategories`
    return $subCategories;
  }
  

  /**
   * Method used to get the sub-category id by name
   *
   * @param string $subCategoryName : the name of the sub-category
   * @return int
   */
  private function getSubCategoryIdByName(string $subCategoryName): int {
    // return the sub-category id
    $subCategoryId = SubCategory::where('name', $subCategoryName)->get(true)[0]['id'];

    // return the `subCategoryId`
    return $subCategoryId;
  }

};





