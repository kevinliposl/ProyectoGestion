<?php

class Publication {
    
    //Attributes
    private $activityId;
    private $publicationState;

    function __construct() {
        
    }//End construct
    
    function getActivityId(){
        return $this->activityId;
    }//End getActivityId
    
    function setActivityId($activityId){
        $this->activityId = $activityId;
    }//End setActivityId
    
    function getPublicationSatete(){
        return $this->publicationState;
    }//End getPublicationTitle
    
    function setPublicationState($publicationState){
        $this->publicationState = $publicationState;
    }//End setPublicationTitle
    
 
 
    
}//End class Publication


