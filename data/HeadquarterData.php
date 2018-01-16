<?php

class HeadquarterData {

    private $db;

    function __construct() {
        require_once 'SPDO.php';
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
                "INSERT INTO tbheadquarter VALUES (" . $nextId . "," .
                $headquarter->getHeadquartercode() . ",'" .
                $headquarter->getHeadquartername() . "','" .
                $headquarter->getHeadquarterlocation() . "'," .
                $headquarter->getHeadquarteruniversityid() . ");"
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
                . "SET  headquarterCode=" . $headquarter->getHeadquartercode() .
                ", headquarterName='" . $headquarter->getHeadquartername() .
                "', headquarterLocation='" . $headquarter->getHeadquarterlocation() .
                "', headquarterUniversityId=" . $headquarter->getHeadquarteruniversityid() .
                " WHERE headquarterCode=" . $headquarter->getHeadquartercode() . ";");
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
        $query = $this->db->prepare("SELECT * FROM tbheadquarter;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        $headquarters = [];
        foreach ($result as $row) {
            $currentheadquarter = new Headquarter();
            $currentheadquarter->setHeadquarterid($row['headquarterid']);
            $currentheadquarter->setHeadquartercode($row['headquartercode']);
            $currentheadquarter->setHeadquartername($row['headquartername']);
            $currentheadquarter->setHeadquarterlocation($row['headquarterlocation']);
            $currentheadquarter->setHeadquarteruniversityid($row['headquarteruniversityid']);
            array_push($headquarters , $currentheadquarter);
        }//End foreach ($result as $row)
        return $headquarters;
    }

    function select(Headquarter $headquarter) {
        $query = $this->db->prepare("SELECT * FROM tbheadquarter WHERE headquartercode=" . $headquarter->getHeadquartercode() . ";");
        $query->execute();
        $result = $query->fetch();
        $headquarter->setHeadquarterid($result['headquarterid']);
        $headquarter->setHeadquartercode($result['headquartercode']);
        $headquarter->setHeadquartername($result['headquartername']);
        $headquarter->setHeadquarterlocation($result['headquarterlocation']);
        $headquarter->setHeadquarteruniversityid($result['headquarteruniversityid']);
        return $headquarter;
    }

    function delete(Headquarter $headquarter) {
        $query = $this->db->prepare("DELETE FROM tbheadquarter WHERE headquartercode=" . $headquarter->getHeadquartercode() . ";");
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}



