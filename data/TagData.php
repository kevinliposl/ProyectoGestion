<?php

class TagData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function insert(Tag $tag) {
        $queryExistsTag = $this->db->prepare("SELECT tagword FROM tbtag WHERE tagactivityid=:activityid AND tagword=:word;");
        $queryExistsTag->execute(array('tagactivityid' => $tag->gettagactivityid(), 'word' => $tag->gettagword()));
        $resultTag = $queryExistsTag->fetch();
        $queryExistsTag->closeCursor();

        if ($resultTag['tagword'] == NULL) {
            $queryInsertTag = $this->db->prepare("INSERT INTO tbtag VALUES (:idactivity,:word);");
            $queryInsertTag->execute(array('idactivity' => $tag->getTagactivityid(), 'word' => $tag->getActivitytag()));
            $queryInsertTag->fetch();
            $queryInsertTag->closeCursor();
        } else {
            return 0;
        }
    }

}
