<?php

class Career {

    //Attributes
    private $careerid;
    private $careercode;
    private $careername;
    private $careerUniversity;

    function __construct() {
        ;
    }

//End construct()

    function __toString() {
        try {
            return (string) $this->careerid . ' | ' . $this->careercode . ' | ' . $this->careername;
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

    function getCareerUniversity() {
        return $this->careerUniversity;
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

    function setCareerUniversity($careerUniversity) {
        $this->careerUniversity = $careerUniversity;
    }
}

//End class Career
