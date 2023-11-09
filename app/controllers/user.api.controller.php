 <?php

 require_once './app/models/user.model.php';
 require_once './app/controllers/api.controller.php';
 require_once './app/helpers/auth.api.helper.php';

 class UserApiController extends ApiController{

    private $model;
    private $authHelper;

    public function __construct(){
        parent::__construct();
        $this->authHelper = new AuthApiHelper();
        $this->model= new UserModel();
    }

    public function getToken($params = []){
        $basic = $this->authHelper->getAuthHeaders(); //Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

        if(empty($basic)){
            $this->view->response('No envió encabezados de autenticación', 401);
            return;
        }

        $basic = explode(" ", $basic); //["Basic", "base64(usr,pass)"]

        if($basic[0]!="Basic"){
            $this->view->response('Los encabezados de autenticación son incorrectos', 401);
            return;
        }

        $userpass = base64_decode($basic[1]); // urs:pass
        $userpass = explode(":", $userpass); // ["usr", "pass"]

        $user = $userpass[0];
        $pass = $userpass[1];

        $data = $this->model->getUserByName($user);

        if($data && $user == $data->nombre_Usuario && password_verify($pass, $data->password)){
            $token = $this->authHelper->createToken($data);
            $this->view->response($token, 200);
        } else {
            $this->view->response('El usuario o contraseña son incorrectos.', 401);
        }
    }
 }