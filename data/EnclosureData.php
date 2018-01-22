<?php

class EnclosureData {

    private $db;

    function __construct() {
        require_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function lastID() {
        $queryLastId = $this->db->prepare("SELECT MAX(enclosureid) AS enclosureid  FROM tbenclosure");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['enclosureid'] != NULL) {
            $nextId = (int) $resultLastId['enclosureid'] + 1;
        }
        return $nextId;
    }

    function insertOnly(Enclosure $enclosure) {
        $nextId = $this->lastID();

        $query = $this->db->prepare("INSERT INTO tbenclosure VALUES(:enclosureid,:enclosurename,:enclosureheadquarterid,:enclosureuniversityid);");
        $query->execute(array("enclosureid" => $nextId, "enclosureheadquarterid" => 0, "enclosureuniversityid" => $enclosure->getEnclosureuniversityid(),
            "enclosurename" => $enclosure->getEnclosurename()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function insert(Enclosure $enclosure) {
        $nextId = $this->lastID();

        $query = $this->db->prepare("INSERT INTO tbenclosure VALUES(:enclosureid,:enclosurename,:enclosureheadquarterid,:enclosureuniversityid);");
        $query->execute(array("enclosureid" => $nextId, "enclosureheadquarterid" => $enclosure->getEnclosureheadquarterid(),
            "enclosureuniversityid" => $enclosure->getEnclosureuniversityid(), "enclosurename" => $enclosure->getEnclosurename()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Enclosure $enclosure) {
        $query = $this->db->prepare("UPDATE tbenclosure SET enclosurename = :enclosurename WHERE enclosureid = :enclosureid;");
        $query->execute(array("enclosureid" => $enclosure->getEnclosureid(), "enclosurename" => $enclosure->getEnclosurename()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectByUniversity() {


        $queryCareer = $this->db->prepare("SELECT u.universityname, u.universityid, h.headquartername, h.headquarterid, e.enclosurename, e.enclosureid from tbuniversity as u inner join tbheadquarter as h on u.universityid = h.headquarteruniversityid inner join tbenclosure as e on h.headquarterid = e.enclosureheadquarterid order by(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();

        return $result;
    }

    function selectAll() {
        $query = $this->db->prepare("SELECT * FROM tbenclosure;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        $enclosures = [];
        foreach ($result as $row) {
            $current = new Enclosure();
            $current->setEnclosureid($row['enclosureid']);
            $current->setEnclosurename($row['enclosurename']);
            $current->setEnclosureheadquarterid($row['enclosureheadquarterid']);
            $current->setEnclosureuniversityid($row['enclosureuniversityid']);
            array_push($enclosures, $current);
        }//End foreach ($result as $row)
        return $enclosures;
    }

    function select(Enclosure $enclosure) {
        $query = $this->db->prepare("SELECT * FROM tbenclosure WHERE enclosureid = :enclosureid;");
        $query->execute(array("enclosureid" => $enclosure->getEnclosureid()));
        $result = $query->fetch();
        $enclosure->setEnclosurename($result['enclosurename']);
        $enclosure->setEnclosureheadquarterid($result['enclosureheadquarterid']);
        $enclosure->setEnclosureuniversityid($result['enclosureuniversityid']);
        return $enclosure;
    }

}
