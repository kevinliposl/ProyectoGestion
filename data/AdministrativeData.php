<?php

class AdministrativeData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Administrative $administrative) {

        $queryLastId = $this->db->prepare("SELECT MAX(administrativeid) AS administrativeid  FROM tbadministrative");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['administrativeid'] != NULL) {
            $nextId = (int) $resultLastId['administrativeid'] + 1;
        }
        $query = $this->db->prepare(
                "INSERT INTO tbadministrative VALUES (" . $nextId . ",'" .
                $administrative->getAdministrativelicense() . "','" .
                $administrative->getAdministrativename() . "','" .
                $administrative->getAdministrativelastname1() . "','" .
                $administrative->getAdministrativelastname2() . "','" .
                $administrative->getAdministrativearea() . "','" .
                $administrative->getAdministrativepassword() . "'," .
                0 . ");"
        );
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        $queryInsertActor = $this->db->prepare("INSERT INTO tbactor VALUES (:actorid,:actormail);");
        $queryInsertActor->execute(array('actorid' => $nextId, 'actormail' => $administrative->getAdministrativemail()));
        $resultActor = $queryInsertActor->fetch();
        $queryInsertActor->closeCursor();

        if (!$result) {
            return 1;
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
