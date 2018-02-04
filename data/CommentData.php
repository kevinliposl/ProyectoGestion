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
        $lastid = $this->getlastid();

        $query = $this->db->prepare("INSERT INTO tbcomment VALUES(:commentid,:activityid,:commentdescription,:commentcreated,:commentactor,:commentstate);");
        $query->execute(array('commentid' => $lastid, 'activityid' => $comment->getActivityId(), 'commentdescription' => $comment->getCommentDescription(),
            'commentcreated' => $comment->getCommentDate(), 'commentstate' => 1, 'commentactor' => (int) $comment->getCommentActor()));
        $query->fetch();
        $query->closeCursor();

        $queryResult = $this->db->prepare("SELECT * FROM tbcomment WHERE commentid =:commentid;");
        $queryResult->execute(array('commentid' => $lastid));
        $verifierResult = $queryResult->fetch();
        $queryResult->closeCursor();

        if (!$verifierResult['commentid'] != NULL) {
            return 1;
        } else {
            return 0;
        }
    }

//End insert

    function selectAll() {
        $query = $this->db->prepare("SELECT * from tbcomment where commentstate=:state;");
        $query->execute(array('state' => 0));
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

    function delete(Comment $comment) {
        $query = $this->db->prepare("UPDATE tbcomment SET commentestate=:state WHERE commentid=:id;");
        $query->execute(array('state' => 1, 'id' => $comment->getCommentId()));
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