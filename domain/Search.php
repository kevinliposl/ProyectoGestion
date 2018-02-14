<?php

class Search {

    private $typeActivity;
    private $searchGeneral;
    private $searchDate;
    private $searchPlays;
    private $searchActor;

    function getTypeActivity() {
        return $this->typeActivity;
    }

    function getSearchGeneral() {
        return $this->searchGeneral;
    }

    function getSearchDate() {
        return $this->searchDate;
    }

    function getSearchPlays() {
        return $this->searchPlays;
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

    function setSearchPlays($searchPlays) {
        $this->searchPlays = $searchPlays;
    }

    function setSearchActor($searchActor) {
        $this->searchActor = $searchActor;
    }

}
