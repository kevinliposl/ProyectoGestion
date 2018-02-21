<?php

class SearchData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function select(Search $search) {
        $tmp = $this->createQuery($search);
        return $tmp;
        $query = $this->db->prepare($tmp);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    private function createQuery(Search $search) {
        $query = "SELECT DISTINCT a.activityid, a.* FROM tbactivity a ";
        if ($search->getTypeActivity() != NULL) {
            $query .= 'INNER JOIN tbtag t ON a.activityid = t.tagactivityid INNER JOIN tb' . $search->getTypeActivity() . ' ON a.id=tb' . $search->getTypeActivity() . '.id ';
        }
        if ($search->getSearchDate() != NULL) {
            $query .= 'WHERE a.createddate=' . $search->getSearchDate() . ' OR a.updatedate=' . $search->getSearchDate() . ' ';
        }
        if ($search->getSearchGeneral() != NULL) {
            $query .= strpos($query, 'WHERE') !== NULL ? '' : 'WHERE';
            foreach ($search->getSearchGeneral() as $var) {
                $query .= ' OR t.tagword="' . $var . '"';
            }
        }
        $query .= ';';
        return $query;
    }

}
