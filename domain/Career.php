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

//End construct()

    function __toString() {
        try {
            return (string) $this->careerid . ' | ' . $this->careercode . ' | ' . $this->careername.' | '. $this->careergrade.' | '.$this->careerenclosureid;
        } catch (Exception $e) {
            return '';
        }//End try-catch (Exception $e)
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

    function getCareerGrade() {
        return $this->careergrade;
    }
    function getEnclosureid() {
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

    function setCareerGrade($careerGrade) {
        $this->careergrade = $careerGrade;
    }
    
    function setCareerEnclosureid($careerEnclosureid) {
        $this->careerenclosureid = $careerEnclosureid;
    }
}

//End class Career
