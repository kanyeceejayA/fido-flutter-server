<?php
echo 'Wroking <br>';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting('E_ALL');
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