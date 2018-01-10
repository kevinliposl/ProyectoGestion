<?php

class StudentModel {

    private $db;

    public function __construct() {
        require 'libs/SPDO.php';
        $this->db = SPDO::singleton();
    }

    public function insert($id, $name, $lastname1, $lastname2, $career1, $career2) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    public function update($id, $name, $lastname1, $lastname2, $career1, $career2) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    public function selectAll() {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetchAll();
        $query->closeCursor();
        return $result;
    }

    public function select($id) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        return $result;
    }

    public function delete($id) {
        $query = $this->db->prepare();
        $query->execute();
        $result = $query->fetch();
        return $result;
    }
}
