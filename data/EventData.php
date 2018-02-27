<?php

class EventData {

//Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

//End construct

    function insert( Event $event) {


        $queryInsertEvent = $this->db->prepare("INSERT INTO tbevent VALUES (:eventid,:eventplace,:eventdate,:eventhour,:eventdayafter,:eventdaybefore,:eventstate);");
        $queryInsertEvent->execute(array('eventid' => $event->getActivityId(), 'eventplace' => $event->getEventPLace(), 'eventdate' => $event->getEventDate(), 'eventhour' => $event->getEventHour(), 'eventdayafter' => $event->getDayAfther(), 'eventdaybefore' => $event->getDayBefore(), 'eventstate' => 0));
        $queryInsertEvent->fetch();
        $queryInsertEvent->closeCursor();

        $queryExistsPost = $this->db->prepare("SELECT eventid FROM tbevent WHERE eventid=:id;");
        $queryExistsPost->execute(array('id' => $event->getActivityId()));
        $resultPost = $queryExistsPost->fetch();
        $queryExistsPost->closeCursor();

        return $resultPost['eventid'] ? 1 : 0;


        /* $query = $this->db->prepare(
          "INSERT INTO tbevent VALUES (" . $activity->getActivityId() . ",'" .
          $event->getEventPLace() . "','" .
          $event->getEventDate() . "','" .
          $event->getEventHour() . "'," .
          $event->getDayAfther() . "," .
          $event->getDayBefore() . "," .
          0 . ");"
          );
          $query->execute();
          $result = $query->fetch();
          $query->closeCursor();

          if (!$result) {
          return 1;
          } else {
          return 0;* */
    }

//End if-else(!$result)
//End insert

    function selectAll() {
        $query = $this->db->prepare("SELECT a.*, e.* FROM tbactivity a INNER JOIN tbevent e ON a.activityid = e.eventid WHERE a.activitystate = 0 AND e.eventestate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

//End selectALL

    function selectAllTotal() {
        $query = $this->db->prepare("SELECT a.*,e.* FROM tbactivity a INNER JOIN tbevent e ON a.activityid = e.eventid WHERE a.activitystate = 0 AND e.eventestate = 0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

//End selectALL

    function select($idActivity) {
        $query = $this->db->prepare("SELECT * FROM tbevent WHERE eventid=" . $idActivity . ";");
        $query->execute();
        $row = $query->fetch();

        $currentEvent = new Event();
        $currentEvent->setActivityId($row['eventid']);
        $currentEvent->setCreateDate($row['eventplace']);
        $currentEvent->setUpdateDate($row['eventdate']);
        $currentEvent->setLikeCount($row['eventhour']);
        $currentEvent->setDayAfther($row['eventdayafter']);
        $currentEvent->setDayBefore($row['eventdaybefore']);

        return $currentEvent;
    }

//End select

    function update(Event $event) {
        $query = $this->db->prepare("UPDATE tbevent "
                . "SET eventid =" . $event->getActivityId() .
                ", eventdayafter=" . $event->getDayAfther() .
                ", eventdaybefore=" . $event->getDayBefore() .
                ", eventplace='" . $event->getEventPLace() .
                "', eventdate='" . $event->getEventDate() .
                "', eventhour='" . $event->getEventHour() .
                "' WHERE eventid=" . $event->getActivityId() . ";");
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

    function delete(Event $event) {
        $query = $this->db->prepare("UPDATE tbevent SET eventestate=:state WHERE eventid=:id;");
        $query->execute(array('state' => 1, 'id' => $event->getActivityId()));
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
