<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(array $words) {
        foreach ($words as $word) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word,:relation);");

            $queryInsertTag->execute(array('idactivity' => $word->getTagactivityid(), 'word' => $word->getTagword(), 'relation' => $word->getTagRelation()));
            $queryInsertTag->fetch();
            $queryInsertTag->closeCursor();
        }
    }

    function selectActivity($activityId) {
        $query = $this->db->prepare("SELECT * FROM tbtag WHERE tagactivityid=" . $activityId . " order by(tagrelation);");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }
    
    function selectActivitySize($activityId){
       $query = $this->db->prepare("SELECT DISTINCT tagrelation FROM tbtag WHERE tagactivityid=" . $activityId . ";");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result; 
    }

}
