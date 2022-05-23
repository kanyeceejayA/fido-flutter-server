<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
require_once('db.class.php');

function registrationRequest(String $userId = '')
{
    $reponse = '';
    if($userId == ''){
        $response = 'Username cant be blank';
        return $reponse;
    }
    $oldCreds = getCredentials($userId);

    $challenge = generateChallenge();
    saveChallenge($userId,$challenge);

    $reponse = ['challenge'=>$challenge];

    return $reponse;
}

function storeCredential(String $userId, String $credentialId,String $signedChallenge, String $publicKey)
{
    $newCredential = new stdClass();
    $newCredential->credentialId = $credentialId; 
    $newCredential->publicKey = $publicKey;

    x
    $oldCreds = getCredentials($userId);
    $credentials = $oldCreds;
    if(in_array($newCredential,$credentials)) return 'Error - Credential Already Exists';
    array_push($credentials, $newCredential);
    var_dump($credentials);

    if(!empty($oldCreds)){ return updateCredential($userId,json_encode($credentials));}
   

    return saveCredential($userId,json_encode($credentials));
}



    
