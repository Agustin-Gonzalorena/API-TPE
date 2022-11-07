<?php
require_once './app/view/api.view.php';

class authHelper{
    private $view;

    function __construct(){
        $this->view=new apiView;
    }

    function checkAdmin(){
        $payload=$this->getToken();
        if(!isset($payload->id) || $payload->admin!=1){
            $this->view->response("No tiene permisos de administrador", 401);
            die();
        }
    }

    function checkLoggedIn(){
        $payload = $this->getToken();
        if(!isset($payload->id)){
            $this->view->response("Tiene que estar logeado", 401);
            die();
        }
        return $payload->userName;
    }

    function getToken(){
        $auth = $this->getHeader(); // Bearer header.payload.signature
        $auth = explode(" ", $auth);
        if($auth[0]!="Bearer" || count($auth) != 2){
            return array();
        }
        $token = explode(".", $auth[1]);
        $header = $token[0];
        $payload = $token[1];
        $signature = $token[2];

        $new_signature = hash_hmac('SHA256', "$header.$payload", "1234", true);
        $new_signature = $this->base64url_encode($new_signature);
        if($signature!=$new_signature)
            return array();

        $payload = json_decode(base64_decode($payload));

        if(!isset($payload->exp) || $payload->exp<time())
            return array();
        
        return $payload;
    }

    function getHeader(){
        $header = "";
        if(isset($_SERVER['HTTP_AUTHORIZATION']))
            $header = $_SERVER['HTTP_AUTHORIZATION'];
        if(isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']))
            $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
        return $header;
    }
    
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

}