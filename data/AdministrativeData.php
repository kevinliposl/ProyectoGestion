<?php

class AdministrativeData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    private function getlastid() {
        $query = $this->db->prepare("SELECT MAX(actorid) AS id FROM tbactor");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        $id = 1;

        if ($result['id'] != NULL) {
            $id = (int) $result['id'] + 1;
        }
        return $id;
    }

    function insert(Administrative $administrative) {

        $queryChecking = $this->db->prepare("SELECT actorid FROM tbactor WHERE actormail=:actormail;");
        $queryChecking->execute(array('actormail' => $administrative->getAdministrativemail()));
        $resultChecking = $queryChecking->fetch();
        $queryChecking->closeCursor();

        if (!isset($resultChecking['actorid'])) {
            $lastid = $this->getlastid();
            $queryAdministrative = $this->db->prepare("INSERT INTO tbadministrative VALUES (:administrativeid,:administrativelicense,:administrativename,:administrativelastname1,:administrativelastname2, :administrativearea,:administrativepassword,:administrativestate);");
            $queryAdministrative->execute(array('administrativeid' => $lastid, 'administrativelicense' => $administrative->getAdministrativelicense(), 'administrativename' => $administrative->getAdministrativename(),
                'administrativelastname1' => $administrative->getAdministrativelastname1(), 'administrativelastname2' => $administrative->getAdministrativelastname2(), 'administrativepassword' => $administrative->getAdministrativepassword(),
                'administrativearea' => $administrative->getAdministrativearea(), 'administrativestate' => 1));
            $queryAdministrative->fetch();
            $queryAdministrative->closeCursor();

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
                . "SET administrativelicense =:license, administrativename =:name, administrativelastname1=:lastname1,"
                . "administrativelastname2 =:lastname2, administrativepassword =:password,administrativearea =:area WHERE administrativeid =:id;");
        $query->execute(array('license' => $administrative->getAdministrativelicense(), 'name' => $administrative->getAdministrativename(), 'lastname1' => $administrative->getAdministrativelastname1(),
            'lastname2' => $administrative->getAdministrativelastname2(), 'password' => $administrative->getAdministrativepassword(), 'area' => $administrative->getAdministrativearea(),
            'id' => $administrative->getAdministrativeid()));
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
        return $result;
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
