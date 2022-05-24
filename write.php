<?php 
require('env.php');

$servername = "localhost";
$dbname = env('dbName');
$username = env('dbUser');
$password = env('dbPassword');

try {
    if (empty($_GET['key']) || empty($_GET['d'])){ http_response_code(412);echo null; return;}
    $key = $_GET['key'];
    $content = $_GET['d'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO fidodata (datakey, content)
            VALUES ('$key', '$content')";
    // use exec() because no results are returned
    // $conn->exec($sql);
    
    $stmt = $conn->prepare("INSERT INTO fidodata (datakey, content)
        VALUES (:key, :content)
        ON DUPLICATE KEY UPDATE
        datakey = values(datakey),
        content = values(content)");
    $stmt->bindParam(':key', $key);
    $stmt->bindParam(':content', $content);

    // $stmt->execute();
    header("Content-Type: text/plain");
    http_response_code(200);
    var_dump($_GET);
    echo 'Ok';

    } catch(PDOException $e) {
        header("Content-Type: text/plain");
        http_response_code(400);
       echo $e->getMessage();
    }catch(Error $e){
        echo $e;
    }
    
    $conn = null;
    
