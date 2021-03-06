<?php 
require('env.php');

$servername = "localhost";
$dbname = env('dbName');
$username = env('dbUser');
$password = env('dbPassword');

try {
    if (empty($_GET['key']) ){ http_response_code(412);echo null; return;}
    $key = $_GET['key'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE FROM fidodata  WHERE datakey = :key");
    $stmt->bindParam(':key', $key);
    
    $stmt->execute();
    header("Content-Type: text/plain");
    http_response_code(200);
    echo 'Ok';

    } catch(PDOException $e) {
        header("Content-Type: text/plain");
        http_response_code(400);
       echo $e->getMessage();
    }catch(Error $e){
        echo $e;
    }
    
    $conn = null;
    
