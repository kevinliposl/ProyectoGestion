<?php

class StudentData {

    private $db;

    function __construct() {
        require 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Student $student) {
        $queryLastId = $this->db->prepare("SELECT MAX(studentid) AS studentid  FROM tbstudent");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['studentid'] != NULL) {
            $nextId = (int) $resultLastId['studentid'] + 1;
        }

        $query = $this->db->prepare(
                "INSERT INTO tbstudent VALUES (" . $nextId . ",'" .
                $student->getCarnet() . "','" .
                $student->getName() . "','" .
                $student->getLastname1() . "','" .
                $student->getLastName2() . "'," .
                $student->getCareer1() . "," .
                $student->getCareer2() . "," .
                $student->getHeadquarters() . ",'" .
                $student->getPassword() . "'," .
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

    function update(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent "
                . "SET studentid =" . $student->getId() .
                ", studentcarnet='" . $student->getCarnet() .
                "', studentname='" . $student->getName() .
                "', studentlastname1='" . $student->getLastName1() .
                "', studentlastname2='" . $student->getLastName2() .
                "', studentcareer1=" . $student->getCareer1() .
                ", studentcareer2=" . $student->getCareer2() .
                ", studentheadquarters=" . $student->getHeadquarters() .
                ", studentpassword='" . $student->getPassword() .
                "' WHERE studentid=" . $student->getId() . ";");
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
        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE state=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

//    function select($idStudent) {
//        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE studentid=" . $idStudent . ";");
//        $query->execute();
//        $result = $query->fetch();
//        return $result;
//    }

    function delete(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET state=:state WHERE studentid=:id;");
        $query->execute(array('state' => 1, 'id' => $student->getId()));
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
