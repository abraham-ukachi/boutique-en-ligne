<?php

// declare a namespace  
namespace Maxaboom\Models\Test;

include __DIR__ . "/../helpers/Database.php";
include __DIR__ . "/../Address.php";


use Maxaboom\Models\Helpers\Database;
use Maxaboom\Models\Address;

echo "<h1>TEST FOR ADDRESS CLASS</h1><br>";
$newaddress = New Address();
$addressUser = $newaddress->getAddressByUser(3);
//$delAddresse = $newaddress->updateTypeAddress(1, "default");

echo "<br>";
/* newAddress OK
$titre = "Addresse boulot";
$address = "01 rue des larbins";
$complement = "immeuble B";
$postal_code = 13004;
$city = "Marseille";
$country = "FRANCE";
$user_id = 1;
$type = "livraison";
$newAddress = $newaddress->newAddress($titre, $address, $complement, $postal_code, $city, $country, $user_id, $type);
*/