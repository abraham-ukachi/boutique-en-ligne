<?php 
require('User.php'); 

$user = new User();


$mail = $_GET['mail'];
$password = $_GET['password'];

$user->connection($mail, $password);


