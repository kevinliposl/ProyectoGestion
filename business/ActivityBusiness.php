<?php
require_once '../domain/Activity.php';

class ActivityBusiness {
    
    //Attributes
    private $data;

    function __construct() {
        include_once '../data/ActivityData.php';
        $this->data = new ActivityData();
    }//End construct

    function insert(Activity $activity) {
        return $this->data->insert($activity);
    }//End insert

    function delete(Activity $activity) {
        return $this->data->delete($activity);
    }//End delete

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll
    
    function getActivity(){
        return $this->data->getActivity();
    }//End getActivity
    
    function update(Activity $activity){
        return $this->data->update($activity);
    }//End update
    
    function updateComment(Activity $activity) {
        return $this->data->updateComment($activity);
    }//End updateComment
    
    function CountCommentDelete(Activity $activity) {
        return $this->data->CountCommentDelete($activity);
    }//End CountCommentDelete
    
}//End class ActivityBusiness 
    
