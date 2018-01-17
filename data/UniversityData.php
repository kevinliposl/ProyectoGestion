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

        $query = $this->db->prepare("INSERT INTO tbuniversity VALUES(:id,:code,:name,:type,:state),:headquarter;");
        $query->execute(array('id' => $nextId, 'code' => $university->getUniversitycode(),
            'name' => (string) $university->getUniversityname(), 'type' => $university->getUniversitytype(), 'state' => 1, 'headquarter' => $university->getUniversityHeadquarter()));
        
        $result = $query->fetch();
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
            $currentuniversity->setUniversitycode($row['universitycode']);
            $currentuniversity->setUniversityname($row['universityname']);
            $currentuniversity->setUniversityType($row['universitytype']);
            $currentuniversity->setUniversityHeadquarter($row['universityheadquarter']);
            array_push($universities, $currentuniversity);
        }//End foreach ($result as $row)

        return $universities;
    }

    public function select($universityCode) {
        $query = $this->db->prepare("SELECT * FROM tbuniversity WHERE universitycode=" . $universityCode . ";");
        $query->execute();
        $result = $query->fetch();
        $university = new University();
        $university->setUniversityid($result['universityid']);
        $university->setUniversitycode($result['universitycode']);
        $university->setUniversityname($result['universityname']);
        $university->setUniversityType($result['universitytype']);
        $university->setUniversityHeadquarter($result['universityheadquarter']);
        return $university;
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