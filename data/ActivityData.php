<?php


class ActivityData {
    
    //Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }//End construct
    
    function insert(Activity $activity) {    

        $queryLastId = $this->db->prepare("SELECT MAX(activityid) AS activityid  FROM tbactivity");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        //ultimo id
        if ($resultLastId['activityid'] != NULL) {
            $nextId = (int) $resultLastId['activityid'] + 1;
        }//End if ($resultLastId['activityid'] != NULL)
        $query = $this->db->prepare(
                "INSERT INTO tbactivity VALUES (" . $nextId . ",'" .
                $activity->getCreateDate() . "','" .
                $activity->getUpdateDate() . "','" .
                $activity->getLikeCount() . "','" .
                $activity->getCommentCount() . "','" .
                $activity->getActivityTitle() . "'," .
                $activity->getActivityDescription() . ");"
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
        $query = $this->db->prepare("SELECT * from tbactivity where activityestate=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll(); //PDO::FETCH_ASSOC
        $query->closeCursor();
        
        $activities = [];
        $currentActivity = new Activity();
        
        foreach ($result as $row) {
            
            $currentActivity->setActivityId($row['activityid']);
            $currentActivity->setCreateDate($row['createddate']);
            $currentActivity->setUpdateDate($row['updatedate']);
            $currentActivity->setLikeCount($row['likecount']);
            $currentActivity->setCommentCoun($row['commentcount']);
            $currentActivity->setActivityTitle($row['activitytitle']);
            $currentActivity->setActivityDescription($row['activitydescription']);
            
            array_push($activities, $currentActivity);
        }//End foreach ($result as $row)
        
        return $activities;
    }//End selectALL
    
    
    function select($idActivity) {
        $query = $this->db->prepare("SELECT * FROM tbactivity WHERE activityid=" . $idActivity. ";");
        $query->execute();
        $row = $query->fetch();
        
        $currentActivity= new Activity();
        $currentActivity->setActivityId($row['activityid']);
        $currentActivity->setCreateDate($row['createddate']);
        $currentActivity->setUpdateDate($row['updatedate']);
        $currentActivity->setLikeCount($row['likecount']);
        $currentActivity->setCommentCoun($row['commentcount']);
        $currentActivity->setActivityTitle($row['activitytitle']);
        $currentActivity->setActivityDescription($row['activitydescription']);
        
        return $currentActivity;
    }//End select
    
    function delete(Activity $activity) {
        $query = $this->db->prepare("UPDATE tbactivity SET activityestate=:state WHERE activityid=:id;");
        $query->execute(array('state' => 1, 'id' => $activity->getActivityId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }//End delete
    
}//End class ActivityData