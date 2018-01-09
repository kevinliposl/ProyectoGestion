<?php

class Data {

    public $server;
    public $user;
    public $password;
    public $db;
    public $connection;
    public $isActive;

    /* constructor */

    public function connection() {
        $this->isActive = false;
        $this->server = "163.178.130.107";
        $this->user = "adm";
        $this->password = "saucr.092";
        $this->db = "proyectoGestion2018";
    }

}
