<?php

require '../domain/Event.php';
require '../domain/Tag.php';
require '../domain/Activity.php';
require '../business/ActivityBusiness.php';
require '../business/TagBusiness.php';
require '../util/TagReference.php';
require '../util/TranslateEToS.php';
require '../util/TranslateSToE.php';

if (isset($_POST['create'])) {
    if (isset($_POST['hourAfter']) && isset($_POST['hourBefore']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['place']) && isset($_POST['dateEvent']) && isset($_POST['hourEvent'])) {
        if (strlen($_POST['hourBefore']) > 0 && strlen($_POST['hourAfter']) > 0 && strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0 && strlen($_POST['place']) > 0 && strlen($_POST['dateEvent']) > 0 && strlen($_POST['hourEvent']) > 0) {

            $eventBusiness = new EventBusiness();
            $event = new Event();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $tagReference = new TagReference();
            $translateSToE = new TranslateSToE();
            $translateEToS = new TranslateEToS();
            
            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setCreateDate(date("Y-m-d"));
            $activity->setUpdateDate(date("Y-m-d"));
            $activity->setLikeCount(0);
            $activity->setDayAfther($_POST['hourAfter']);
            $activity->setDayBefore($_POST['hourBefore']);
            $activity->setCommentCoun(0);

            $resulta = $activityBusiness->insert($activity);
            $activityID = $activityBusiness->getActivity();

            //////
            //separar las palabras del titulo y la descripcion 
            $entireWord = strtolower($_POST['title'] . " " . $_POST['description']);
            $allWords = explode(" ", $entireWord);
            $words = array();

            foreach ($allWords as $word) {
                if (strlen($word) >= 4) {
                    $tag = new Tag();
                    $tag->setTagactivityid($activityID->getActivityId());
                    $tag->setTagword($word);
                    array_push($words, $tag);
                }
            }

            //retorna los sinonimos de las palabra
            $allsynonymous = $tagReference->sendGetSynonymous($words);
            $synonymous = array();

            //relaciona los sinonimos con la actividad
            foreach ($allsynonymous as $synonym) {
                $tag = new Tag();
                $tag->setTagactivityid($activityID->getActivityId());
                $tag->setTagword($synonym);
                array_push($synonymous, $tag);
            }
            //retorna los conceptos de las palabras
            $entireConceptsWords = $tagReference->sendGetConcepts($words);
            $uniteConcepts='';
             
             foreach($entireConceptsWords as $divConcepts){
                 if($uniteConcepts==''){
                     $uniteConcepts = $divConcepts;
                 }else{
                    $uniteConcepts = $uniteConcepts.'- '.$divConcepts." "; 
                 }
                 
             }
            
            //separar y limpiar los conceptos en palabras
            $allConcepts = str_replace(',',' ',explode(" ", $uniteConcepts));
            $allConcepts = str_replace('.',' ',$allConcepts);
            $allConcepts = str_replace('-',' ',$allConcepts);
            $allConcepts = str_replace(':',' ',$allConcepts);
          
            $concepts=array();

            foreach($allConcepts as $concept){
                if(strlen($concept) >= 4){
                    //relacionar los conceptos con la actividad
                    $tag = new Tag();
                    $tag->setTagactivityid($activityID->getActivityId());
                    $tag->setTagword($concept);
                    array_push($concepts, $tag);
                }
            }
             
            //arreglo con: palabras, sus sinonimos y sus conceptos
            $entireArray = array_merge($words, $synonymous, $concepts);
            ////
            
            //inserta todo el arreglo con posibles palabras relacionadas
            $tagBusiness->insert($entireArray);

            $event->setActivityId($activityID->getActivityId());
            $event->setEventPLace($_POST['place']);
            $event->setEventDate($_POST['dateEvent']);
            $event->setEventHour($_POST['hourEvent']);

            $result = $eventBusiness->insert($activityID, $event);

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

    if (isset($_POST['hourAfter']) && isset($_POST['hourBefore']) && isset($_POST['eventid']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['place']) && isset($_POST['dateEvent']) && isset($_POST['hourEvent'])) {
        if (strlen($_POST['hourBefore']) > 0 && strlen($_POST['hourAfter']) > 0 && strlen($_POST['eventid']) > 0 && strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0 && strlen($_POST['place']) > 0 && strlen($_POST['dateEvent']) > 0 && strlen($_POST['hourEvent']) > 0) {

            $eventBusiness = new EventBusiness();
            $event = new Event();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();


            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setActivityId($_POST['eventid']);
             $activity->setDayAfther($_POST['hourAfter']);
            $activity->setDayBefore($_POST['hourBefore']);

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
    }

//End construct

    function insert(Activity $activ, Event $event) {
        return $this->data->insert($activ, $event);
    }

//End insert

    function delete(Event $event) {
        return $this->data->delete($event);
    }

//End delete

    function update(Event $event) {
        return $this->data->update($event);
    }

//End update

    function selectAll() {
        return $this->data->selectAll();
    }

//End selectAll

    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }

//End selectAllTotal
}

//End class EventBusiness
