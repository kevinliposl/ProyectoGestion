<?php

class SPDO extends PDO {

    private static $instance = null;

    function __construct() {
        try {
            parent::__construct('mysql:host=' . '127.0.0.1' . ';dbname=' . 'prueba', 'root', '');
        } catch (Exception $e) {
            return 0;
        }
    }

    static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
