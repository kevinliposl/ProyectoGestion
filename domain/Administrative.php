<?php

class Administrative {

    private $administrativeid;
    private $administrativemail;
    private $administrativelicense;
    private $administrativename;
    private $administrativelastname1;
    private $administrativelastname2;
    private $administrativearea;
    private $administrativepassword;

    function getAdministrativeid() {
        return $this->administrativeid;
    }

    function getAdministrativemail() {
        return $this->administrativemail;
    }

    function getAdministrativelicense() {
        return $this->administrativelicense;
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

    function getAdministrativearea() {
        return $this->administrativearea;
    }

    function getAdministrativepassword() {
        return $this->administrativepassword;
    }

    function setAdministrativeid($administrativeid) {
        $this->administrativeid = $administrativeid;
    }

    function setAdministrativemail($administrativemail) {
        $this->administrativemail = $administrativemail;
    }

    function setAdministrativelicense($administrativelicense) {
        $this->administrativelicense = $administrativelicense;
    }

    function setAdministrativename($administrativename) {
        $this->administrativename = $administrativename;
    }

    function setAdministrativelastname1($administrativelastname1) {
        $this->administrativelastname1 = $administrativelastname1;
    }

    function setAdministrativelastname2($administrativelastname2) {
        $this->administrativelastname2 = $administrativelastname2;
    }

    function setAdministrativearea($administrativearea) {
        $this->administrativearea = $administrativearea;
    }

    function setAdministrativepassword($administrativepassword) {
        $this->administrativepassword = $administrativepassword;
    }

}
