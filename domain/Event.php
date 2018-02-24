<?php

class Event {

    //Attributes
    private $activityId;
    private $eventPlace;
    private $eventDate;
    private $eventHour;
    private $daybefore;
    private $dayafther;

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

    function getEventPLace() {
        return $this->eventPlace;
    }

//End getEventPLace

    function setEventPLace($eventPlace) {
        $this->eventPlace = $eventPlace;
    }

//End setEventPLace

    function getEventDate() {
        return $this->eventDate;
    }

//End getEventDate

    function setEventDate($eventDate) {
        $this->eventDate = $eventDate;
    }

//End setEventDate

    function getEventHour() {
        return $this->eventHour;
    }

//End getEventHour

    function setEventHour($eventHour) {
        $this->eventHour = $eventHour;
    }

//End setEventHour

    function getDayAfther() {
        return $this->dayafther;
    }

//End getDayAfther

    function setDayAfther($dayafther) {
        $this->dayafther = $dayafther;
    }

//End SetDayAfther

    function getDayBefore() {
        return $this->daybefore;
    }

//End getDayBefore

    function setDayBefore($daybefore) {
        $this->daybefore = $daybefore;
    }

//End setDayBefore
}

//End class Event


