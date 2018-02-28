<?php

class SearchData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function selectPost(Search $search) {
        $tmp = $this->createQueryPost($search);
        $query = $this->db->prepare($tmp);
        //return $tmp;
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    private function createQueryPost(Search $search) {
        $query = "SELECT DISTINCT a.activityid, a.*,p.* FROM tbactivity a INNER JOIN tbtag t ON a.activityid = t.tagactivityid INNER JOIN tbpost p ON a.activityid = p.postid";
        if ($search->getSearchDate() != NULL) {
            $query .= strpos($query, 'WHERE') == NULL ? ' WHERE ' : '';
            $query .= 'a.createddate=' . $search->getSearchDate() . ' OR a.updatedate=' . $search->getSearchDate() . ' ';
        }
        if ($search->getSearchGeneral() != NULL) {
            foreach ($search->getSearchGeneral() as $var) {
                if (trim($var) != '') {
                    if (strpos($query, "WHERE") == NULL) {
                        $query .= " WHERE t.tagword LIKE '%" . strtolower($var) . "%'";
                    } else {
                        $query .= " OR t.tagword LIKE '%" . strtolower($var) . "%'";
                    }
                }
            }
        }
        $query .= ';';
        return $query;
    }

    function selectEvent(Search $search) {
        $tmp = $this->createQueryEvent($search);
        $query = $this->db->prepare($tmp);
        //return $tmp;
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();
        return $result;
    }

    private function createQueryEvent(Search $search) {
        $query = "SELECT DISTINCT a.activityid, a.* FROM tbactivity a INNER JOIN tbevent e ON a.activityid = e.eventid INNER JOIN tbtag t ON a.activityid = t.tagactivityid  ";
        if ($search->getSearchDate() != NULL) {
            $query .= strpos($query, 'WHERE') == NULL ? ' WHERE ' : '';
            $query .= "a.activitycreateddate='" . $search->getSearchDate() . "' OR a.activityupdatedate='" . $search->getSearchDate() . "' ";
        }
        if ($search->getSearchHour() != NULL) {
            if (strpos($query, 'WHERE') == NULL) {
                $query .= " WHERE e.eventhour='" . $search->getSearchHour() . ":00'";
            } else {
                $query .= " OR e.eventhour='" . $search->getSearchHour() . ":00'";
            }
        }
        if ($search->getSearchPlace() != NULL && $search->getTypeActivity() == 'event') {
            if (strpos($query, 'WHERE') == NULL) {
                $query .= " WHERE tbevent.eventplace LIKE'%" . strtolower($search->getSearchPlace()) . "%'";
            } else {
                $query .= " OR tbevent.eventplace LIKE'%" . strtolower($search->getSearchPlace()) . "%'";
            }
        }
        if ($search->getSearchGeneral() != NULL) {
            foreach ($search->getSearchGeneral() as $var) {
                if (trim($var) != '') {
                    if (strpos($query, "WHERE") == NULL) {
                        $query .= " WHERE t.tagword LIKE '%" . strtolower($var) . "%'";
                    } else {
                        $query .= " OR t.tagword LIKE '%" . strtolower($var) . "%'";
                    }
                }
            }
        }
        if (strpos($query, "WHERE") == NULL) {
            $query .= " WHERE DATEDIFF(CURDATE(),e.eventdate) <= e.eventdayafter || DATEDIFF(CURDATE(),e.eventdate) <= e.eventdaybefore;";
        } else {
            $query .= " AND DATEDIFF(CURDATE(),e.eventdate) <= e.eventdayafter || DATEDIFF(CURDATE(),e.eventdate) <= e.eventdaybefore;";
        }
        return $query;
    }

}
