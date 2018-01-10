<?php

class Student {

    private $id;
    private $name;
    private $lastname1;
    private $lastname2;
    private $career1;
    private $career2;
    private $headquarters;
    private $password;

    function __construct($id, $name, $lastname1, $lastname2, $career1, $career2, $headquarters, $password) {
        $this->id = $id;
        $this->name = $name;
        $this->lastname1 = $lastname1;
        $this->lastname2 = $lastname2;
        $this->career1 = $career1;
        $this->career2 = $career2;
        $this->headquarters = $headquarters;
        $this->password = $password;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getLastname1() {
        return $this->lastname1;
    }

    function getLastname2() {
        return $this->lastname2;
    }

    function getCareer1() {
        return $this->career1;
    }

    function getCareer2() {
        return $this->career2;
    }

    function getHeadquarters() {
        return $this->headquarters;
    }

    function getPassword() {
        return $this->password;
    }

    function setId($id) {
        $this->id = $id;
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

    function setHeadquarters($headquarters) {
        $this->headquarters = $headquarters;
    }

    function setPassword($password) {
        $this->password = $password;
    }
    
    function __toString() {
        try {
            return (string) $this->id . '|' . $this->name . '|' . $this->lastname1;
        } catch (Exception $e) {
            return '';
        }
    }

}
