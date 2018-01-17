<?php

class University {

    //Attributes
    private $universityid;
    private $universityname;
    private $universityType;
    private $universityhadheadquarter;

    function __construct() {
        ;
    }

    function __toString() {
        try {
            return (string) $this->universityid . ' | ' . $this->universitycode . ' | ' . $this->universityname . ' | ' . $this->universityType . ' | ' . $this->universityheadquarter;
        } catch (Exception $e) {
            return '';
        }
    }

    function getUniversityid() {
        return $this->universityid;
    }

    function getUniversityname() {
        return $this->universityname;
    }

    function getUniversityType() {
        return $this->universityType;
    }

    function setUniversityid($universityid) {
        $this->universityid = $universityid;
    }

    function setUniversityname($universityname) {
        $this->universityname = $universityname;
    }

    function setUniversityType($universityType) {
        $this->universityType = $universityType;
    }
    function getUniversityhadheadquarter() {
        return $this->universityhadheadquarter;
    }

    function setUniversityhadheadquarter($universityhadheadquarter) {
        $this->universityhadheadquarter = $universityhadheadquarter;
    }

}