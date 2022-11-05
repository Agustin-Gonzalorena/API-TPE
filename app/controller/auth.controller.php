<?php
require_once './app/model/users.model.php';
require_once './app/helpers/auth.helper.php';
require_once './app/view/api.view.php';

class authController{
    private $authHelper;
    private $model;
    private $view;

    function __construct(){
        $this->model=new usersModel();
        $this->authHelper=new authHelper();
        $this->view=new apiView();
    }

    function getToken(){
        // Obtener "Basic base64(user:pass)
        $basic = $this->authHelper->getHeader();

        if(empty($basic)){
            $this->view->response('No autorizado', 401);
            return;
        }
        $basic = explode(" ",$basic); // ["Basic" "base64(user:pass)"]

        if($basic[0]!="Basic"){
            $this->view->response('La autenticación debe ser Basic', 401);
            return;
        }
        
        $userAndPassword = base64_decode($basic[1]); // user:pass
        $userAndPassword = explode(":", $userAndPassword);// lo hace array

        $userName = $userAndPassword[0];
        $password = $userAndPassword[1];

        $user = $this->model->getUserByUserName($userName);
        if($user && password_verify($password,$user->password)){

            $header = array(
                'alg' => 'HS256',
                'typ' => 'JWT'
            );
            $payload = array(
                'id' => $user->id,
                'name' => $user->name,
                'admin'=>$user->admin,
                'exp' => time()+3600
            );

            $header = $this->base64url_encode(json_encode($header));
            $payload = $this->base64url_encode(json_encode($payload));

            $signature = hash_hmac('SHA256', "$header.$payload", "1234", true);
            $signature = $this->base64url_encode($signature);
            $token = "$header.$payload.$signature";
             $this->view->response($token);
        }else{
            $this->view->response('No autorizado', 401);
        }
    }
    function base64url_encode($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}