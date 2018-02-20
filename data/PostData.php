<?php

class PostData {
    
    //Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }//End construct
    
    function insert(Activity $activity,Post $post) {    

        $query = $this->db->prepare(
                "INSERT INTO tbpost VALUES (" . $activity->getActivityId() . "," .
                0 . ");"
        );
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if-else(!$result)
    }//End insert
    
    function selectAll() {
        $query = $this->db->prepare("SELECT a.*, p.* FROM tbactivity a INNER JOIN tbpost p ON a.activityid = p.activityid WHERE a.activityestate = 0 AND p.poststate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }//End selectALL
    
    function selectAllTotal() {
        $query = $this->db->prepare("SELECT a.*,p.* FROM tbactivity a INNER JOIN tbpost p ON a.activityid = p.activityid WHERE a.activityestate = 0 AND p.poststate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }//End selectALL
    
    
    function update(Post $post) {
        $query = $this->db->prepare("UPDATE tbpost "
                . "SET activityid =" . $post->getActivityId().
                " WHERE activityid=" . $post->getActivityId() . ";");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }//End update
    
    function delete(Post $post) {
        $query = $this->db->prepare("UPDATE tbpost SET poststate=:state WHERE activityid=:id;");
        $query->execute(array('state' => 1, 'id' => $post->getActivityId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }//End delete
    
}//End class EventData
