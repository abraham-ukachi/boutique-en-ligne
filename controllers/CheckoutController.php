<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Product;
use Maxaboom\Models\Address;
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


class CheckoutController extends Controller
{
    use ResponseHandler;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
    }

    public function showCheckoutPage(){
        require_once __DIR__ . '/../views/checkout-page.php';
    }
}

?>