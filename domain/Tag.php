<?php

class Tag{

private $tagactivityid;
private $activitytag;

function __construct() {
    ;
}
function getTagactivityid() {
    return $this->tagactivityid;
}//End getTagactivityid

function getActivitytag() {
    return $this->activitytag;
}//End getActivitytag

function setTagactivityid($tagactivityid) {
    $this->tagactivityid = $tagactivityid;
}//End setTagactivity

function setActivitytag($activitytag) {
    $this->activitytag = $activitytag;
}//End setActivitytag

}


