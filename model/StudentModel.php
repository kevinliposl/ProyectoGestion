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

        return $result;
    }

    public function update($id, $name, $lastname1, $lastname2, $career1, $career2) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    public function selectAll() {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function select($id) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function delete($id) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

}
