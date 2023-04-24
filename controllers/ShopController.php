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

use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Product;
use Maxaboom\Models\Category;
use Maxaboom\Models\User;
use PDO;


// declare the class
class ShopController extends Database
{
    // declare some constants...

    const DEFAULT_THEME = 'light';

    // declare some properties...
    public ?object $productModel;
    public ?object $categoryModel;
    public ?object $user;
    public ?string $categoryName;
    public ?string $subCategoryName;
    public ?int $categoryId = null;
    public ?int $subCategoryId = null;


    /**
     * Constructor of the class
     * This method is executed automatically whenever this class is instantiated
     */
    public function __construct(?string $categoryName = null, ?string $subCategoryName = null)
    {
        $this->categoryName = $categoryName;
        $this->subCategoryName = $subCategoryName;


        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->user = new User();

        $this->categoryId = ($categoryName) ? $this->categoryModel->getCategoryIdByName($categoryName) : -1;

    }


    // PUBLIC SETTERS
    // PUBLIC GETTERS
    // PUBLIC METHODS


    /**
     * Shows the default shop page
     *
     * @param string $theme - the default theme of the page
     *
     * @return void
     */
    public function showPage($theme = self::DEFAULT_THEME): void
    {
        $products = !!$this->categoryName ? $this->getProductByCategory($this->categoryName) : $this->getAllProducts(); // if CategoryName is not null then filter products by categoryName, else display all products
        //$productsBySubCategory = !!$this->subCategory ? $this->getProductByCategory($this->categoryName) : $this->getAllProducts();
        $subCategories = $this->getAllSubCategories();
        $categories = $this->getAllCategories();
        $user = $this->user->getInitials();
        // show the splash screen
        require_once __DIR__ . '/../views/shop-page.php';
    }


    public function showPageByCategory($theme = self::DEFAULT_THEME): void
    {
        $categoryId = $this->categoryModel->getCategoryIdByName($this->categoryName); // returns ex: 1
        $products = $this->productModel->getProductsByCategoryId($categoryId); // returns: Array(...['id' => 10, 'name' => 'Piano Yamaha'...])
        $categories = $this->categoryModel->getAllCategories();
        $subCategories = $this->categoryModel->getAllSubCategories();

        // show the splash screen
        require_once __DIR__ . '/../views/shop-page.php';
    }


    public function showPageBySubCategory($theme = self::DEFAULT_THEME): void
    {
        $subCategoryId = $this->categoryModel->getSubcategoryIdByName($this->subCategoryName);
        $products = $this->productModel->getProductsBySubCategoryId($subCategoryId);
        $categories = $this->categoryModel->getAllCategories();
        $subCategories = $this->getAllSubCategories();

        require_once __DIR__ . '/../views/shop-page.php';
    }

    public function getAllProducts()
    {
        return $this->productModel->getAllProducts();
    }

    public function getAllCategories()
    {
        return $this->categoryModel->getAllCategories();
    }

    public function getProductByCategory($category)
    {
        return $this->categoryModel->getCategoryIdByName($category);
    }

    public function getAllSubCategories()
    {
        return $this->categoryModel->getAllSubCategories();
    }


    // PRIVATE SETTERS
    // PRIVATE GETTERS
    // PRIVATE METHODS


};





