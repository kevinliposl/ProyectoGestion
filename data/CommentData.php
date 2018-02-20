<?php

class CommentData {

    //Attributes
    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function getlastid() {
        $queryLastId = $this->db->prepare("SELECT MAX(commentid) AS commentid  FROM tbcomment;");
        $queryLastId->execute();
        $resultLastId = $queryLastId->fetch();
        $queryLastId->closeCursor();
        $nextId = 1;

        if ($resultLastId['commentid'] != NULL) {
            $nextId = (int) $resultLastId['commentid'] + 1;
        }
        return $nextId;
    }

    function insert(Comment $comment) {
        
        echo '<script language="javascript">alert("juas");</script>'; 
        $lastid = $this->getlastid();

        $query = $this->db->prepare("INSERT INTO tbcomment VALUES(:commentid,:activityid,:commentdescription,:commentcreated,:commentactor,:commentstate);");
        $query->execute(array('commentid' => $lastid, 'activityid' => $comment->getActivityId(), 'commentdescription' => $comment->getCommentDescription(),
            'commentcreated' => $comment->getCommentDate(), 'commentactor' => (int) $comment->getCommentActor(), 'commentstate' => 1));
        $query->fetch();
        $query->closeCursor();

        $queryResult = $this->db->prepare("SELECT * FROM tbcomment WHERE commentid =:commentid;");
        $queryResult->execute(array('commentid' => $lastid));
        $verifierResult = $queryResult->fetch();
        $queryResult->closeCursor();

        if ($verifierResult['commentid'] != NULL) {
            return 1;
        } else {
            return 0;
        }
    }

//End insert

    function selectAll() {
        $query = $this->db->prepare("SELECT * from tbcomment where commentstate=:state;");
        $query->execute(array('state' => 1));
        $result = $query->fetchAll(); //PDO::FETCH_ASSOC
        $query->closeCursor();

        $comments = [];
        $currentComment = new Comment();

        foreach ($result as $row) {

            $currentComment->setCommentId($row['commentid']);
            $currentComment->setActivityId($row['activityid']);
            $currentComment->setCommentDate($row['commentcreated']);
            $currentComment->setCommentActor($row['commentactor']);
            $currentComment->setCommentDescription($row['commentdescription']);

            array_push($comments, $currentComment);
        }//End foreach ($result as $row)

        return $comments;
    }
    
    function selectAllEvents() {
        $query = $this->db->prepare(" SELECT a.activitytitle,a.activitydescription, e.*, c.* FROM tbactivity a INNER JOIN tbevent e ON a.activityid = e.activityid INNER JOIN tbcomment c ON a.activityid = c.activityid  where c.commentstate!=0;");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }//End selectALL

//End selectALL

    function select($idComment) {
        $query = $this->db->prepare("SELECT * FROM tbcomment WHERE commentid=" . $idComment . ";");
        $query->execute();
        $row = $query->fetch();

        $currentComment = new Comment();

        $currentComment->setCommentId($row['commentid']);
        $currentComment->setActivityId($row['activityid']);
        $currentComment->setCommentDate($row['commentcreated']);
        $currentComment->setCommentActor($row['commentactor']);
        $currentComment->setCommentDescription($row['commentdescription']);

        return $currentComment;
    }

//End select
    
    function selectidActivity($idActivity) {
        $query = $this->db->prepare("SELECT c.commentid,c.activityid,c.commentdescription,c.commentcreated,c.commentstate,a.actormail FROM tbcomment c INNER JOIN tbactor a on c.commentactor = a.actorid and c.commentstate = 1 WHERE c.activityid =" . $idActivity . ";");
        $query->execute();        
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $result;
    }

//End select

    function delete(Comment $comment) {
        $query = $this->db->prepare("UPDATE tbcomment SET commentstate=:state WHERE commentid=:id;");
        $query->execute(array('state' => 0, 'id' => $comment->getCommentId()));
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 1;
        } else {
            return 0;
        }//End if (!$result)
    }

//End delete

    function update(Comment $comment) {
        $query = $this->db->prepare("UPDATE tbcomment "
                . "SET commentid =" . $comment->getCommentId() .
                ", activityid=" . $comment->getActivityId() .
                ", commentdescription='" . $comment->getCommentDescription() .
                ", commentactor=" . $comment->getCommentActor() .
                "' WHERE commentid=" . $comment->getCommentId() . ";");
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
}

//End class ActivityData