<?php

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

    function insert(Professor $professor) {
        $queryChecking = $this->db->prepare("SELECT actorid FROM tbactor WHERE actormail=:actormail;");
        $queryChecking->execute(array('actormail' => $professor->getProfessormail()));
        $resultChecking = $queryChecking->fetch();
        $queryChecking->closeCursor();

        if (!isset($resultChecking['actorid'])) {
            $lastid = $this->getlastid();
            $queryProfessor = $this->db->prepare("INSERT INTO tbprofessor VALUES (:professorid,:professorlicense,:professorname,:professorlastname1,:professorlastname2,:professorpassword,:professorstate);");
            $queryProfessor->execute(array('professorid' => $lastid, 'professorlicense' => $professor->getProfessorlicense(), 'professorname' => $professor->getProfessorname(),
                'professorlastname1' => $professor->getProfessorlastname1(), 'professorlastname2' => $professor->getProfessorlastname2(), 'professorpassword' => $professor->getProfessorpassword(),
                'professorstate' => 1));
            $queryProfessor->fetch();
            $queryProfessor->closeCursor();

            $queryActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
            $queryActor->execute(array('actorid' => $lastid, 'actormail' => $professor->getProfessormail()));
            $queryActor->fetch();
            $queryActor->closeCursor();

            $queryVerifyResult = $this->db->prepare('SELECT p.professorname FROM tbprofessor p INNER JOIN tbactor a ON a.actorid = p.professorid WHERE p.professorid=:professorid;');
            $queryVerifyResult->execute(array('professorid' => $lastid));
            $result = $queryVerifyResult->fetch();
            $queryVerifyResult->closeCursor();

            if (isset($result['professorname'])) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function update(Professor $professor) {
        $query = $this->db->prepare("UPDATE tbprofessor "
                . "SET professorid =" . $professor->getProfessorid() .
                ", professorlicense='" . $professor->getProfessorlicense() .
                "', professorname='" . $professor->getProfessorname() .
                "', professorlastname1='" . $professor->getProfessorlastname1() .
                "', professorlastname2='" . $professor->getProfessorlastname2() .
                "', professorpassword='" . $professor->getProfessorpassword() .
                "' WHERE professorid=" . $professor->getProfessorid() . ";");
        $query->execute();
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
        $query->execute(array('state' => 1));
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
        $query = $this->db->prepare("UPDATE tbprofessor SET professorstate=:state WHERE professorid=:id;");
        $query->execute(array('state' => 1, 'id' => $professor->getProfessorid()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
