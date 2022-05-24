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
    // use exec() because no results are returned
    // $conn->exec($sql);
    
    $stmt = $conn->prepare("SELECT content FROM fidodata  WHERE datakey = :key");
    $stmt->bindParam(':key', $key);
    
    $stmt->execute();

    if ($stmt->rowCount() == 0){http_response_code(412);return;}

    foreach ($stmt as $row) {
        $content = $row['content'];
    }
    header("Content-Type: text/plain");
    http_response_code(200);
    echo $content;

    } catch(PDOException $e) {
        header("Content-Type: text/plain");
        http_response_code(400);
       echo $e->getMessage();
    }catch(Error $e){
        echo $e;
    }
    
    $conn = null;
    
