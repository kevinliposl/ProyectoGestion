<?php

class Professor {

    function __construct() {
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
