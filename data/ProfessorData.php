<?php

class ProfessorData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Professor $professor) {    

        $queryLastId = $this->db->prepare("SELECT MAX(professorid) AS professorid  FROM tbprofessor");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['professorid'] != NULL) {
            $nextId = (int) $resultLastId['professorid'] + 1;
        }
        $query = $this->db->prepare(
                "INSERT INTO tbprofessor VALUES (" . $nextId . ",'" .
                $professor->getProfessorlicense() . "','" .
                $professor->getProfessorname() . "','" .
                $professor->getProfessorlastname1() . "','" .
                $professor->getProfessorlastname2() . "'," .
                $professor->getProfessorpassword() . "'," .
                0 . ");"
        );
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
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
        $query = $this->db->prepare("SELECT * from tbprofessor where professorstate=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll(); //PDO::FETCH_ASSOC
        $query->closeCursor();
        
        //$students = [];
        //$currentStudent = new Student();
        
        /*foreach ($result as $row) {
            
            $currentStudent->setId($row['studentid']);
            $currentStudent->setLicense($row['studentlicense']);
            $currentStudent->setName($row['studentname']);
            $currentStudent->setLastName1($row['studentlastname1']);
            $currentStudent->setLastName2($row['studentlastname2']);
            $currentStudent->setCareer1($row['studentcareer1']);
            $currentStudent->setCareer2($row['studentcareer2']);
            $currentStudent->getPassword($row['studentpassword']);
            
            array_push($students, $currentStudent);
        }*/
        
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
