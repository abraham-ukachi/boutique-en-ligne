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
      // If the user is not connected...,
      if(!$this->user->isConnected()) {
        // ...redirect him/her to the login page
        $this->redirect('/login');
      }

        $cards = $this->card->getAll($this->user->id);
        $addresses = $this->address->getAll($this->user->id);
        require_once __DIR__ . '/../views/checkout-page.php';
    }

    public function registerAddress($address_id, $title, $address, $address_complement, $postal_code, $city, $country){
        $user_id = $this->user->id;
        if($address_id){
            $this->address->updateAddress($address_id, $title, $address, $address_complement, $postal_code, $city, $country, $user_id);
        }else{
            $this->address->newAddress($title, $address, $address_complement, $postal_code, $city, $country, $user_id);
        }
    }

    public function registerCard($card_id, $type, $nb_card, $expiration, $cvv){
        $user_id = $this->user->id;
        if($card_id){
            $this->card->updateCard($card_id, $type, $nb_card, $expiration, $cvv, $user_id);
        }else{
            $this->card->registerCard($user_id, $type, $nb_card, $expiration, $cvv);
        }
    }

    public function registerAllInformations($delivery, $address, $addressComplement, $city, $postalCode, $country, $nbCard, $expiration, $cvv){
        $titre = "nouvelle adresse";
        $user_id = $this->user->id;
        $this->address->newAddress($titre, $address, $addressComplement, $postalCode, $city, $country, $user_id);
        $this->card->registerCard($this->user->id, 'VISA', $nbCard, $expiration, $cvv);

    }

    public function getAddressUser(int $userId){
        $userId = $this->user->id;
        $this->address->getAll($userId);

    }

}
