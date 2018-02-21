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
//$query = $this->db->prepare($tmp);
        //$query->execute();
        //$result = $query->fetch();
        //$query->closeCursor();
        //return $result;
    }

    private function createQuery(Search $search) {
        $query = "SELECT DISTINCT activityid, a.* FROM tbactivity a ";
        if ($search->getTypeActivity() != NULL) {
            $query .= 'INNER JOIN tbtag t ON a.activityid = t.tagactivityid INNER JOIN tb' . $search->getTypeActivity() . ' ON a.id=tb' . $search->getTypeActivity() . '.id ';
        //} elseif (!is_null($search->getSearchDate())) {
            $query .= 'WHERE a.createddate=' . $search->getSearchDate() . ' || a.updatedate=' . $search->getSearchDate() . ' ';
            //} elseif ($search->getSearchGeneral() != NULL) {
            //foreach ($search->getSearchGeneral() as $var) {
            //    $query .= ' tagword =' . $var;
            //   if (next($search->getSearchGeneral()) != NULL) {
            //        $query .= ' AND ';
            //    }
            //}
        }
        $query .= ';';
        return $query;
    }

}
