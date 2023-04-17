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
use PDO;


// declare the class
class ShopController extends Database
{
    // declare some constants...

    const DEFAULT_THEME = 'light';

    // declare some properties...
    public object $ProductModel;
    public ?string $categoryName;
    public ?int $subCategory;


    /**
     * Constructor of the class
     * This method is executed automatically whenever this class is instantiated
     */
    public function __construct(?string $categoryName = null, ?int $subCategory = null)
    {
        $this->categoryName = $categoryName;
        $this->subCategory = $subCategory;
        $this->ProductModel = new Product();

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
        // TODO: do something awesome here before showing the splash screen ;)
        $products = !!$this->category ? $this->getProductByCategory($this->category) : $this->getAllProducts();
        $categories = $this->getAllCategories();

        // show the splash screen
        require_once __DIR__ . '/../views/shop-page.php';
    }



    public function showPageByCategory($theme = self::DEFAULT_THEME): void
    {
        $categoryId = $this->ProductModel->getCategoryIdByName($this->categoryName); // returns ex: 1
        $products = $this->ProductModel->getProductsByCategoryId($categoryId); // returns: Array(...['id' => 10, 'name' => 'Piano Yamaha'...])

        $categories = $this->getAllCategories();

        // show the splash screen
        require_once __DIR__ . '/../views/shop-page.php';
    }

    public function getAllProducts()
    {
        return $this->ProductModel->getAllProducts();
    }

    public function getAllCategories()
    {
        return $this->ProductModel->getAllCategories();
    }

    public function getProductByCategory($category)
    {
        return $this->ProductModel->getCategoryIdByName($category);
    }


    // PRIVATE SETTERS
    // PRIVATE GETTERS
    // PRIVATE METHODS


}

;





