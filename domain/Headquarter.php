<?php

class Headquarter {

    //Attributes
    private $headquarterid;
    private $headquartername;
    private $headquarteruniversityid;

    function __construct() {
        
    }

    function getHeadquarterid() {
        return $this->headquarterid;
    }

    function getHeadquartername() {
        return $this->headquartername;
    }

    function getHeadquarteruniversityid() {
        return $this->headquarteruniversityid;
    }

    function setHeadquarterid($headquarterid) {
        $this->headquarterid = $headquarterid;
    }

    function setHeadquartername($headquartername) {
        $this->headquartername = $headquartername;
    }

    function setHeadquarteruniversityid($headquarteruniversityid) {
        $this->headquarteruniversityid = $headquarteruniversityid;
    }

//End class Headquarter
}
