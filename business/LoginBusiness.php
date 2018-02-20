<?php
require '../domain/Login.php';
require_once '../util/SSession.php';

if (isset($_POST['login'])) {
    if (isset($_POST['loginPassword'])) {
        if (strlen($_POST['loginPassword']) > 0) {

            $loginBusiness = new LoginBusiness();
            $login = new Login();

            $login->setLoginMail($_POST['loginMail']);
            $login->setLoginPassword($_POST['loginPassword']);
            
            $result = $loginBusiness->authenticate($login);

            if (isset($result)) {
                
                SSession::getInstance()->user=$result;
               
                header("location: ../view/LoginView.php?success=inserted");
            } else {
          
                header("location: ../view/LoginView.php?error=dbError");
            }
        } else {
            header("location: ../view/LoginView.php?error=format");
        }
    } else {
        header("location: ../view/LoginView.php?error=empty");
    }
} 

class LoginBusiness {

    private $data;

    function __construct() {
        include_once '../data/LoginData.php';
        $this->data = new LoginData();
    }

    function authenticate(Login $login) {
        return $this->data->authenticate($login);
    }

}
