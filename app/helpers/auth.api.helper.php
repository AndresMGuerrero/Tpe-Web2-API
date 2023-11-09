<?php

require_once 'config.php';

function base64url_encode($data){
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

class AuthApiHelper{


    public function getAuthHeaders(){
        $header = "";
        if(isset($_SERVER['HTTP_AUTHORIZTION'])){
            $header = $_SERVER['HTTP_AUTHORIZTION'];
        }
        if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZTION'])){
            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZTION'];
        }
        return $header;
    }

    public function createToken($payload){

        $header = array(
            'alg' => 'HS256',
            'typ' => 'JWT'
        );

        $header = base64url_encode(json_encode($header));
        $payload = base64url_encode(json_encode($payload));

        $signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
        $signature = base64url_encode($signature);

        $token = "$header.$payload.$signature";

        return $token; 

    }

    public function verifyToken($token){
        // $header.$payload.$signature

        $token = explode(".", $token); // [$header, $payload, $signature]

        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];

        $new_signature = hash_hmac('SHA256', "$header.$payload", JWT_KEY, true);
        $new_signature = base64url_encode($new_signature);

        if($signature!=$new_signature){
            return false;
        }

        $payload = json_decode(base64_decode($payload));

        return $payload;
    }

    public function currentUser(){
        $auth = $this->getAuthHeaders(); // "Bearer $token"
        $auth = explode(" ", $auth); //["Bearer", "$token"]

        if($auth[0] != "Bearer"){
            return false;
        }
        
        return $this->verifyToken($auth[1]); //Si está todo bien nos devuelve el payload
    }
}