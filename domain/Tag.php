<?php

class Tag {

    private $tagactivityid;
    private $tagword;
    private $tagrelation;

    function getTagactivityid() {
        return $this->tagactivityid;
    }

//End getTagactivityid

    function getTagword() {
        return $this->tagword;
    }

//End getActivitytag

    function setTagactivityid($tagactivityid) {
        $this->tagactivityid = $tagactivityid;
    }

//End setTagactivity

    function setTagword($tagword) {
        $this->tagword = $tagword;
    }
    
    function getTagrelation() {
        return $this->tagrelation;
    }

    function setTagrelation($tagrelation) {
        $this->tagrelation = $tagrelation;
    }


//End setActivitytag
}
