<?php

class HeadquarterData {

    private $db;

    function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    private function lastID() {
        $queryLastId = $this->db->prepare("SELECT MAX(headquarterid) AS headquarterid  FROM tbheadquarter");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['headquarterid'] != NULL) {
            $nextId = (int) $resultLastId['headquarterid'] + 1;
        }
        return $nextId;
    }

    function insert(Headquarter $headquarter) {
        $nextId = $this->lastID();

        $query = $this->db->prepare("INSERT INTO tbheadquarter VALUES(:headquarterid,:headquartername,:headquarteruniversityid);");
        $query->execute(array("headquarterid" => $nextId, "headquartername" => $headquarter->getHeadquartername(),
            "headquarteruniversityid" => $headquarter->getHeadquarteruniversityid()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Headquarter $headquarter) {
        $query = $this->db->prepare("UPDATE tbheadquarter SET headquarterName='" . $headquarter->getHeadquartername() .
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
        $query = $this->db->prepare("SELECT h.*,u.universityname FROM tbheadquarter h INNER JOIN tbuniversity u ON u.universityid = h.headquarteruniversityid;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        $headquarters = [];
        foreach ($result as $row) {
            $currentheadquarter = new Headquarter();
            $currentheadquarter->setHeadquarterid($row['headquarterid']);
            $currentheadquarter->setHeadquartername($row['headquartername']);
            $currentheadquarter->setHeadquarteruniversityid($row['universityname']);
            array_push($headquarters, $currentheadquarter);
        }//End foreach ($result as $row)
        return $headquarters;
    }

    function selectbyUniversity(Headquarter $headquarter) {
        $query = $this->db->prepare("SELECT h.* FROM tbheadquarter h INNER JOIN tbuniversity u ON u.universityid = h.headquarteruniversityid WHERE u.universityid = :universityid");
        $query->execute(array("universityid" => $headquarter->getHeadquarteruniversityid()));
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
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

}
