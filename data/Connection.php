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
        $this->isActive = false;
        $this->server = "127.0.0.0";
        $this->user = "root";
        $this->password = "";
        $this->db = "proyectoGestion2018";
    }

}
