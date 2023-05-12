<?php

namespace Maxaboom\Routes;
use Maxaboom\Controllers\CardsController;


$router->map('GET', '/cards/[i:cardId]', function ($cardId){
    if (!isset($_SERVER['HTTP_CREATOR'])) {
        echo "fuck off!!!";
        die("You are dead!!!");
        return;
    }

    $cardsController = new CardsController();
    $response = $cardsController->getCardById($cardId);

    echo json_encode($response);
});

