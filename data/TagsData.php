<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Tag $tag) {
        $queryExistsTag = $this->db->prepare("SELECT tagword FROM tbtag WHERE tagactivityid=:activityid AND tagword=:word;");
        $queryExistsTag->execute(array('tagactivityid' => $tag->gettagactivityid(), 'word' => $tag->gettagword()));
        $resultTag = $queryExistsTag->fetch();
        $queryExistsTag->closeCursor();

        if ($resultTag['tagword'] == NULL) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word);");
            $queryInsertTag->execute(array());
            $queryInsertTag->fetch();

            $queryInsertTag->closeCursor();
            
            
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
