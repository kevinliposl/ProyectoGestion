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

        $query = $this->db->prepare("INSERT INTO tbcareer VALUES(:id,:code,:name,'');");
        $query->execute(array('id' => $nextId, 'code' => $career->getCareercode(), 'name' => $career->getCareername()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Career $career) {
        $query = $this->db->prepare("UPDATE tbcareer "
                . "SET careercode=" . $career->getCareercode() .
                ", careername='" . $career->getCareername() .
                "' WHERE careercode=" . $career->getCareercode() . ";");
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
        $query = $this->db->prepare("SELECT * FROM tbcareer;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        $careers = [];
        foreach ($result as $row) {
            $currentCareer = new Career();
            $currentCareer->setCareerid($row['careerid']);
            $currentCareer->setCareercode($row['careercode']);
            $currentCareer->setCareername($row['careername']);
            array_push($careers, $currentCareer);
        }//End foreach ($result as $row)
        
      
        
        return $careers;
        
    }
    
     function selectByUniversity() {
          
         
        $queryCareer = $this->db->prepare("SELECT u.universityname, u.universityid, h.headquartername, h.headquarterid, e.enclosurename, e.enclosureid, c.careername, c.careerid from tbuniversity as u inner join tbheadquarter as h on u.universityid = h.headquarteruniversityid inner join tbenclosure as e on h.headquarterid = e.enclosureheadquarterid inner join tbcareer as c on e.enclosureid = c.careerenclosureid order by(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();
        
        return $result;
    }

    function select($careerCode) {
        $query = $this->db->prepare("SELECT * FROM tbcareer WHERE careercode=" . $careerCode . ";");
        $query->execute();
        $result = $query->fetch();
        $career = new Career();
        $career->setCareerid($result['careerid']);
        $career->setCareercode($result['careercode']);
        $career->setCareername($result['careername']);
        return $career;
    }

    ////// PONER SOLO ELIMINACIONES LOGICAS
    public function delete(Career $career) {
        $query = $this->db->prepare("DELETE FROM tbcareer WHERE careercode=" . $career->getCareercode() . ";");
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
