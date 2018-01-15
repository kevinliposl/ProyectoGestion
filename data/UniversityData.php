<?php

class UniversityData {

    private $db;

    function __construct() {
        require 'SPDO.php';
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

        $query = $this->db->prepare(
                "INSERT INTO tbuniversity VALUES (" . $nextId . "," .
                $university->getUniversitycode() . ",'" .
                $university->getUniversityname() . "'," .
                $university->getUniversitytype() . ");"
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

    function update(University $university) {
        $query = $this->db->prepare("UPDATE tbuniversity "
                . "SET universitycode=" . $university->getUniversitycode() .
                ", universityname='" . $university->getUniversityname() .
                "', universitytype=" . $university->getUniversitytype() .
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

    public function selectAll() {
        $query = $this->db->prepare("SELECT * FROM tbuniversity;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        $universitys = [];
        foreach ($result as $row) {
            $currentuniversity = new University();
            $currentuniversity->setUniversityid($row['universityid']);
            $currentuniversity->setUniversitycode($row['universitycode']);
            $currentuniversity->setUniversityname($row['universityname']);
            $currentuniversity->setUniversityType($row['universitytype']);
            array_push($universitys , $currentuniversity);
        }//End foreach ($result as $row)
        return $universitys;
    }

    public function select($universityCode) {
        $query = $this->db->prepare("SELECT * FROM tbuniversity WHERE universitycode=" . $universityCode . ";");
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function delete(University $university) {
        $query = $this->db->prepare("DELETE FROM tbuniversity WHERE universitycode=" . $university->getUniversitycode() . ";");
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}


