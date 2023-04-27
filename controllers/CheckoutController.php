<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Product;
use Maxaboom\Models\Checkout;
use Maxaboom\Models\Address;
use Maxaboom\Models\User;
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


class CheckoutController extends Controller
{
    use ResponseHandler;
    public Address $address;
    public Checkout $checkout;
    public User $user;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
        $this->address = new Address();
        $this->checkout = new Checkout();
        $this->user = new User();

    }

    public function showCheckoutPage(){

        require_once __DIR__ . '/../views/checkout-page.php';
    }

    public function registerAllInformations($delivery, $address, $addressComplement, $city, $postalCode, $country,
                                            $nbCard, $expiration, $cvv){
        $titre = "nouvelle adresse";
        $user_id = $this->user->id;
        $this->checkout->newAddress($titre, $address, $addressComplement, $postalCode, $city, $country, $user_id, $delivery);
        $this->checkout->registerCard($user_id, $nbCard, $expiration, $cvv);

    }

}

?>