<?php

class Career {

    //Attributes
    private $careerid;
    private $careercode;
    private $careername;
    private $careergrade;
    private $careerenclosureid;

    function __construct() {
        ;
    }

    function getCareerid() {
        return $this->careerid;
    }

    function getCareercode() {
        return $this->careercode;
    }

    function getCareername() {
        return $this->careername;
    }

    function getCareergrade() {
        return $this->careergrade;
    }

    function getCareerenclosureid() {
        return $this->careerenclosureid;
    }

    function setCareerid($careerid) {
        $this->careerid = $careerid;
    }

    function setCareercode($careercode) {
        $this->careercode = $careercode;
    }

    function setCareername($careername) {
        $this->careername = $careername;
    }

    function setCareergrade($careergrade) {
        $this->careergrade = $careergrade;
    }

    function setCareerenclosureid($careerenclosureid) {
        $this->careerenclosureid = $careerenclosureid;
    }

//End class Career
}
