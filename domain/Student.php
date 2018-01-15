<?php

class Student {

    private $id;
    private $license;
    private $name;
    private $lastname1;
    private $lastname2;
    private $career1;
    private $career2;
    private $password;

    function __construct() {
        ;
    }

    function getLicense() {
        return $this->license;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getLastName1() {
        return $this->lastname1;
    }

    function getLastName2() {
        return $this->lastname2;
    }

    function getCareer1() {
        return $this->career1;
    }

    function getCareer2() {
        return $this->career2;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLicense($license) {
        $this->license = $license;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setLastname1($lastname1) {
        $this->lastname1 = $lastname1;
    }

    function setLastname2($lastname2) {
        $this->lastname2 = $lastname2;
    }

    function setCareer1($career1) {
        $this->career1 = $career1;
    }

    function setCareer2($career2) {
        $this->career2 = $career2;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function __toString() {
        try {
            return (string) $this->id . ' | ' . $this->name . ' | ' . $this->lastname1 . ' | ' . $this->lastname2 . ' | ' . $this->career1;
        } catch (Exception $e) {
            return '';
        }
    }

}
