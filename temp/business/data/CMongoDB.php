<?php

class sMongoDB{

    private static $instance = null;

    private function __construct() {
        
    }

    static function singleton() {
        if (self::$instance == null) {
            $config = Config::singleton();
            self::$instance = new MongoClient('mongodb://<dbuser>:<dbpassword>@ds057234.mlab.com:57234/generalcuarto' . $config->get('dbhost') .':'. $config->get('dbport'),  array('wTimeoutMS' => 500));
        }
        return self::$instance;
    }

}