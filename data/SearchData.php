<?php

class SearchData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function startSearch(Search $search) {
        $tmp = $this->createQuery($search);
        $query = $this->db->prepare($tmp);
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    private function createQuery(Search $search) {
        $query = "SELECT DISTINCT activityid, a.* FROM tbactivity a";
        if ($search->setTypeActivity() != NULL) {
            $query .= 'INNER JOIN tbtag ON a.activityid = tbtag.tagactivityid INNER JOIN tb' . $search->getTypeActivity() . ' ON a.id=tb' . $search->getTypeActivity() . '.id ';
        } elseif ($search->getSearchDate() != NULL) {
            $query .= ' createddate=' . $search->getSearchDate() . ' || updatedate=' . $search->getSearchDate() . ' ';
        } elseif ($search->getSearchGeneral() != NULL) {
            $query .= ' WHERE ';
            foreach ($search->getSearchGeneral() as $var) {
                $query .= ' tagword =' . $var;
                if (next($search->getSearchGeneral()) != NULL) {
                    $query .= ' AND ';
                }
            }
        } else {
            $query .= ';';
        }
    }

}
