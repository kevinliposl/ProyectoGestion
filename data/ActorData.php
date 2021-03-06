<?php

class ActorData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    private function getlastid() {
        $query = $this->db->prepare("SELECT MAX(actorid) AS id FROM tbactor");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        $id = 1;

        if ($result['id'] != NULL) {
            $id = intval($result['id']) + 1;
        }
        return $id;
    }

    private function existsActor(Actor $actor) {
        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actormail=:mail;");
        $queryExistsActor->execute(array('mail' => $actor->getActormail()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return !$resultActor['actormail'] ? 1 : 0;
    }

    private function insertActor(Actor $actor) {
        $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
        $queryInsertActor->execute(array('actorid' => $actor->getActorid(), 'actormail' => $actor->getActormail()));
        $queryInsertActor->fetch();
        $queryInsertActor->closeCursor();

        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actorid = :actorid;");
        $queryExistsActor->execute(array('actorid' => $actor->getActorid()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return $resultActor['actormail'] ? 1 : 0;
    }

    function insertAdministrative(Actor $actor) {
        if ($this->existsActor($actor)) {
            $actor->setActorid($this->getlastid());
            if ($this->insertActor($actor)) {
                $queryInsertProfessor = $this->db->prepare("INSERT INTO tbadministrative VALUES (:id,:license,:name,:lastname1,:lastname2,:area,:password,:state);");
                $queryInsertProfessor->execute(array('id' => $actor->getActorid(), 'license' => ' ', 'name' => $actor->getActorname(), 'area' => ' ',
                    'lastname1' => $actor->getActorlastname1(), 'lastname2' => ' ', 'password' => $actor->getActorpassword(), 'state' => 0));
                $queryInsertProfessor->fetch();
                $queryInsertProfessor->closeCursor();

                $queryExistsProfessor = $this->db->prepare("SELECT administrativeid FROM tbadministrative WHERE administrativeid=:id;");
                $queryExistsProfessor->execute(array('id' => $actor->getActorid()));
                $resultProfessor = $queryExistsProfessor->fetch();
                $queryExistsProfessor->closeCursor();

                return $resultProfessor['administrativeid'] ? 1 : 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}
