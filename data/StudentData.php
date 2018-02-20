<?php

class StudentData {

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
            $id = intval($result['id']) + 1;
        }
        return $id;
    }

    private function existsActor(Student $student) {
        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actormail=:mail;");
        $queryExistsActor->execute(array('mail' => $student->getStudentmail()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return !$resultActor['actormail'] ? 1 : 0;
    }

    private function insertActor(Student $student) {
        $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
        $queryInsertActor->execute(array('actorid' => $student->getStudentid(), 'actormail' => $student->getStudentmail()));
        $queryInsertActor->fetch();
        $queryInsertActor->closeCursor();

        $queryExistsActor = $this->db->prepare("SELECT actormail FROM tbactor WHERE actorid = :actorid;");
        $queryExistsActor->execute(array('actorid' => $student->getStudentid()));
        $resultActor = $queryExistsActor->fetch();
        $queryExistsActor->closeCursor();

        return $resultActor['actormail'] ? 1 : 0;
    }

    function insert(Student $student) {
        if ($this->existsActor($student)) {
            $student->setStudentid($this->getlastid());
            if ($this->insertActor($student)) {
                $queryInsertStudent = $this->db->prepare("INSERT INTO tbstudent VALUES (:id,:license,:name,:lastname1,:lastname2,:career1,:career2,:password,:state);");
                $queryInsertStudent->execute(array('id' => $student->getStudentid(), 'license' => ' ', 'name' => $student->getStudentname(),
                    'lastname1' => $student->getStudentlastname1(), 'lastname2' => $student->getStudentlastname2(), 'career1' => $student->getStudentcareer1(),
                    'career2' => 0, 'password' => $student->getStudentpassword(), 'state' => 0));
                $queryInsertStudent->fetch();
                $queryInsertStudent->closeCursor();

                $queryExistsStudent = $this->db->prepare("SELECT studentid FROM tbstudent WHERE studentid =:id;");
                $queryExistsStudent->execute(array('id' => $student->getStudentid()));
                $resultStudent = $queryExistsStudent->fetch();
                $queryExistsStudent->closeCursor();

                return $resultStudent['studentid'] ? 1 : 0;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function update(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent s INNER JOIN tbactor a ON a.actorid = s.studentid "
                . "SET s.studentlicense=:license, s.studentname=:name, s.studentlastname1=:lastname1, s.studentlastname2=:lastname2,"
                . "s.studentpassword=:password, s.studentcareer1=:career, a.actormail=:mail WHERE s.studentid=:id;");
        $query->execute(array("license" => $student->getStudentlicense(), "name" => $student->getStudentname(), "lastname1" => $student->getStudentlastname1(),
            "lastname2" => $student->getStudentlastname2(), "password" => $student->getStudentpassword(), "id" => $student->getStudentid(),
            "mail" => $student->getStudentmail(), "career" => $student->getStudentcareer1()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll() {
        $query = $this->db->prepare("SELECT s.*,a.actormail, c.careername FROM tbstudent s INNER JOIN tbcareer c ON s.studentcareer1 = c.careerid"
                . " INNER JOIN tbactor a ON a.actorid = s.studentid WHERE s.studentstate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

    function select($idStudent) {
        $query = $this->db->prepare("SELECT * FROM tbstudent WHERE studentid=:id;");
        $query->execute(array("id" => $idStudent));
        $result = $query->fetch();
        $query->closeCursor();
        $student = new Student();
        $student->setStudentid((int) $result['studentid']);
        //$student->setStudentmail($result['studentid']); Mail
        $student->setStudentlicense($result['studentlicense']);
        $student->setStudentname($result['studentname']);
        $student->setStudentlastname1($result['studentlastname1']);
        $student->setStudentlastname2($result['studentlastname2']);
        $student->setStudentcareer1($result['studentcareer1']);
        $student->setStudentcareer2($result['studentcareer2']);
        $student->getStudentpassword($result['studentpassword']);
        return $student;
    }

    function delete(Student $student) {
        $query = $this->db->prepare("UPDATE tbstudent SET studentstate=:state WHERE studentid=:id;");
        $query->execute(array('state' => 1, 'id' => $student->getStudentid()));
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
