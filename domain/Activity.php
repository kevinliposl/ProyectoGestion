<?php

class Activity {
    
    //Attributes
    private $activityId;
    private $createDate;
    private $updateDate;
    private $likecount;
    private $commentCount;
    private $activityTitle;
    private $activityDescription;
    
    function __construct() {
        
    }//End construct
    
    function getActivityId(){
        return $this->activityId;
    }//End getActivityId
    
    function setActivityId($activityId){
        $this->activityId = $activityId;
    }//End setActivityId
    
    function getCreateDate(){
        return $this->createDate;
    }//End getCreateDate
    
    function setCreateDate($createDate){
        $this->createDate = $createDate;
    }//End SetCreateDate
    
    function getUpdateDate(){
        return $this->updateDate;
    }//End getUpdateDate
    
    function setUpdateDate($updateDate){
        $this->updateDate = $updateDate;
    }//End SetUpdateDate
    
    function getLikeCount(){
        return $this->likecount;
    }//End getLikeCount
    
    function setLikeCount($likecount){
        $this->likecount = $likecount;
    }//End SetLikeCount
    
    function getCommentCount(){
        return $this->commentCount;
    }//End getCommentCoun
    
    function setCommentCoun($commentCount){
        $this->commentCount = $commentCount;
    }//End SetCommentCoun
    
    function getActivityTitle(){
        return $this->activityTitle;
    }//End getActivityTitle
    
    function setActivityTitle($activityTitle){
        $this->activityTitle = $activityTitle;
    }//End SetActivityTitle
    
    function getActivityDescription(){
        return $this->activityDescription;
    }//End getActivityDescription
    
    function setActivityDescription($activityDescription){
        $this->activityDescription = $activityDescription;
    }//End SetActivityDescription
    
}//End class Activity