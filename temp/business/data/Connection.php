<?php

class Connection {

    public $server;
    public $user;
    public $password;
    public $db;
    public $connection;
    public $isActive;

    /* constructor */

    public function Connection() {
        $this->server = "localhost";
        $this->isActive = false;
        $this->user = "root";
        $this->password = "";
        $this->db = "gestion2018";
    }

}
