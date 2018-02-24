<?php

require_once '../domain/Tag.php';

class TagBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/TagData.php';
        $this->data = new TagData();
        //End construct
    }

    function insert($words) {
        return $this->data->insert($words);
        //End insert
    }

    function selectActivity($activityId) {
        return $this->data->selectActivity($activityId);
        //End selectAll
    }

//End class ActivityBusiness 
}
