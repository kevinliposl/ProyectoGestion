<?php

class AdministrativeData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Administrative $administrative) {    

        $queryChecking = $this->db->prepare("SELECT actorid FROM tbactor WHERE actormail=:actormail;");
        $queryChecking->execute(array('actormail' => $administrative->getAdministrativemail()));
        $resultChecking = $queryChecking->fetch();
        $queryChecking->closeCursor();
        
        if (!isset($resultChecking['actorid'])) {
            $lastid = $this->getlastid();
            $queryAdministrative = $this->db->prepare("INSERT INTO tbadministrative VALUES (:administrativeid,:administrativelicense,:administrativename,:administrativelastname1,:administrativelastname2,:administrativepassword,:administrativearea);");
            $queryAdministrative ->execute(array('administrativeid' => $lastid, 'administrativelicense' => $administrative->getAdministrativelicense(), 'administrativename' => $administrative->getAdministrativename(),
                'administrativelastname1' => $administrative->getAdministrativelastname1(), 'administrativelastname2' => $administrative->getAdministrativelastname2(), 'administrativepassword' => $administrative->getAdministrativepassword(),
                'administrativearea' => $administrative->getAdministrativearea()));
            $queryAdministrative ->fetch();
            $queryAdministrative ->closeCursor();

            $queryActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
            $queryActor->execute(array('actorid' => $lastid, 'actormail' => $administrative->getAdministrativemail()));
            $queryActor->fetch();
            $queryActor->closeCursor();

            $queryVerifyResult = $this->db->prepare('SELECT adm.administrativename FROM tbadministrative adm INNER JOIN tbactor a ON a.actorid = adm.administrativeid WHERE adm.administrativeid=:administrativeid;');
            $queryVerifyResult->execute(array('administrativeid' => $lastid));
            $result = $queryVerifyResult->fetch();
            $queryVerifyResult->closeCursor();

            if (isset($result['administrativename'])) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    function update(Administrative $administrative) {
        $query = $this->db->prepare("UPDATE tbadministrative "
                . "SET administrativeid =" . $administrative->getAdministrativeid() .
                ", administrativelicense='" . $administrative->getAdministrativelicense() .
                "', administrativename='" . $administrative->getAdministrativename() .
                "', administrativelastname1='" . $administrative->getAdministrativelastname1() .
                "', administrativelastname2='" . $administrative->getAdministrativelastname2() .
                "', administrativepassword='" . $administrative->getAdministrativepassword() .
                "', administrativearea='" . $administrative->getAdministrativearea() .
                "' WHERE administrativeid=" . $administrative->getAdministrativeid() . ";");
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
        $query = $this->db->prepare("SELECT ac.actormail,ad.* from tbadministrative ad INNER JOIN tbactor ac ON ac.actorid= ad.administrativeid WHERE administrativestate=:state;");
        $query->execute(array('state' => 1));
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        $administratives = [];

        foreach ($result as $row) {
            $currentAdministrative = new Administrative();
            $currentAdministrative->setAdministrativemail($row['actormail']);
            $currentAdministrative->setAdministrativeid($row['administrativeid']);
            $currentAdministrative->setAdministrativelicense($row['administrativelicense']);
            $currentAdministrative->setAdministrativename($row['administrativename']);
            $currentAdministrative->setAdministrativelastname1($row['administrativelastname1']);
            $currentAdministrative->setAdministrativelastname2($row['administrativelastname2']);
            $currentAdministrative->setAdministrativearea($row['administrativearea']);
            $currentAdministrative->setAdministrativepassword($row['administrativepassword']);
            array_push($administratives, $currentAdministrative);
        }

        return $administratives;
    }

    function select($idAdministrative) {
        $query = $this->db->prepare("SELECT * FROM tbadministrative WHERE administrativeid=" . $idAdministrative . ";");
        $query->execute();
        $result = $query->fetch();

        $administrative = new Administrative();
        $administrative->setAdministrativeid($result['administrativeid']);
        $administrative->setAdministrativelicense($result['administrativelicense']);
        $administrative->setAdministrativename($result['administrativename']);
        $administrative->setAdministrativelastname1($result['administrativelastname1']);
        $administrative->setAdministrativelastname2($result['administrativelastname2']);
        $administrative->setAdministrativearea($result['administrativearea']);
        $administrative->setAdministrativepassword($result['administrativepassword']);

        return $administrative;
    }

    function delete(Administrative $administrative) {
        $query = $this->db->prepare("UPDATE tbadministrative SET administrativestate=:state WHERE administrativeid=:id;");
        $query->execute(array('state' => 0, 'id' => $administrative->getAdministrativeid()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }
    }

}
