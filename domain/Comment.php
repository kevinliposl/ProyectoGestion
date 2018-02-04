<?php

class Comment {

    //Attributes
    private $commentId;
    private $activityId;
    private $commentDate;
    private $commentDescription;
    private $commentActor;

    function getCommentId() {
        return $this->commentId;
    }

    function getActivityId() {
        return $this->activityId;
    }

    function getCommentDate() {
        return $this->commentDate;
    }

    function getCommentDescription() {
        return $this->commentDescription;
    }

    function getCommentActor() {
        return $this->commentActor;
    }

    function setCommentId($commentId) {
        $this->commentId = $commentId;
    }

    function setActivityId($activityId) {
        $this->activityId = $activityId;
    }

    function setCommentDate($commentDate) {
        $this->commentDate = $commentDate;
    }

    function setCommentDescription($commentDescription) {
        $this->commentDescription = $commentDescription;
    }

    function setCommentActor($commentActor) {
        $this->commentActor = $commentActor;
    }

}

//End class Comment
