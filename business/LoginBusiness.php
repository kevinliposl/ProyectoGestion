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

                SSession::getInstance()->user = $result;

                header("location: ../index.php");
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
if (isset($_GET['signout'])) {
    SSession::getInstance()->destroy();
    if ($_GET['signout'] == 'i') {
        header("location: ../index.php");
    } else {
        header("location: ../index.php");
    }
}

if (isset($_GET['recover'])) {
    if (isset($_POST['actormail'])) {
        if (filter_var($_POST['actormail'], FILTER_VALIDATE_EMAIL)) {
            $loginBusiness = new LoginBusiness();
            $login = new Login();

            $login->setLoginMail($_POST['loginMail']);

            $result = $loginBusiness->authenticate($login);
        } else {
            header("location: ../view/LoginView.php?error=dbError");
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

    function recoverPassword(Login $login) {
        return $this->data->recoverPassword($login);
    }

}
