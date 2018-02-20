<?php

class CareerData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Career $career) {
        $queryLastId = $this->db->prepare("SELECT MAX(careerid) AS careerid  FROM tbcareer");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['careerid'] != NULL) {
            $nextId = (int) $resultLastId['careerid'] + 1;
        }

        $query = $this->db->prepare("INSERT INTO tbcareer VALUES(:careerid,:careercode,:careername,:careergrade,:careerenclosureid,:careerstate);");
        $query->execute(array('careerid' => $nextId, 'careercode' => (int) $career->getCareercode(), 'careername' => $career->getCareername(), 'careergrade' => $career->getCareergrade(),
            'careerenclosureid' => $career->getCareerenclosureid(), 'careerstate' => 1));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Career $career) {
        $query = $this->db->prepare("UPDATE tbcareer SET careercode=:careercode,careername=:careername,careergrade=:careergrade WHERE careerid=:careerid;");
        $query->execute(array('careerid' => $career->getCareerid(), 'careergrade' => $career->getCareergrade(), 'careername' => $career->getCareername(),
            'careercode' => $career->getCareercode()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function selectAll() {
        $query = $this->db->prepare("SELECT * FROM tbcareer WHERE careerstate = 1;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $careers = [];
        foreach ($result as $row) {
            $currentCareer = new Career();
            $currentCareer->setCareerid($row['careerid']);
            $currentCareer->setCareercode($row['careercode']);
            $currentCareer->setCareername($row['careername']);
            $currentCareer->setCareerenclosureid($row['careerenclosureid']);
            $currentCareer->setCareergrade($row['careergrade']);
            array_push($careers, $currentCareer);
        }//End foreach ($result as $row)

        return $careers;
    }

    function selectAllNames() {
        $query = $this->db->prepare("SELECT careername FROM tbcareer WHERE careerstate = 1;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        return $result;
    }

    function selectByUniversity() {
        $queryCareer = $this->db->prepare("SELECT u.*, h.*, e.*, c.* from tbuniversity as u inner join tbheadquarter as h on u.universityid = h.headquarteruniversityid inner join tbenclosure as e on h.headquarterid = e.enclosureheadquarterid inner join tbcareer as c on e.enclosureid = c.careerenclosureid AND c.careerstate = 1 order by(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();

        return $result;
    }

    function selectByEnclosure() {
        $queryCareer = $this->db->prepare("SELECT u.*, e.*,c.* FROM tbuniversity u INNER JOIN tbenclosure e ON u.universityid = e.enclosureuniversityid INNER JOIN tbcareer as c ON e.enclosureid = c.careerenclosureid WHERE c.careerstate = 1 AND u.universityhadheadquarter=0
ORDER By(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();

        return $result;
    }

    function select(Career $career) {
        $query = $this->db->prepare("SELECT * FROM tbcareer WHERE careercode=:careerid AND careerstate = 1;");
        $query->execute(array('careerid' => $career->getCareerid()));
        $result = $query->fetch();
        $career->setCareercode($result['careercode']);
        $career->setCareername($result['careername']);
        $career->setCareerenclosureid($result['careerenclosureid']);
        $career->setCareergrade($result['careergrade']);
        return $career;
    }

    function delete(Career $career) {
        $query = $this->db->prepare("UPDATE tbcareer SET careerstate = :careerstate WHERE careerid= :careerid;");
        $query->execute(array("careerid" => $career->getCareerid(), 'careerstate' => 0));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
