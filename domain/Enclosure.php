<?php

class Enclosure {

    //Attributes
    private $enclosureid;
    private $enclosurename;
    private $enclosureuniversityid;
    private $enclosureheadquarterid;

    function __construct() {
        ;
    }

    function getEnclosureid() {
        return $this->enclosureid;
    }

    function getEnclosurename() {
        return $this->enclosurename;
    }

    function getEnclosureuniversityid() {
        return $this->enclosureuniversityid;
    }

    function getEnclosureheadquarterid() {
        return $this->enclosureheadquarterid;
    }

    function setEnclosureid($enclosureid) {
        $this->enclosureid = $enclosureid;
    }

    function setEnclosurename($enclosurename) {
        $this->enclosurename = $enclosurename;
    }

    function setEnclosureuniversityid($enclosureuniversityid) {
        $this->enclosureuniversityid = $enclosureuniversityid;
    }

    function setEnclosureheadquarterid($enclosureheadquarterid) {
        $this->enclosureheadquarterid = $enclosureheadquarterid;
    }

}
