<?php

//include_once 'Connection.php';
include '../domain/student.php';


class StudentDataMongo {


    public function insertStudent($student) {
        
        $status=0;
        $idEnclosure=0;
        
        $db = $this->db->db_local;
        $collection = $db->selectCollection('tbStudent');
        $studentA = array(
            'idStudent'=> $student->getIdStudent(),
            'name'=> $student->getName() ,
            'lastName1'=> $student->getLastName1() ,
            'lastName2'=> $student->getLastName2() ,
            'firstCareer'=> $student->getFirstCareer() ,
            'secondCareer'=> $student->getSecondCareer() ,
            'status'=> $status ,
            'password'=> $student->getPassword() ,
            'idEnclosure'=> $idEnclosure 
        );
        $consult = $collection->insert($studentA);
        return $consult;
    }

    public function updateStudent($student) {
        
        $status=0;
        $idEnclosure=0;
        
        $db = $this->db->db_local;
        $collection = $db->selectCollection('tbStudent');
        $studentA = array(
            'idStudent'=> $student->getIdStudent(),
            'name'=> $student->getName() ,
            'lastName1'=> $student->getLastName1() ,
            'lastName2'=> $student->getLastName2() ,
            'firstCareer'=> $student->getFirstCareer() ,
            'secondCareer'=> $student->getSecondCareer() ,
            'status'=> $status ,
            'password'=> $student->getPassword() ,
            'idEnclosure'=> $idEnclosure 
        );
        $consult = $collection->update(['idStudent' => $student->getIdStudent()], $studentA);
        return $consult;
    }

    public function getStudent($idStudent) {
        $db = $this->db->db_local;
        $collection = $db->selectCollection('tbStudent');
        $consult = $collection->findOne(['idStudent' => $idStudent]);
        return $consult;
    }

    public function deleteStudent($idStudent) {
        
        $status=0;
        
        $db = $this->db->db_local;
        $collection = $db->selectCollection('tbStudent');
        $studentA = array(
            'status'=> $status 
        );
        $consult = $collection->update(['idStudent' => $idStudent()], $studentA);
        return $consult;
    }

}

