<?php

class StudentModel {

    private $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function insert(Student $student) {

        //obtener ultimo id de estudiante
        $queryLastId = $this->db->prepare("SELECT MAX(studentid) AS studentid  FROM tbstudent");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;
 
        //ultimo id
        if ($resultLastId['studentid'] != NULL) {
            $nextId = $resultLastId['studentid'] + 1;
        }

        //insertar estudiante
        //status empieza en 0 
        $status = 0;

        $query = $this->db->prepare("INSERT INTO tbstudent VALUES (" . $nextId . ",'" .
                $student->getName() . "','" .
                $student->getLastname1() . "','" .
                $student->getLastName2() . "'," .
                $student->getCareer1() . "," .
                $student->getCareer2() . "," .
                $student->getHeadquarters() . ",'" .
                $student->getPassword() . "'," .
                $status . ");");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        
        if(!$result){
            return array("result" => "1");
        }else{
            return array("result" => "0");
        }
    }

    public function update(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET studentid =" . $student->getId() .
                ", studentname='" . $student->getName() .
                "', studentlastName1='" . $student->getLastName1() .
                "', studentlastName2='" . $student->getLastName2() .
                "', studentcareer1=" . $student->getFirstCareer() .
                ", studentcareer2=" . $student->getSecondCareer() .
                ", studentheadquarters=" . $student->getHeadquarters() .
                ", studentpassword='" . $student->getPassword() .
                "' WHERE studentid=" . $student->getId() . ";");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        
        if(!$result){
            return array("result" => "1");
        }else{
            return array("result" => "0");
        }
    }

    public function selectAll() {
        $query = $this->db->prepare("SELECT * FROM tbstudent;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function select($idStudent) {
        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE studentid=" . $idStudent . ";");
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function delete(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET status=" . 0 . " WHERE studentid=" . $student->getId() . ";");
        $query->execute();
        $result = $query->fetch();

        if(!$result){
            return array("result" => "1");
        }else{
            return array("result" => "0");
        }
    }

}
