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
