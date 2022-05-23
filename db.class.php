<?php 
require('env.php');
function saveChallenge(String $userId, String $challenge)
{
    $servername = "localhost";
    $dbname = env('dbName');
    $username = env('dbUser');
    $password = env('dbPassword');
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO challenges (userId, challenge)
        VALUES ('$userId', '$challenge')";
        // use exec() because no results are returned
        // $conn->exec($sql);
        } catch(PDOException $e) {
            $e->getMessage();
        }
        
        $conn = null;
}
function getCredentials(String $userId)
{
    $servername = "localhost";
    $dbname = env('dbName');
    $username = env('dbUser');
    $password = env('dbPassword');

    $credentials = Array();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT credentialList FROM credentials WHERE userId = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $credentials =  json_decode($row["credentialList"]);
    }
    } else {
    echo "0 results";
    }
    $conn->close();

    return $credentials;

}

function saveCredential(String $userId,String $credentials)
{
    $servername = "localhost";
    $dbname = env('dbName');
    $username = env('dbUser');
    $password = env('dbPassword');
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO credentials (userId, credentialList)
        VALUES ('$userId', '$credentials')";
        // use exec() because no results are returned
        $conn->exec($sql);
        } catch(PDOException $e) {
         return $e->getMessage();
        }
        
        $conn = null;
        return  'successfully saved.';
}

function updateCredential(String $userId,String $credentials)
{
    echo '<h1>updating</h1>';
    $servername = "localhost";
    $dbname = env('dbName');
    $username = env('dbUser');
    $password = env('dbPassword');
    try {
        var_dump($credentials);
        if(empty($credentials)){return 'Cannot Save Empty Credentials';}
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE credentials set credentialList = '$credentials' where userId = '$userId'";
        // use exec() because no results are returned
        $conn->exec($sql);
        } catch(PDOException $e) {
         return $e->getMessage();
        }
        
        $conn = null;
        return  'successfully saved.';
}



function generateChallenge($l=32){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890123456789ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz-._"), 10, $l);
}

