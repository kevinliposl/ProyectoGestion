<?php

require_once '../util/SSession.php';

class AdministrativeData {

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
            $id = (int) $result['id'] + 1;
        }
        return $id;
    }

    private function existsActor(Administrative $administrative) {
        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actormail=:mail;");
        $queryExistsActor->execute(array('mail' => $administrative->getAdministrativemail()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return !$resultActor['actormail'] ? 1 : 0;
    }

    private function insertActor(Administrative $administrative) {
        $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
        $queryInsertActor->execute(array('actorid' => $administrative->getAdministrativeid(), 'actormail' => $administrative->getAdministrativemail()));
        $queryInsertActor->fetch();
        $queryInsertActor->closeCursor();

        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actorid = :actorid;");
        $queryExistsActor->execute(array('actorid' => $administrative->getAdministrativeid()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return $resultActor['actormail'] ? 1 : 0;
    }

    function insert(Administrative $administrative) {
        if ($this->existsActor($administrative)) {
            $administrative->setAdministrativeid($this->getlastid());
            if ($this->insertActor($administrative)) {
                $queryInsertProfessor = $this->db->prepare("INSERT INTO tbadministrative VALUES (:id,:license,:name,:lastname1,:lastname2,:area,:password,:state);");
                $queryInsertProfessor->execute(array('id' => $administrative->getAdministrativeid(), 'license' => ' ', 'name' => $administrative->getAdministrativename(),
                    'lastname1' => $administrative->getAdministrativelastname1(), 'lastname2' => $administrative->getAdministrativelastname2(),
                    'password' => $administrative->getAdministrativepassword(), 'state' => 0, 'area' => $administrative->getAdministrativearea()));
                $queryInsertProfessor->fetch();
                $queryInsertProfessor->closeCursor();

                $queryExistsProfessor = $this->db->prepare("SELECT administrativeid FROM tbadministrative WHERE administrativeid =:id;");
                $queryExistsProfessor->execute(array('id' => $administrative->getAdministrativeid()));
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

    function update(Administrative $administrative) {
        if($administrative->getAdministrativepassword() != SSession::getInstance()->user['administrativepassword']){
           $queryP =$this->db->prepare("UPDATE tbactor set actorchangedpassword = 1 WHERE actorid =".SSession::getInstance()->user['actorid']);
           $queryP->execute();
           $queryP->fetch();
           $queryP->closeCursor(); 
        }
        $query = $this->db->prepare("UPDATE tbadministrative "
                . "SET administrativelicense =:license, administrativename =:name, administrativelastname1=:lastname1,"
                . "administrativelastname2 =:lastname2, administrativepassword =:password,administrativearea =:area WHERE administrativeid =:id;");
        $query->execute(array('license' => $administrative->getAdministrativelicense(), 'name' => $administrative->getAdministrativename(), 'lastname1' => $administrative->getAdministrativelastname1(),
            'lastname2' => $administrative->getAdministrativelastname2(), 'password' => $administrative->getAdministrativepassword(), 'area' => $administrative->getAdministrativearea(),
            'id' => $administrative->getAdministrativeid()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll() {
        $query = $this->db->prepare("SELECT ac.actormail,ad.* from tbadministrative ad INNER JOIN tbactor ac ON ac.actorid = ad.administrativeid WHERE administrativestate=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $result;
    }

    function select($idAdministrative) {
        $query = $this->db->prepare("SELECT * FROM tbadministrative WHERE administrativeid=" . $idAdministrative . ";");
        $query->execute();
        $result = $query->fetch();

        $administrative = new Administrative();
        $administrative->setAdministrativeid($result['administrativeid']);
        $administrative->setAdministrativelicense($result['administrativelicense']);
        $administrative->setAdministrativename($result['administrativename']);
        $administrative->setAdministrativelastname1($result['administrativelastname1']);
        $administrative->setAdministrativelastname2($result['administrativelastname2']);
        $administrative->setAdministrativearea($result['administrativearea']);
        $administrative->setAdministrativepassword($result['administrativepassword']);

        return $administrative;
    }

    function delete(Administrative $administrative) {
        $query = $this->db->prepare("UPDATE tbadministrative SET administrativestate=:state WHERE administrativeid=:id;");
        $query->execute(array('state' => 0, 'id' => $administrative->getAdministrativeid()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
