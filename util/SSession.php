<?php

class SSession {

    const SESSION_STARTED = TRUE;
    const SESSION_NOT_STARTED = FALSE;

    private static $sessionState = self::SESSION_NOT_STARTED;
    private static $instance;

    private function __construct() {
        ;
    }

    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        self::$instance->startSession();
        return self::$instance;
    }

    function startSession() {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }
        return $this->sessionState;
    }

    function __set($name, $value) {
        $_SESSION[$name] = $value;
    }

    function __get($name) {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
    }

    function __isset($name) {
        return isset($_SESSION[$name]);
    }

    function __unset($name) {
        unset($_SESSION[$name]);
    }

    function destroy() {
        if ($this->sessionState == self::SESSION_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);
            return !$this->sessionState;
        }
        return FALSE;
    }

}
