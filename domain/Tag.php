<?php

class Tag {

    private $tagactivityid;
    private $tagword;
    private $tagRelation;

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

    function getTagRelation() {
        return $this->tagRelation;
    }

    function setTagRelation($tagRelation) {
        $this->tagRelation = $tagRelation;
    }



//End setActivitytag
}
