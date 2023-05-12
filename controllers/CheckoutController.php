<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Product;
use Maxaboom\Models\Card;
use Maxaboom\Models\Address;
use Maxaboom\Models\User;
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;


class CheckoutController extends Controller
{
    use ResponseHandler;
    public Address $address;
    public Card $card;
    public User $user;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
        $this->address = new Address();
        $this->card = new Card();
        $this->user = new User();

    }

    public function showCheckoutPage(){
        $card = $this->card->getCards($this->user->id);
        require_once __DIR__ . '/../views/checkout-page.php';
    }

    public function registerAllInformations($delivery, $address, $addressComplement, $city, $postalCode, $country, $nbCard, $expiration, $cvv){
        $titre = "nouvelle adresse";
        $user_id = $this->user->id;
        $this->address->newAddress($titre, $address, $addressComplement, $postalCode, $city, $country, $user_id, $delivery);
        $this->card->registerCard($this->user->id, 'VISA', $nbCard, $expiration, $cvv);

    }

    public function getAddressUser(int $userId){
        $userId = $this->user->id;
        $this->address->getAddressByUser($userId);

    }

}

?>