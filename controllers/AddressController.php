<?php

namespace Maxaboom\Controllers;

use AllowDynamicProperties;

use Maxaboom\Models\Address;
use Maxaboom\Models\Card;
use Maxaboom\Models\User;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;

#[AllowDynamicProperties] class AddressController extends Controller
{
    use ResponseHandler;

    public Address $address;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
        $this->address = new Address();
        $this->card = new Card();
        $this->user = new User();

    }

    function getAddresses($userId){
       return $this->address->getAddressByUser($userId);
    }

    function getAddressById($addressId){
        $userId = $this->user->id;
        $address = $this->address->getOne($userId, $addressId);
        return $address;
    }

}