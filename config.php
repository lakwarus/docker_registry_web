<?php

$user="";
$password="";
$registry_url="";

// Point to where you downloaded the phar
include('./httpful.phar');


function get_token($uri,$user,$password){
    $response = \Httpful\Request::put($uri)
    ->sendsJson()
    ->authenticateWith('', '')
    ->send();
    $token=$response->body->token;
    return $token;
}



function list_repos($registry_url,$user,$password){
    
    $uri = "https://registry_domain:5001/auth?service=Docker+registry&scope=registry:catalog:*";
    $token=get_token($uri,$user,$password);
    $authorization = "Authorization: Bearer $token";
    $ch = curl_init("$registry_url/v2/_catalog");

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    print_r($result);
}

function get_tags($repo,$registry_url,$user,$password){

    $token_uri="https://registry_domain:5001/auth?service=Docker+registry&scope=repository:$repo:pull";
    $uri="$registry_url/v2/$repo/tags/list";
    $token=get_token($token_uri,$user,$password);
    $authorization = "Authorization: Bearer $token";
    $ch = curl_init($uri);

    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);
    print_r($result);
}

?>
