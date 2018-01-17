<?php

class University {
    
    //Attributes
    private $universityid;
    private $universitycode;
    private $universityname;
    private $universityType;
    private $universityheadquarter;
    
    function __construct() {
        ;
    }//End construct()
    
    function __toString() {
        try {
            return (string) $this->universityid . ' | ' . $this->universitycode . ' | ' . $this->universityname . ' | ' . $this->universityType.' | ' . $this->universityheadquarter;
        } catch (Exception $e) {
            return '';
        }//End try-catch (Exception $e)
    }//End toString()
    
    function setUniversityid($universityid) {
        $this->universityid = $universityid;
    }//End setUniversityid()
    
     function setUniversitycode($universitycode) {
        $this->universitycode = $universitycode;
    }//End setUniversitycode()
    
    function setUniversityname($universityname) {
        $this->universityname = $universityname;
    }//End setUniversityname()
    
    function setUniversityType($universityType) {
        $this->universityType = $universityType;
    }//End setUniversityType()
    
    function setUniversityHeadquarter($universityheadquarter) {
        $this->universityheadquarter = $universityheadquarter;
    }//End setUniversityHeadquarter()
    
    function getUniversityid() {
        return $this->universityid;
    }//End getUniversityid()    
    
    function getUniversityCode(){
        return $this->universitycode;
    }//End getUniversityCode()
    
    function getUniversityName(){
        return $this->universityname;
    }//End getUniversityName()
    
    function getUniversityType(){
        return $this->universityType;
    }//End getUNiversityType()
    
    function getUniversityHeadquarter(){
        return $this->universityheadquarter;
    }//End getUniversityHeadquarter()
    
}//End class University