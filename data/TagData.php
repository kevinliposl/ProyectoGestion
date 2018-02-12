<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Tag $words = array()) {
        foreach ($words as $word) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word);");
            $queryInsertTag->execute(array('idactivity' => $word->getTagactivityid(), 'word' => $word->getTagword()));
            $queryInsertTag->fetch();
            $queryInsertTag->closeCursor();
        }
    }

}
