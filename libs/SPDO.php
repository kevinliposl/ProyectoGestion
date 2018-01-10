<?php

class SPDO extends PDO {

    private static $instance = null;

    function __construct() {
        try {
            $config = Config::singleton();
            parent::__construct('mysql:host=' . $config->get('dbhost') . ';dbname=' . $config->get('dbname'), $config->get('dbuser'), $config->get('dbpass'));
        } catch (Exception $e) {
            header("Location:?action=notFound");
        }
    }

    static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
