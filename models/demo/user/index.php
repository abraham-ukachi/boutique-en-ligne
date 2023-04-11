<?php require('../../user/User.php'); ?>

<?php
//echo var_dump($_SESSION);
$new_display = new User();
$result = $new_display->displayUsers();
$_SESSION['mail'] = "hilaire.savary@gmail.com";
$new_display->updateMail('c1nouveauMail@gmail.com');
var_dump($result);
$_SESSION['lastname'] = "Armand";
$_SESSION['firstname'] = "Aymee";
$new_display->updateFirstname("Galadrielle");
echo "<br> Current date : <br>";
echo $date= $new_display->getCurrentDate();
echo "<br>";
var_dump($_SESSION);

$mydate = getdate(date("U"));
$myhour = date("H:i:s");
$date = "$mydate[year]/$mydate[mon]/$mydate[mday] $myhour";
echo $date;
echo "<br>";
?>

<button onClick="displayFormRegister()">S'enregistrer</button>
<button onClick="displayFormConnection()">Se connecter</button>
        <div id="formD"></div>
        <div id="formC"></div>
       

<script type="text/javascript" src="script-test.js"></script>

