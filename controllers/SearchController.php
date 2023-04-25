<?php

namespace Maxaboom\Controllers;

// use the `Product` model
use Maxaboom\Models\Product;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


class SearchController extends Controller
{
    use ResponseHandler;

    private Product $product;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);

        $this->product = new Product();
    }

    public function showSearchPage(){
        require_once  __DIR__ . '/../views/search-page.php';
    }

    public function searchProduct($query){
       $data = ['products' => $this->product->getProductByName($query)];
       $success = true;
       $status = $this::$STATUS_SUCCESS_OK;
       $message = 'Ok';
       $this->updateResponse($success, $status, $message, $data);
       echo json_encode($this->getResponse());
    }
}

?>