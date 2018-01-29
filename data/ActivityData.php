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
        $query = $this->db->prepare("SELECT * from tbactivity where administrativestate=:state;");
        $query->execute(array('state' => 0));
        $result = $query->fetchAll(); //PDO::FETCH_ASSOC
        $query->closeCursor();
        
        $administratives = [];
        $currentAdministrative = new Administrative();
        
        foreach ($result as $row) {
            
            $currentAdministrative->setAdministrativeid($row['administrativeid']);
            $currentAdministrative->setAdministrativelicense($row['administrativelicense']);
            $currentAdministrative->setAdministrativename($row['administrativename']);
            $currentAdministrative->setAdministrativelastname1($row['administrativelastname1']);
            $currentAdministrative->setAdministrativelastname2($row['administrativelastname2']);
            $currentAdministrative->setAdministrativearea($row['administrativearea']);
            $currentAdministrative->setAdministrativepassword($row['administrativepassword']);
            
            array_push($administratives, $currentAdministrative);
        }//End foreach ($result as $row)
        
        return $administratives;
    }//End selectALL
    
}//End class ActivityData
