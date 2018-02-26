<?php

class Search {

    private $typeActivity;
    private $searchGeneral;
    private $searchDate;
    private $searchHour;
    private $searchPlace;
    private $searchActor;

    function getSearchHour() {
        return $this->searchHour;
    }

    function setSearchHour($searchHour) {
        $this->searchHour = $searchHour;
    }

    function getTypeActivity() {
        return $this->typeActivity;
    }

    function getSearchGeneral() {
        return $this->searchGeneral;
    }

    function getSearchDate() {
        return $this->searchDate;
    }

    function getSearchActor() {
        return $this->searchActor;
    }

    function setTypeActivity($typeActivity) {
        $this->typeActivity = $typeActivity;
    }

    function setSearchGeneral($searchGeneral) {
        $this->searchGeneral = $searchGeneral;
    }

    function setSearchDate($searchDate) {
        $this->searchDate = $searchDate;
    }

    function getSearchPlace() {
        return $this->searchPlace;
    }

    function setSearchPlace($searchPlace) {
        $this->searchPlace = $searchPlace;
    }

    function setSearchActor($searchActor) {
        $this->searchActor = $searchActor;
    }

}
