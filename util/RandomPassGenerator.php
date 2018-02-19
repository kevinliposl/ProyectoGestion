<?php

class RandomPassGenerator {

    private static $instance = null;

    private function __construct() {
        ;
    }

    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function keygen($length) {
        $key = '';
        $chars = array_merge(range(0, 9), range('a', 'z'), range(0, 9), range('A', 'Z'), range(0, 9));
        shuffle($chars);

        $chars = str_shuffle(str_rot13(join('', $chars)));
        $split = ceil($length / 5);
        $size = strlen($chars);

        $splitSize = ceil($size / $split);
        $chunkSize = $splitSize + mt_rand(1, 5);
        $chunkArray = array();

        while ($split != 0) {
            $strip = substr($chars, mt_rand(0, $size - $chunkSize), $chunkSize);
            array_push($chunkArray, strrev($strip));
            $split--;
        }

        foreach ($chunkArray as $set) {
            $adjust = ((($length - strlen($key)) % 5) == 0) ? 5 : ($length - strlen($key)) % 5;
            $setSize = strlen($set);
            $key .= substr($set, mt_rand(0, $setSize - $adjust), $adjust);
        }
        return str_rot13(str_shuffle($key));
    }

}
