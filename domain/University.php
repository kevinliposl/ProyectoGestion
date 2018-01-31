<?php

class University {

    //Attributes
    private $universityid;
    private $universityname;
    private $universitytype;
    private $universityhadheadquarter;

    function __construct() {
        ;
    }

    function getUniversityid() {
        return $this->universityid;
    }

    function getUniversityname() {
        return $this->universityname;
    }

    function getUniversitytype() {
        return $this->universitytype;
    }

    function getUniversityhadheadquarter() {
        return $this->universityhadheadquarter;
    }

    function setUniversityid($universityid) {
        $this->universityid = $universityid;
    }

    function setUniversityname($universityname) {
        $this->universityname = $universityname;
    }

    function setUniversitytype($universitytype) {
        $this->universitytype = $universitytype;
    }

    function setUniversityhadheadquarter($universityhadheadquarter) {
        $this->universityhadheadquarter = $universityhadheadquarter;
    }

}
