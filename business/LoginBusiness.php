<?php

require '../domain/Login.php';
require_once '../util/SSession.php';
require_once '../util/SMail.php';
require_once '../util/RSA.php';

if (isset($_POST['login'])) {
    if (isset($_POST['loginPassword']) && isset($_POST['loginMail'])) {
        $keyPrivate = SSession::getInstance()->keys['privatekey'];
        $email = RSA::getInstance()->decrypt($keyPrivate, $_POST["loginMail"]);
        $pass = RSA::getInstance()->decrypt($keyPrivate, $_POST["loginPassword"]);
        if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($pass)) {
            $loginBusiness = new LoginBusiness();
            $login = new Login();

            $login->setLoginMail($email);
            $login->setLoginPassword($pass);
            $result = $loginBusiness->authenticate($login);

            if ($result != false) {
                SSession::getInstance()->user = $result;
                echo json_encode(array('result' => 1));
            } else {
                echo json_encode(array('result' => 0));
            }
        } else {
            echo json_encode(array('result' => -1));
        }
    } else {
        echo json_encode(array('result' => -2));
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
if (isset($_POST['recover'])) {
    if (isset($_POST['actormail'])) {
        if (filter_var($_POST['actormail'], FILTER_VALIDATE_EMAIL)) {
            $loginBusiness = new LoginBusiness();
            $login = new Login();

            $login->setLoginMail($_POST['actormail']);

            $result = $loginBusiness->recoverPassword($login);
            if (isset($result)) {
                while (!SMail::getInstance()->sendMail($login->getLoginMail(), 'Recordatorio de contraseña', 'La contraseña del sitio es la siguiente ' . $result[$result['type'] . 'password']));
                header("location: ../view/RecoverPasswordView.php?success=recover");
            } else {
                header("location: ../view/RecoverPasswordView.php?error=dbError");
            }
        } else {
            header("location: ../view/RecoverPasswordView.php?error=format");
        }
    } else {
        header("location: ../view/RecoverPasswordView.php?error=empty");
    }
}

class LoginBusiness {

    private $data;

    function __construct() {
        include_once '../data/LoginData.php';
        $this->data = new LoginData();
    }

    function recoverPassword(Login $login) {
        return $this->data->recoverPassword($login);
    }

    function authenticate(Login $login) {
        return $this->data->authenticate($login);
    }

}
