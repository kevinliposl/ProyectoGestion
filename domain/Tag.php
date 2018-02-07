<?php

class Tag {

    private $tagactivityid;
    private $tagword;

    function __construct() {
        ;
    }

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

//End setActivitytag
}
