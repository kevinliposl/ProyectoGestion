<?php

class SPDO extends PDO {

    private static $instance = null;

    function __construct() {
        try {
            ///Para la base de datos de Jonathan
            parent::__construct('mysql:host=' . '127.0.0.1' . ';dbname=' . 'ucrpagecenter', 'root', 'Red12345');
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            parent::setAttribute(MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");
            parent::setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
        } catch (PDOException $e) {
            try {
                ///Para base de datos sin contrasenna
                parent::__construct('mysql:host=' . '127.0.0.1' . ';dbname=' . 'ucrpagecenter', 'root', '');
                parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                parent::setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
            } catch (Exception $ex) {
                return $ex->getMessage();
            }
        }
    }

    static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}
