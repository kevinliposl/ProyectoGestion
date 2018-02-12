<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert($words=array()) {
      
        foreach ($words as $word) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word);");
            $queryInsertTag->execute(array('idactivity' => $word->getActivityId(), 'word' => $word->getActivitytag()));
            $queryInsertTag->fetch();
            $queryInsertTag->closeCursor();
        }
            
      
    }

}
