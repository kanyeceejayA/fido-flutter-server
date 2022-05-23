<head></head>
<?php
include('env.php');
echo 'Wroking <br>';
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting('E_ALL');

$dns = 'mysql:host=localhost;dbname='.env('dbName');
$user = env('dbUser');
$password = env('dbPassword');
try{
 $db = new PDO ($dns, $user, $password);
 echo '<h1>success</h1>';
}catch( PDOException $e){
 $error = $e->getMessage();
 echo '<h1>'.$error.'</h1>';
}