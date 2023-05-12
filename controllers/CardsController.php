<?php

namespace Maxaboom\Controllers;

use Maxaboom\Models\Card;
use Maxaboom\Models\User;

// use the `Controller` & `ResponseHandler` helper classes
use Maxaboom\Controllers\Helpers\Controller;
use Maxaboom\Controllers\Helpers\ResponseHandler;

class CardsController extends Controller
{
    use ResponseHandler;

    public Card $card;
    public User $user;

    public function __construct(?string $theme = null, ?string $lang = null, bool $useDefaultBrowserLang = true)
    {
        parent::__construct($theme, $lang, $useDefaultBrowserLang);
        $this->card = new Card();
        $this->user = new User();

    }

    function getCards(){
       return $this->card->getAll($this->user->id);
    }

    function getCardById($cardId){
        $userId = $this->user->id;
        $card = $this->card->getOne($userId, $cardId);
        return $card;
    }

}