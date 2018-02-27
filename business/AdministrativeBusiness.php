<?php

require '../domain/Administrative.php';
require_once '../util/RandomPassGenerator.php';
require_once '../util/SMail.php';
require_once '../util/SSession.php';
require_once '../data/LoginData.php';
require_once '../domain/Login.php';

if (isset($_POST['create'])) {
    if (isset($_POST['actormail']) && isset($_POST['actorname']) && isset($_POST['actorlastname1']) && isset($_POST['actorlastname2']) && isset($_POST['actorarea'])) {
        if (strlen($_POST['actormail']) > 0 && strlen($_POST['actorname']) > 0 && strlen($_POST['actorlastname1']) > 0 && strlen($_POST['actorlastname2']) > 0 &&
                strlen($_POST['actorarea']) > 0 && filter_var($_POST['actormail'], FILTER_VALIDATE_EMAIL)) {

            $administrativeBusiness = new AdministrativeBusiness;
            $administrative = new Administrative;

            $administrative->setAdministrativemail($_POST['actormail']);
            $administrative->setAdministrativename($_POST['actorname']);
            $administrative->setAdministrativelastname1($_POST['actorlastname1']);
            $administrative->setAdministrativelastname2($_POST['actorlastname2']);
            $administrative->setAdministrativearea($_POST['actorarea']);
            $administrative->setAdministrativepassword(RandomPassGenerator::getInstance()->keygen(10));

            $result = $administrativeBusiness->insert($administrative);
            if ($result) {
                while (!SMail::getInstance()->sendMail($administrative->getAdministrativemail(), 'Contraseña temporal', 'La contraseña del sitio es la siguiente ' . $administrative->getAdministrativepassword()));
            }
            echo json_encode(array('result' => $result));
        } else {
            echo json_encode(array('result' => -1));
        }
    } else {
        echo json_encode(array('result' => -2));
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['administrativeid'])) {
        if (strlen($_POST['administrativeid']) > 0) {
            $administrativeBusiness = new AdministrativeBusiness();
            $administrative = new Administrative;

            $administrative->setAdministrativeid($_POST['administrativeid']);
            $result = $administrativeBusiness->delete($administrative);

            if ($result == 1) {
                header("location: ../view/AdministrativeView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeView.php?error=empty");
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['administrativelicense']) && isset($_POST['administrativemail']) && isset($_POST['administrativename']) && isset($_POST['administrativelastname1']) &&
            isset($_POST['administrativelastname2']) && isset($_POST['administrativearea']) && isset($_POST['administrativepassword']) && isset($_POST['administrativeid'])) {
        if (strlen($_POST['administrativelicense']) > 0 && strlen($_POST['administrativemail']) > 0 && strlen($_POST['administrativename']) > 0 && strlen($_POST['administrativelastname1']) > 0 && strlen($_POST['administrativelastname2']) > 0 && strlen($_POST['administrativearea']) > 0 &&
                strlen($_POST['administrativepassword']) > 0 && filter_var($_POST['administrativemail'], FILTER_VALIDATE_EMAIL)) {

            $administrativeBusiness = new AdministrativeBusiness;
            $administrative = new Administrative;

            $administrative->setAdministrativeid($_POST['administrativeid']);
            $administrative->setAdministrativelicense($_POST['administrativelicense']);
            $administrative->setAdministrativemail($_POST['administrativemail']);
            $administrative->setAdministrativename($_POST['administrativename']);
            $administrative->setAdministrativelastname1($_POST['administrativelastname1']);
            $administrative->setAdministrativelastname2($_POST['administrativelastname2']);
            $administrative->setAdministrativearea($_POST['administrativearea']);
            $administrative->setAdministrativepassword($_POST['administrativepassword']);

            $result = $administrativeBusiness->update($administrative);
            if ($result == 1) {
                $login = new Login();
                $login->setLoginMail($_POST['administrativemail']);
                $login->setLoginPassword($_POST['administrativepassword']);
                $logind = new LoginData();
                $result = $logind->authenticate($login);
                SSession::getInstance()->user = $result;
                header("location: ../view/AdministrativeView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeView.php?error=empty");
    }
}

class AdministrativeBusiness {

    private $data;

    function __construct() {
        include_once '../data/AdministrativeData.php';
        $this->data = new AdministrativeData();
    }

    function insert(Administrative $administrative) {
        return $this->data->insert($administrative);
    }

    function delete(Administrative $administrative) {
        return $this->data->delete($administrative);
    }

    function update(Administrative $administrative) {
        return $this->data->update($administrative);
    }

    function selectAll() {
        return $this->data->selectAll();
    }

}
