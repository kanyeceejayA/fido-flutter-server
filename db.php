<?php
include('env.php');

$dns = 'mysql:host=localhost;dbname=silbaka_fido';
$user = 'silbaka_fidoUser';
$password = env('password');
try{
 $db = new PDO ($dns, $user, $pass);
 echo '<h1>success';
}catch( PDOException $e){
 $error = $e->getMessage();
 echo $error;
}