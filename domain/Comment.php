<?php

class Comment {
    
    //Attributes
    private $commentId;
    private $activityId;
    private $commentDate;
    private $commentDescription;
    private $commentActor;
    
    function __construct() {
        
    }//End construct
    
    function getCommentId(){
        return $this->commentId;
    }//End getActivityId
    
    function setCommentId($commentId){
        $this->commentId = $commentId;
    }//End setActivityId

    function getActivityId(){
        return $this->activityId;
    }//End getActivityId
    
    function setActivityId($activityId){
        $this->activityId = $activityId;
    }//End setActivityId
    
    function getCommentDate(){
        return $this->commentDate;
    }//End getCreateDate
    
    function setCommentDate($commentDate){
        $this->commentDate = $commentDate;
    }//End SetCreateDate
    
    function getCommentDescription(){
        return $this->commentDescription;
    }//End getCommentDescription
    
    function setCommentDescription($commentDescription){
        $this->commentDescription = $commentDescription;
    }//End SetActivityDescription
    
    function getCommentActor(){
        return $this->commentActor;
    }//End getCommentctor
    
    function setCommentActor($commentActor){
        $this->activityType = $commentActor;
    }//End setCommentActor
    
}//End class Comment
