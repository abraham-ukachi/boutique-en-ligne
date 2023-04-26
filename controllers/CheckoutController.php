<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Product;
use Maxaboom\Models\Checkout;
use Maxaboom\Models\Address;
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


class CheckoutController extends Controller
{
    use ResponseHandler;
    public object $address;
    public object $checkout;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
        $this->address = new Address();
        $this->checkout = new Checkout();
    }

    public function showCheckoutPage(){
        require_once __DIR__ . '/../views/checkout-page.php';
    }

    public function getAddressController(){
        $this->address->getAddressByUser($userId);
    }
}

?>