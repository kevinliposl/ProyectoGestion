<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(array $words) {
        foreach ($words as $word) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word);");

            $queryInsertTag->execute(array('idactivity' => $word->getTagactivityid(), 'word' => $word->getTagword()));
            $queryInsertTag->fetch();
            $queryInsertTag->closeCursor();
        }
    }
    
    function selectActivity($activityId){
        $query = $this->db->prepare("SELECT * FROM tbtag WHERE tagactivityid=".$activityId.";");
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

}
