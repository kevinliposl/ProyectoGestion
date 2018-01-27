<?php

class StudentData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    private function getLastId() {
        $queryLastId = $this->db->prepare("SELECT MAX(studentid) AS studentid  FROM tbstudent");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        if ($resultLastId['studentid'] != NULL) {
            $nextId = (int) $resultLastId['studentid'] + 1;
        }
        return $nextId;
    }

    function insert(Student $student) {
        $idStudent = $this->getLastId();

        $queryInsertStudent = $this->db->prepare("INSERT INTO tbstudent VALUES (:id,:license,:name,:lastname1,:lastname2,:career1,:career2,:password,:state);");
        $queryInsertStudent->execute(array('id' => $idStudent, 'license' => $student->getStudentlicense(), 'name' => $student->getStudentname(),
            'lastname1' => $student->getStudentlastname1(), 'lastname2' => $student->getStudentlastname2(), 'career1' => $student->getStudentlastname2(),
            'career2' => $student->getStudentcareer2(), 'password' => $student->getStudentpassword(), 'state' => 0));
        $queryInsertStudent->fetch();

        $queryInsertStudent->closeCursor();
        $resultStudent = $this->select($idStudent);

        if (!$resultStudent->getId()) {
            $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:id,:mail);");
            $queryInsertActor->execute(array('id' => $idStudent, 'mail' => $student->getStudentmail()));
            $resultActor = $queryInsertActor->fetch();
            $queryInsertStudent->closeCursor();

            if (!$resultActor) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function update(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET studentcarnet=:license,studentname=:name,studentlastname1=:lastname1,studentlastname2=:lastname2,"
                . "studentcareer1=:career1, studentcareer2=:career2,studentpassword=:password WHERE studentid=:id;");
        $query->execute(array("license" => $student->getStudentlicense(), "name" => $student->getStudentname(), "lastname1" => $student->getStudentlastname1(),
            "lastname2" => $student->getStudentlastname2(), "career1" => $student->getStudentcareer1(), "career2" => $student->getStudentcareer2(),
            "password" => $student->getStudentpassword(), "id" => $student->getStudentid()));
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

        /* foreach ($result as $row) {

          $currentStudent->setId($row['studentid']);
          $currentStudent->setLicense($row['studentlicense']);
          $currentStudent->setName($row['studentname']);
          $currentStudent->setLastName1($row['studentlastname1']);
          $currentStudent->setLastName2($row['studentlastname2']);
          $currentStudent->setCareer1($row['studentcareer1']);
          $currentStudent->setCareer2($row['studentcareer2']);
          $currentStudent->getPassword($row['studentpassword']);

          array_push($students, $currentStudent);
          } */

        return $result;
    }

    function select($idStudent) {
        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE studentid=:id;");
        $query->execute(array("id" => $idStudent));
        $result = $query->fetch();
        $query->closeCursor();
        $Student = new Student();
        $Student->setStudentid($result['studentid']);
        $Student->setStudentlicense($result['studentlicense']);
        $Student->setStudentname($result['studentname']);
        $Student->setStudentlastname1($result['studentlastname1']);
        $Student->setStudentlastname2($result['studentlastname2']);
        $Student->setStudentcareer1($result['studentcareer1']);
        $Student->setStudentcareer2($result['studentcareer2']);
        $Student->getStudentpassword($result['studentpassword']);
        return $Student;
    }

    function delete(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET state=:state WHERE studentid=:id;");
        $query->execute(array('state' => 1, 'id' => $student->getStudentid()));
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
