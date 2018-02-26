<?php

require_once '../util/SSession.php';

class ProfessorData {

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

    private function existsActor(Professor $professor) {
        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actormail=:mail;");
        $queryExistsActor->execute(array('mail' => $professor->getProfessormail()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return !$resultActor['actormail'] ? 1 : 0;
    }

    private function insertActor(Professor $professor) {
        $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
        $queryInsertActor->execute(array('actorid' => $professor->getProfessorid(), 'actormail' => $professor->getProfessormail()));
        $queryInsertActor->fetch();
        $queryInsertActor->closeCursor();

        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actorid = :actorid;");
        $queryExistsActor->execute(array('actorid' => $professor->getProfessorid()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return $resultActor['actormail'] ? 1 : 0;
    }

    function insert(Professor $professor) {
        if ($this->existsActor($professor)) {
            $professor->setProfessorid($this->getlastid());
            if ($this->insertActor($professor)) {
                $queryInsertProfessor = $this->db->prepare("INSERT INTO tbprofessor VALUES (:id,:license,:name,:lastname1,:lastname2,:password,:state);");
                $queryInsertProfessor->execute(array('id' => $professor->getProfessorid(), 'license' => ' ', 'name' => $professor->getProfessorname(),
                    'lastname1' => $professor->getProfessorlastname1(), 'lastname2' => $professor->getProfessorlastname2(),
                    'password' => $professor->getProfessorpassword(), 'state' => 0));
                $queryInsertProfessor->fetch();
                $queryInsertProfessor->closeCursor();

                $queryExistsProfessor = $this->db->prepare("SELECT professorid FROM tbprofessor WHERE professorid =:id;");
                $queryExistsProfessor->execute(array('id' => $professor->getProfessorid()));
                $resultProfessor = $queryExistsProfessor->fetch();
                $queryExistsProfessor->closeCursor();

                return $resultProfessor['professorid'] ? 1 : 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function update(Professor $professor) {
        if($professor->getProfessorpassword() != SSession::getInstance()->user['professorpassword']){
           $queryP =$this->db->prepare("UPDATE tbactor set actorchangedpassword = 1 WHERE actorid =".SSession::getInstance()->user['actorid']);
           $queryP->execute();
           $queryP->fetch();
           $queryP->closeCursor(); 
        }
        $query = $this->db->prepare("UPDATE tbprofessor p INNER JOIN tbactor a ON a.actorid = p.professorid "
                . "SET p.professorlicense =:license, p.professorname=:name, p.professorlastname1=:lastname1, p.professorlastname2=:lastname2, p.professorpassword=:password,"
                . " a.actormail=:mail WHERE p.professorid=:id;");
        $query->execute(array('mail' => $professor->getProfessormail(), 'license' => $professor->getProfessorlicense(), 'name' => $professor->getProfessorname(), 'lastname1' => $professor->getProfessorlastname1(),
            'lastname2' => $professor->getProfessorlastname2(), 'password' => $professor->getProfessorpassword(), 'id' => $professor->getProfessorid()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll() {
        $query = $this->db->prepare("SELECT a.actormail,p.* from tbprofessor p INNER JOIN tbactor a ON a.actorid = p.professorid WHERE professorstate=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $result;
    }

    function select($idProfessor) {
        $query = $this->db->prepare("SELECT * FROM tbprofessor WHERE professorid=" . $idProfessor . ";");
        $query->execute();
        $result = $query->fetch();

        $professor = new Professor();
        $professor->setProfessorid($result['professorid']);
        $professor->setProfessorlicense($result['professorlicense']);
        $professor->setProfessorname($result['professorname']);
        $professor->setProfessorlastname1($result['professorlastname1']);
        $professor->setProfessorlastname2($result['professorlastname2']);
        $professor->setProfessorpassword($result['professorpassword']);
        return $professor;
    }

    function delete(Professor $professor) {
        $query = $this->db->prepare("UPDATE tbprofessor SET professorstate=:state WHERE professorid=:professorid;");
        $query->execute(array('state' => 0, 'professorid' => $professor->getProfessorid()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
