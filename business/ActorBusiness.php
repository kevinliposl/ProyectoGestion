<?php

require '../domain/Actor.php';
require_once '../util/RandomPassGenerator.php';

if (isset($_POST['create'])) {
    if (isset($_POST['actorname']) && isset($_POST['actortype']) && isset($_POST['actormail']) && isset($_POST['actorlastname1'])) {
        if (strlen($_POST['actorname']) > 0 && strlen($_POST['actortype']) > 0 && strlen($_POST['actorlastname1']) > 0 &&
                filter_var($_POST['actormail'], FILTER_VALIDATE_EMAIL)) {
            $actorBusiness = new ActorBusiness;
            $actor = new Actor;

            $actor->setActormail($_POST['actormail']);
            $actor->setActortype($_POST['actortype']);
            $actor->setActorname($_POST['actorname']);
            $actor->setActorlastname1($_POST['actorlastname1']);
            $actor->setActorpassword(RandomPassGenerator::getInstance()->keygen(10));

            $result;
            if ($actor->getActortype() == 'Student') {
                $result = $actorBusiness->insertStudent($actor);
            } elseif ($actor->getActortype() == 'Professor') {
                $result = $actorBusiness->insertProfessor($actor);
            } else {
                $result = $actorBusiness->insertAdministrative($actor);
            }

            if ($result == 1) {
                while (!SMail::getInstance()->sendMail($actor->getActormail(), 'Contraseña temporal', 'La contraseña del sitio es la siguiente ' . $actor->getActorpassword()));
                header("location: ../view/RegisterView.php?success=inserted");
            } else {
                header("location: ../view/RegisterView.php?error=dbError");
            }
        } else {
            header("location: ../view/RegisterView.php?error=format");
        }
    } else {
        header("location: ../view/RegisterView.php?error=empty");
    }
}

class ActorBusiness {

    private $data;

    function __construct() {
        include_once '../data/ActorData.php';
        $this->data = new ActorData();
    }

    function insertStudent(Actor $actor) {
        return $this->data->insertStudent($actor);
    }

    function insertProfessor(Actor $actor) {
        return $this->data->insertProfessor($actor);
    }

    function insertAdministrative(Actor $actor) {
        return $this->data->insertAdministrative($actor);
    }

}
