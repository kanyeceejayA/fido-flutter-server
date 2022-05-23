<?php
require_once('db.class.php');
$query = 'SELECT * FROM posts';
$stm = $db->prepare($query);
$stm->execute();
$row = $stm->fetch(PDO::FETCH_ASSOC);
echo json_encode($row);

function registrationRequest(String $userId = null)
{
    $userId = '';
    $reponse = '';
    if($userId == ''){
        $response = 'Username cant be blank';
        return
    }
    $challenge = generateChallenge();
    echo $challenge;
    saveChallenge($userId,$challenge);

}

function generateChallenge($l=32){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890123456789ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz-._"), 10, $l);
 }
 