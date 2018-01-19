<?php

class SPDO extends PDO {

    private static $instance = null;

    function __construct() {
        try {
            parent::__construct('mysql:host=' . '127.0.0.1' . ';dbname=' . 'ucrpagecenter', 'root', 'Red12345');
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
