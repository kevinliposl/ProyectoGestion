<?php

class Validate {

    static function evalMail($mail) {
        return (filter_var($mail, FILTER_VALIDATE_EMAIL)) ? 1 : 0;
    }

    static function sanitizedMail($mail) {
       return filter_var($mail, FILTER_SANITIZE_EMAIL);
    }
}
