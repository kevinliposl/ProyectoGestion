<?php

class StudentData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
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
                $student->getLicense() . "','" .
                $student->getName() . "','" .
                $student->getLastname1() . "','" .
                $student->getLastName2() . "'," .
                $student->getCareer1() . "," .
                $student->getCareer2() . ",'" .
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
        $query = $this->db->prepare("SELECT s.studentid, s.studentname, s.studentlicense, s.studentlastname1, s.studentlastname2, 
                                    s.studentpassword, c.careername FROM tbstudent AS s INNER JOIN tbcareer as c ON 
                                    s.studentcareer1=c.careerid AND s.studentstate=:state;");
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

    function select($idStudent) {
        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE studentid=" . $idStudent . ";");
        $query->execute();
        $result = $query->fetch();
        $Student = new Student();
        $Student->setId($result['studentid']);
        $Student->setLicense($result['studentlicense']);
        $Student->setName($result['studentname']);
        $Student->setLastName1($result['studentlastname1']);
        $Student->setLastName2($result['studentlastname2']);
        $Student->setCareer1($result['studentcareer1']);
        $Student->setCareer2($result['studentcareer2']);
        $Student->getPassword($result['studentpassword']);
        return $Student;
    }

    function delete(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET state=:state WHERE studentid=:id;");
        $query->execute(array('state' => 1, 'id' => $student->getId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
