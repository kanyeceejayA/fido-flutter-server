<?php
include('env.php');

$dns = 'mysql:host=localhost;dbname=silbaka_fido';
$user = 'silbaka_fidoUser';
$password = env('password');
try{
 $db = new PDO ($dns, $user, $password);
 echo '<h1>success</h1>';
}catch( PDOException $e){
 $error = $e->getMessage();
 echo '<h1>'.$error.'</h1>';
}