<?php

class Enclosure {

    //Attributes
    private $enclosureid;
    private $enclosureuniversityid;
    private $enclosureheadquarterid;
    private $enclosurecode;
    private $enclosurename;
    private $enclosurenlocation;

    function __construct() {
        ;
    }

    function __toString() {
        try {
            return (string) $this->enclosureid . ' | ' . $this->enclosurecode . ' | ' . $this->enclosureuniversityid . ' | ' . $this->enclosurename . ' | ' . $this->enclosurenlocation . ' | ' . $this->enclosureheadquarterid;
        } catch (Exception $e) {
            return '';
        }
    }

    function getEnclosureid() {
        return $this->enclosureid;
    }

    function getEnclosureuniversityid() {
        return $this->enclosureuniversityid;
    }

    function getEnclosureheadquarterid() {
        return $this->enclosureheadquarterid;
    }

    function getEnclosurecode() {
        return $this->enclosurecode;
    }

    function getEnclosurename() {
        return $this->enclosurename;
    }

    function getEnclosurenlocation() {
        return $this->enclosurenlocation;
    }

    function setEnclosureid($enclosureid) {
        $this->enclosureid = $enclosureid;
    }

    function setEnclosureuniversityid($enclosureuniversityid) {
        $this->enclosureuniversityid = $enclosureuniversityid;
    }

    function setEnclosureheadquarterid($enclosureheadquarterid) {
        $this->enclosureheadquarterid = $enclosureheadquarterid;
    }

    function setEnclosurecode($enclosurecode) {
        $this->enclosurecode = $enclosurecode;
    }

    function setEnclosurename($enclosurename) {
        $this->enclosurename = $enclosurename;
    }

    function setEnclosurenlocation($enclosurenlocation) {
        $this->enclosurenlocation = $enclosurenlocation;
    }
}
