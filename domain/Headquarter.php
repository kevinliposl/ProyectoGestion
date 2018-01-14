<?php

class Headquarter {
 
    //Attributes
    private $headquarterid;
    private $headquartercode;
    private $headquartername;
    private $headquarterlocation;
    
    function __construct() {
        ;
    }//End construct()
    
    function __toString() {
        try {
            return (string) $this->headquarterid . ' | ' . $this->headquartercode . ' | ' . $this->headquartername . ' | ' . $this->headquarterlocation;
        } catch (Exception $e) {
            return '';
        }//End try-catch (Exception $e)
    }//End toString()
    
    function setHeadquarterid($headquarterid) {
        $this->headquarterid = $headquarterid;
    }//End setHeadquarterid()
    
     function setHeadquartercode($headquartercode) {
        $this->headquartercode = $headquartercode;
    }//End setHeadquartercode()
    
    function setHeadquartername($headquartername) {
        $this->headquartername = $headquartername;
    }//End setHeadquartername()
    
    function setHeadquarterlocation($headquarterlocation) {
        $this->headquarterlocation = $headquarterlocation;
    }//End setHeadquarterlocation()
    
    function getHeadquarterid() {
        return $this->headquarterid;
    }//End getHeadquarterid()    
    
    function getHeadquartercode(){
        return $this->headquartercode;
    }//End getHeadquartercode()
    
    function getHeadquartername(){
        return $this->headquartername;
    }//End getHeadquartername()
    
    function getHeadquarterlocation(){
        return $this->headquarterlocation;
    }//End getHeadquarterlocation()
    
}//End class Headquarter
