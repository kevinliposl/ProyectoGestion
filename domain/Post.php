<?php

class Post {

    //Attributes
    private $activityId;
    private $postState;

    function __construct() {
        
    }

//End construct

    function getActivityId() {
        return $this->activityId;
    }

//End getActivityId

    function setActivityId($activityId) {
        $this->activityId = $activityId;
    }

//End setActivityId

    function getPostState() {
        return $this->postState;
    }

    function setPostState($postState) {
        $this->postState = $postState;
    }

}

//End class Event


