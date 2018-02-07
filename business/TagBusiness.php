<?php

class TagBusiness {
    
    //Attributes
    private $data;

    function __construct() {
        include_once '../data/TagData.php';
        $this->data = new TagData();
    }//End construct

    function insert($words=array()) {
        return $this->data->insert($words);
    }//End insert

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll
    
}//End class ActivityBusiness 
    