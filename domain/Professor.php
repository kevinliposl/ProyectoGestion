<?php

class Professor {

    private $professorid;
    private $professorlicense;
    private $professorname;
    private $professorlastname1;
    private $professorlastname2;
    private $professorstate;
    private $professorpassword;

    function __construct() {
        ;
    }

    function getProfessorlicense() {
        return $this->professorlicense;
    }
    
    function getProfessorstate() {
        return $this->professorstate;
    }

    function getProfessorid() {
        return $this->professorid;
    }

    function getProfessorname() {
        return $this->professorname;
    }

    function getProfessorlastname1() {
        return $this->professorlastname1;
    }

    function getProfessorlastname2() {
        return $this->professorlastname2;
    }

    function getProfessorpassword() {
        return $this->professorpassword;
    }

    function setProfessorid($id) {
        $this->professorid = $id;
    }

    function setProfessorlicense($license) {
        $this->professorlicense = $license;
    }
    
     function setProfessorstate($state) {
        $this->professorstate = $state;
    }

    function setProfessorname($name) {
        $this->professorname = $name;
    }

    function setProfessorlastname1($lastname1) {
        $this->professorlastname1 = $lastname1;
    }

    function setProfessorlastname2($lastname2) {
        $this->professorlastname2 = $lastname2;
    }

    function setProfessorpassword($password) {
        $this->professorpassword = $password;
    }

}
