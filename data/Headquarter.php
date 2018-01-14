<?php

class HeadquarterData {

    private $db;

    function __construct() {
        require 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Headquarter $headquarter) {
        $queryLastId = $this->db->prepare("SELECT MAX(headquarterid) AS headquarterid  FROM tbheadquarter");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['headquarterid'] != NULL) {
            $nextId = (int) $resultLastId['headquarterid'] + 1;
        }

        $query = $this->db->prepare(
                "INSERT INTO tbheadquarter VALUES (" . $nextId . ",'" .
                $headquarter->getHeadquarterCode() . "','" .
                $headquarter->getHeadquarterName() . "','" .
                $headquarter->getHeadquarterLocation() . "','" .
                ");"
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

    function update(Headquarter $headquarter) {
        $query = $this->db->prepare("UPDATE tbheadquarter "
                . "SET headquarterId =" . $headquarter->getHeadquarterId() .
                ", headquarterCode=" . $headquarter->getHeadquarterCode() .
                ", headquarterName='" . $headquarter->getHeadquarterName() .
                "', headquarterLocation=" . $headquarter->getHeadquarterLocation() .
                " WHERE headquarterCode=" . $headquarter->getHeadquarterCode() . ";");
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
        $query = $this->db->prepare("SELECT * FROM tbheadquarter;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function select($headquarterCode) {
        $query = $this->db->prepare("SELECT * FROM tbheadquarter WHERE headquartercode=" . $headquarterCode . ";");
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function delete(Headquarter $headquarter) {
        $query = $this->db->prepare("DELETE FROM tbuheadquarter WHERE headquartercode=" . $headquarter->getHeadquarterCode() . ";");
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}



