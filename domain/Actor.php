<?php

class Actor {

    private $actorid;
    private $actormail;
    private $actorlastname1;
    private $actorname;
    private $actortype;
    private $actorpassword;

    function getActorpassword() {
        return $this->actorpassword;
    }

    function setActorpassword($actorpassword) {
        $this->actorpassword = $actorpassword;
    }

    function getActorid() {
        return $this->actorid;
    }

    function setActorid($actorid) {
        $this->actorid = $actorid;
    }

    function getActormail() {
        return $this->actormail;
    }

    function getActorlastname1() {
        return $this->actorlastname1;
    }

    function getActorname() {
        return $this->actorname;
    }

    function getActortype() {
        return $this->actortype;
    }

    function setActormail($actormail) {
        $this->actormail = $actormail;
    }

    function setActorlastname1($actorlastname1) {
        $this->actorlastname1 = $actorlastname1;
    }

    function setActorname($actorname) {
        $this->actorname = $actorname;
    }

    function setActortype($actortype) {
        $this->actortype = $actortype;
    }

}
