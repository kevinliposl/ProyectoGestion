<?php

class PublicationData {
    
    //Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }//End construct
    
    function insert(Activity $activity,Event $event) {    

        $query = $this->db->prepare(
                "INSERT INTO tbpublication VALUES (" . $activity->getActivityId() .",". 0 . ");"
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
        $query = $this->db->prepare("SELECT a.activitytitle,a.activitydescription FROM tbactivity as a INNER JOIN tbpublication as p ON a.activityid = p.activityid WHERE a.activityestate = 0 AND e.eventestate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }//End selectALL
    
    function selectAllTotal() {
        $query = $this->db->prepare("SELECT a.*,e.* FROM tbactivity a INNER JOIN tbevent e ON a.activityid = e.activityid WHERE a.activityestate = 0 AND p.publicationstate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }//End selectALL
    
    function select($idActivity) {
        $query = $this->db->prepare("SELECT * FROM tbpublication WHERE activityid=" . $idActivity. ";");
        $query->execute();
        $row = $query->fetch();
        
        $currentPublication= new Publication();
        $currentPublication->setActivityId($row['activityid']);
        
        return $currentPublication;
    }//End select
    
    function update(Publication $publication) {
        $query = $this->db->prepare("UPDATE tbpublication "
                . "SET activityid =" . $publication->getActivityId() .
                "' WHERE activityid=" . $publication->getActivityId() . ";");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }//End update
    
    function delete(Publication $publication) {
        $query = $this->db->prepare("UPDATE tbpublication SET publicationstate=:state WHERE activityid=:id;");
        $query->execute(array('state' => 1, 'id' => $publication->getActivityId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }//End delete
    
}//End class PublicationData

