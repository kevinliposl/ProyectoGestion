<?php

require '../domain/Event.php';
require '../domain/Tag.php';
require '../business/ActivityBusiness.php';
require '../business/TagBusiness.php';
require '../util/TagSynonymous.php';

if (isset($_POST['create'])) {
    if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['place']) && isset($_POST['dateEvent']) && isset($_POST['hourEvent'])) {
        if (strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0 && strlen($_POST['place']) > 0 && strlen($_POST['dateEvent']) > 0 && strlen($_POST['hourEvent']) > 0) {

            $eventBusiness = new EventBusiness();
            $event = new Event();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $tag = new Tag();
            $tagSynonymous = new TagSynonymous();
            
            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setCreateDate(date("Y-m-d"));
            $activity->setUpdateDate(date("Y-m-d"));
            $activity->setLikeCount(0);
            $activity->setCommentCoun(0);
            
            $resulta = $activityBusiness->insert($activity);
            $activityID = $activityBusiness->getActivity();
            
            //separar las palabras del titulo y la descripcion 
            $entireWord = strtolower($_POST['title']." ".$_POST['description']);
            $allWords = explode(" ", $entireWord);
            $words=array();
            
            foreach($allWords as $word){
                
                if(strlen($word) >= 4){    
                    $tag->setTagactivityid($activityID->getActivityId());
                    $tag->setTagword($word);
                    array_push($words, $tag);
                }
            }
            
            $synonymousWords = $tagSynonymous->sendGet($words);
            
  
            $event->setActivityId($activityID->getActivityId());
            $event->setEventPLace($_POST['place']);
            $event->setEventDate($_POST['dateEvent']);
            $event->setEventHour($_POST['hourEvent']);

            $result = $eventBusiness->insert($activityID,$event);

            if ($resulta == 1 and $result == 1) {
                header("location: ../view/AdministrativeEventView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeEventView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeEventView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeEventView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['eventid'])) {
        if (strlen($_POST['eventid']) > 0) {

            $eventBusiness = new EventBusiness();
            $event = new Event();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $event->setActivityId($_POST['eventid']);
            $result = $eventBusiness->delete($event);
            
            $activity->setActivityId($_POST['eventid']);
            $resulta = $activityBusiness->delete($activity);

            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativeEventView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeEventView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeEventView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeEventView.php?error=empty");
    }
} else if (isset($_POST['update'])) {

    if (isset($_POST['eventid']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['place']) && isset($_POST['dateEvent']) && isset($_POST['hourEvent'])) {
        if (strlen($_POST['eventid']) > 0 && strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0 && strlen($_POST['place']) > 0 && strlen($_POST['dateEvent']) > 0 && strlen($_POST['hourEvent']) > 0) {
            
            $eventBusiness = new EventBusiness();
            $event = new Event();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            
            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setActivityId($_POST['eventid']);
            
            $resulta = $activityBusiness->update($activity);
            
            $event->setActivityId($_POST['eventid']);
            $event->setEventPLace($_POST['place']);
            $event->setEventDate($_POST['dateEvent']);
            $event->setEventHour($_POST['hourEvent']);
            
            $result = $eventBusiness->update($event);
            
            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativeEventView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeEventView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeEventView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeEventView.php?error=empty");
    }
}

class EventBusiness {
    
    //Attributes
    private $data;

    function __construct() {
        include_once '../data/EventData.php';
        $this->data = new EventData();
    }//End construct

    function insert(Activity $activ,Event $event) {
        return $this->data->insert($activ,$event);
    }//End insert

    function delete(Event $event) {
        return $this->data->delete($event);
    }//End delete

    function update(Event $event) {
        return $this->data->update($event);
    }//End update

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll
    
    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }//End selectAllTotal
    
}//End class EventBusiness
