<?php

class UniversityData {

    private $db;

    function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(University $university) {
        $queryLastId = $this->db->prepare("SELECT MAX(universityid) AS universityid  FROM tbuniversity");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['universityid'] != NULL) {
            $nextId = (int) $resultLastId['universityid'] + 1;
        }
        //universityid, universityname, universitytype, universitystate, universityhadheadquarter
        $query = $this->db->prepare("INSERT INTO tbuniversity VALUES(:id,:name,:type,:state,:headquarter);");
        $query->execute(array('id' => $nextId,'name' => (string) $university->getUniversityname(),
            'type' => $university->getUniversityType(), 'state' => 1, 'headquarter' => $university->getUniversityhadheadquarter()));
        
        $result = $query->fetchAll();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(University $university) {
        $query = $this->db->prepare("UPDATE tbuniversity "
                . "SET universitycode=" . $university->getUniversitycode() .
                ", universityname='" . $university->getUniversityname() .
                "', universitytype=" . $university->getUniversitytype() .
                ", universityheadquarter=". $university->getUniversityHeadquarter().
                " WHERE universitycode=" . $university->getUniversitycode() . ";");
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
        $query = $this->db->prepare("SELECT * FROM tbuniversity WHERE universitystate=:state;");
        $query->execute(array('state' => 1));
        $result = $query->fetchAll();
        $query->closeCursor();

        $universities = [];

        foreach ($result as $row) {
            $currentuniversity = new University();
            $currentuniversity->setUniversityid($row['universityid']);
            $currentuniversity->setUniversityname($row['universityname']);
            $currentuniversity->setUniversityType($row['universitytype']);
            $currentuniversity->setUniversityhadheadquarter($row['universityhadheadquarter']);
            array_push($universities, $currentuniversity);
        }//End foreach ($result as $row)

        return $universities;
    }

    public function delete(University $university) {
        $query = $this->db->prepare("UPDATE tbuniversity SET universitystate=:state WHERE universityid=:id;");
        $query->execute(array('id' => $university->getUniversityid(), 'state' => 0));
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}