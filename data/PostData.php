<?php

class PostData {

    //Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

//End construct
    
     private function getlastid() {
        $queryLastId = $this->db->prepare("SELECT MAX(activityid) AS activityid FROM tbactivity");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;
        if ($resultLastId['activityid'] != NULL) {
            $nextId = intval($resultLastId['activityid'] + 1);
        }
        return $nextId;
    }
    
    private function existsActivity(Activity $activity) {
        $queryExistsActivity = $this->db->prepare("SELECT activityid FROM tbactivity WHERE activityid=:id;");
        $queryExistsActivity->execute(array('id' => $activity->getActivityId()));
        $resultActivity = $queryExistsActivity->fetch();
        $queryExistsActivity->closeCursor();

      
        return !$resultActivity['activityid'] ? 1 : 0;
    }


    function insert(Post $post) {

                $queryInsertPost = $this->db->prepare("INSERT INTO tbpost VALUES (:postid,:poststate);");
                $queryInsertPost->execute(array('postid' => $post->getActivityId(), 'poststate' => 0));
                $queryInsertPost->fetch();
                $queryInsertPost->closeCursor();

                $queryExistsPost= $this->db->prepare("SELECT postid FROM tbpost WHERE postid=:id;");
                $queryExistsPost->execute(array('id' => $post->getActivityId()));
                $resultPost = $queryExistsPost->fetch();
                $queryExistsPost->closeCursor();

                return $resultPost['postid'] ? 1 : 0;
            
        
        
        /**$query = $this->db->prepare(
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
        }//End if-else(!$result)**/
    }

//End insert

    function selectAll() {
        $query = $this->db->prepare("SELECT a.*, p.* FROM tbactivity a INNER JOIN tbpost p ON a.activityid = p.postid WHERE a.activitystate = 0 AND p.poststate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

//End selectALL

    function selectAllTotal() {
        $query = $this->db->prepare("SELECT a.*,p.* FROM tbactivity a INNER JOIN tbpost p ON a.activityid = p.postid WHERE a.activitystate = 0 AND p.poststate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

//End selectALL

    function update(Post $post) {
        $query = $this->db->prepare("UPDATE tbpost "
                . "SET activityid =" . $post->getActivityId() .
                " WHERE activityid=" . $post->getActivityId() . ";");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }

//End update

    function delete(Post $post) {
        $query = $this->db->prepare("UPDATE tbpost SET poststate=:state WHERE postid=:id;");
        $query->execute(array('state' => 1, 'id' => $post->getActivityId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }

//End delete
}

//End class EventData
