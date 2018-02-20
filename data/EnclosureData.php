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
        $query = $this->db->prepare("INSERT INTO tbenclosure VALUES(:enclosureid,:enclosurename,:enclosureheadquarterid,:enclosureuniversityid,:enclosurestate);");
        $query->execute(array("enclosureid" => $nextId, "enclosureheadquarterid" => 0, "enclosureuniversityid" => $enclosure->getEnclosureuniversityid(),
            "enclosurename" => $enclosure->getEnclosurename(), "enclosurestate" => 1));
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
        $query = $this->db->prepare("INSERT INTO tbenclosure VALUES(:enclosureid,:enclosurename,:enclosureheadquarterid,:enclosureuniversityid,:enclosurestate);");
        $query->execute(array("enclosureid" => $nextId, "enclosureheadquarterid" => $enclosure->getEnclosureheadquarterid(),
            "enclosureuniversityid" => $enclosure->getEnclosureuniversityid(), "enclosurename" => $enclosure->getEnclosurename(), "enclosurestate" => 1));
        $result = $query->fetch();
        $query->closeCursor();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(Enclosure $enclosure) {
        $query = $this->db->prepare("UPDATE tbenclosure SET enclosurename = :enclosurename WHERE enclosureid = :enclosureid AND enclosurestate = 1;");
        $query->execute(array("enclosureid" => $enclosure->getEnclosureid(), "enclosurename" => $enclosure->getEnclosurename()));
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

    function delete(Enclosure $enclosure) {
        $query = $this->db->prepare("UPDATE tbenclosure SET enclosurestate = 0 WHERE enclosureid = :enclosureid;");
        $query->execute(array("enclosureid" => $enclosure->getEnclosureid()));
        $result = $query->fetch();
        $query->closeCursor();
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }
    
    function selectEnclosurexHeadquarter(){
        $enclosures = $this->selectEnclosureByUniversity();
        $headquarters = $this->selectHeadquarterByUniversity();
        $allPlaces=array(); 
        
        foreach($enclosures as $enclosure){
            if($enclosure['enclosureheadquarterid'] > 0){
                foreach($headquarters as $headquarter){
                    if($enclosure['enclosureheadquarterid'] == $headquarter['headquarterid']){
                        $union= ['universityid'=>$enclosure['universityid'], 'universityname'=>$enclosure['universityname'], 'enclosureid'=>$enclosure['enclosureid'], 'enclosurename'=>$enclosure['enclosurename'], 'headquarterid'=>$headquarter['headquarterid'], 'headquartername'=>$headquarter['headquartername']];
                        array_push($allPlaces, $union);
                    }
                }
            }else{
                 $union= ['universityid'=>$enclosure['universityid'], 'universityname'=>$enclosure['universityname'], 'enclosureid'=>$enclosure['enclosureid'], 'enclosurename'=>$enclosure['enclosurename'], 'headquarterid'=>0, 'headquartername'=>'Sin Sede'];
                        array_push($allPlaces, $union);
            }
        }
        print_r($allPlaces);
        
        return $allPlaces;
        
    }
    
    //recinto
    function selectEnclosureByUniversity() {
        $queryCareer = $this->db->prepare("SELECT u.universityname, u.universityid, e.enclosurename, e.enclosureid from tbuniversity as u inner join tbenclosure as e on u.universityid = e.enclosureuniversityid order by(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();

        return $result;
    }
    
    //sede
    function selectHeadquarterByUniversity() {
        $queryCareer = $this->db->prepare("SELECT u.universityname, u.universityid, h.headquartername, h.headquarterid from tbuniversity as u inner join tbheadquarter as h on u.universityid = h.headquarteruniversityid order by(u.universityid);");
        $queryCareer->execute();
        $result = $queryCareer->fetchAll();
        $queryCareer->closeCursor();

        return $result;
    }

    
    function selectAll() {
        $query = $this->db->prepare("SELECT e.*,u.* FROM tbenclosure e INNER JOIN tbuniversity u ON u.universityid = e.enclosureuniversityid WHERE enclosurestate = 1;");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
//        $enclosures = [];
//        foreach ($result as $row) {
//            $current = new Enclosure();
//            $current->setEnclosureid($row['enclosureid']);
//            $current->setEnclosurename($row['enclosurename']);
//            $current->setEnclosureheadquarterid($row['enclosureheadquarterid']);
//            $current->setEnclosureuniversityid($row['enclosureuniversityid']);
//            array_push($enclosures, $current);
//        }//End foreach ($result as $row)
//        return $enclosures;
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
