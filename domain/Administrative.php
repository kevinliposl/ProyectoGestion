<?php

class Administrative {

    private $administrativeiid;
    private $administrativelicense;
    private $administrativename;
    private $administrativelastname1;
    private $administrativelastname2;
    private $administrativearea;
    private $administrativepassword;

    function __construct() {
        ;
    }

    function getAdministrativelicense() {
        return $this->administrativelicense;
    }

    function getAdministrativeid() {
        return $this->administrativeiid;
    }

    function getAdministrativename() {
        return $this->administrativename;
    }

    function getAdministrativelastname1() {
        return $this->administrativelastname1;
    }

    function getAdministrativelastname2() {
        return $this->administrativelastname2;
    }

    function getAdministrativepassword() {
        return $this->administrativepassword;
    }
    
    function getAdministrativearea() {
        return $this->administrativearea;
    }

    function setAdministrativeid($id) {
        $this->administrativeiid = $id;
    }

    function setAdministrativelicense($license) {
        $this->administrativelicense = $license;
    }

    function setAdministrativename($name) {
        $this->administrativename = $name;
    }

    function setAdministrativelastname1($lastname1) {
        $this->administrativelastname1 = $lastname1;
    }

    function setAdministrativelastname2($lastname2) {
        $this->administrativelastname2 = $lastname2;
    }

    function setAdministrativepassword($password) {
        $this->administrativepassword = $password;
    }

     function setAdministrativearea($area) {
        $this->administrativearea = $area;
    }
    
    function __toString() {
        try {
            return (string) $this->administrativeiid . ' | ' . $this->administrativename . ' | ' . $this->administrativelastname1 . ' | ' . $this->administrativelastname2;
        } catch (Exception $e) {
            return '';
        }
    }

}