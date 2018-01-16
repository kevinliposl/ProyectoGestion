<?php


class Career {
    
    //Attributes
    private $careerid;
    private $careercode;
    private $careername;
    private $careerUniversity;

    function __construct() {
        ;
    }//End construct()
    
    function __toString() {
        try {
            return (string) $this->careerid . ' | ' . $this->careercode . ' | ' . $this->careername;
        } catch (Exception $e) {
            return '';
        }//End try-catch (Exception $e)
    }//End toString()
    
    function getCareerUniversity() {
        return $this->careerUniversity;
    }

    function setCareerUniversity($careerUniversity) {
        $this->careerUniversity = $careerUniversity;
    }
    
    function setCareerid($careerid) {
        $this->careerid = $careerid;
    }//End setCareerid()
    
     function setCareercode($careercode) {
        $this->careercode = $careercode;
    }//End setCareercode()
    
    function setCareername($careername) {
        $this->careername = $careername;
    }//End setCareername()
    
    function getCareerid() {
        return $this->careerid;
    }//End getCareerid()    
    
    function getCareercode(){
        return $this->careercode;
    }//End getCareercode()
    
    function getCareername(){
        return $this->careername;
    }//End getCareername()
    
}//End class Career
