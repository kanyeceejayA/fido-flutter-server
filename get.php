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

Future<Map<String,dynamic>> registrationRequest({required String userId}) async{
    if(userId == '') throw PlatformException(code: 'User_Name_Cannot_Be_Blank',message: 'Username cannot be blank');
    String challenge = _generateChallenge();

    var _data = (await _storage.read(key: userId)) ??'{"credentials":[]}';
    // [
    // 	{"credentialId": credentialId, "publicKey": publicKey}, 
    // 	{"credentialId": credentialId, "publicKey": publicKey}
    // ]
    List credentials = (json.decode(_data))['credentials'];
    List ids = [];
    for (var item in credentials) {
      ids.add(item['credentialId']);
    }

    await _storage.write(key: 'RequestChallengeFor'+userId,value: challenge);

    print  ({'challenge': challenge,'credentials':ids});
    return {'challenge': challenge,'credentials':ids};
}


function generateChallenge($l=32){
    return substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890123456789ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz-._"), 10, $l);
 }
 