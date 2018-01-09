<?php

class Student {

    private $id;
    private $mail;
    private $name;
    private $lastname1;
    private $lastname2;
    private $career1;
    private $career2;
    private $headquarters;

    function __construct($id, $mail, $name, $lastname1, $lastname2, $career1, $career2, $headquarters) {
        $this->id = $id;
        $this->mail = $mail;
        $this->name = $name;
        $this->lastname1 = $lastname1;
        $this->lastname2 = $lastname2;
        $this->career1 = $career1;
        $this->career2 = $career2;
        $this->headquarters = $headquarters;
    }

    function __get($name) {
        if (ObjectHelper::existsMethod($this, $name)) {
            return $this->$name();
        }
        return null;
    }

    function __set($name, $value) {
        if (ObjectHelper::existsMethod($this, $name)) {
            $this->$name($value);
        }
    }

}
