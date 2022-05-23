<?php

$dns = 'mysql:host=localhost;dbname=silbaka_fido';
$user = 'silbaka_fidoUser';
$password = 'enter_the_password_of_your_database';try{
 $db = new PDO ($dns, $user, $pass);
}catch( PDOException $e){
 $error = $e->getMessage();
 echo $error;
}