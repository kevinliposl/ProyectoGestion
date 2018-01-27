<?php

class Student {

    private $studentid;
    private $studentmail;
    private $studentlicense;
    private $studentname;
    private $studentlastname1;
    private $studentlastname2;
    private $studentcareer1;
    private $studentcareer2;
    private $studentpassword;

    function __construct() {
        ;
    }

    function getStudentid() {
        return $this->studentid;
    }

    function getStudentmail() {
        return $this->studentmail;
    }

    function getStudentlicense() {
        return $this->studentlicense;
    }

    function getStudentname() {
        return $this->studentname;
    }

    function getStudentlastname1() {
        return $this->studentlastname1;
    }

    function getStudentlastname2() {
        return $this->studentlastname2;
    }

    function getStudentcareer1() {
        return $this->studentcareer1;
    }

    function getStudentcareer2() {
        return $this->studentcareer2;
    }

    function getStudentpassword() {
        return $this->studentpassword;
    }

    function setStudentid($studentid) {
        $this->studentid = $studentid;
    }

    function setStudentmail($studentmail) {
        $this->studentmail = $studentmail;
    }

    function setStudentlicense($studentlicense) {
        $this->studentlicense = $studentlicense;
    }

    function setStudentname($studentname) {
        $this->studentname = $studentname;
    }

    function setStudentlastname1($studentlastname1) {
        $this->studentlastname1 = $studentlastname1;
    }

    function setStudentlastname2($studentlastname2) {
        $this->studentlastname2 = $studentlastname2;
    }

    function setStudentcareer1($studentcareer1) {
        $this->studentcareer1 = $studentcareer1;
    }

    function setStudentcareer2($studentcareer2) {
        $this->studentcareer2 = $studentcareer2;
    }

    function setStudentpassword($studentpassword) {
        $this->studentpassword = $studentpassword;
    }

}
