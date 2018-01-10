<?php

class Config {

    private $vars;
    private static $instance = null;

    private function __construct() {
        $this->vars = array();
    }

    function set($nombreAtributo, $valor) {
        if (!isset($this->vars[$nombreAtributo])) {
            $this->vars[$nombreAtributo] = $valor;
        }
    }

    function get($nombreAtributo) {
        if (isset($this->vars[$nombreAtributo])) {
            return $this->vars[$nombreAtributo];
        }
    }

    static function singleton() {
        if (self::$instance== null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
