<?php

require '../domain/Comment.php';
require '../business/ActivityBusiness.php';
require_once '../util/SSession.php';
require '../business/TagBusiness.php';
require '../util/TagMaker.php';

if (isset($_POST['create'])) {
    if (isset($_POST['commentactor']) && isset($_POST['activityid']) && isset($_POST['commentdescription'])) {
        if (strlen($_POST['activityid']) > 0 && strlen($_POST['commentdescription']) > 0 && strlen($_POST['commentactor']) > 0) {
            $commentBusiness = new CommentBusiness();
            $comment = new Comment();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $tagMaker = new TagMaker();



            $allCommentWords = explode(' ', $_POST['commentdescription']);
            $commentWords = array();

            foreach ($allCommentWords as $word) {
                if ($word >= 4) {
                    array_push($commentWords, $word);
                }
            }

            $commentCoincidence = $tagMaker->commentCoincidenceWithActivity($tagBusiness->selectActivity($_POST['activityid']), $commentWords);

            $comment->setActivityId($_POST['activityid']);
            $comment->setCommentDescription($_POST['commentdescription']);
            $comment->setCommentActor($_POST['commentactor']);
            $comment->setCommentDate(date("Y-m-d"));
            $comment->setCommentCoincidence($commentCoincidence);
            if(SSession::getInstance()->user['type'] == "student"){
                $comment->setCommentType("Estudiante");
            }else if (SSession::getInstance()->user['type'] == "administrative"){
                $comment->setCommentType("Administrativo");
            }else if (SSession::getInstance()->user['type'] == "professor"){
                $comment->setCommentType("Profesor");
            }else{
                $comment->setCommentType("Admin");
            }
            $activity->setActivityId($_POST['activityid']);


            $result = $commentBusiness->insert($comment);
            $resulta = $activityBusiness->updateComment($activity);

            if ($result == 1 and $resulta == 1) {
                print_r($commentCoincidence);

                // header("location: ../view/AdministrativeCommentView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeCommentView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeCommentView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeCommentView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['commentid']) && isset($_POST['activityid'])) {
        if (strlen($_POST['commentid']) > 0 && strlen($_POST['activityid']) > 0) {

            $commentBusiness = new CommentBusiness();
            $comment = new Comment();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $comment->setCommentId($_POST['commentid']);
            $result = $commentBusiness->delete($comment);
            $activity->setActivityId($_POST['activityid']);
            $resulta = $activityBusiness->CountCommentDelete($activity);


            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativeCommentView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeCommentView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeCommentView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeCommentView.php?error=empty");
    }
} else if (isset($_POST['public'])) {
    if (isset($_POST['commentdescription'])) {
        if (strlen($_POST['commentdescription']) > 0) {
            $commentBusiness = new CommentBusiness();
            $comment = new Comment();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $tagMaker = new TagMaker();
            $allCommentWords = explode(' ', $_POST['commentdescription']);
            $commentWords = array();

            foreach ($allCommentWords as $word) {
                if (strlen($word) >= 4) {
                    array_push($commentWords, $word);
                }
            }

            $activityTags = $tagBusiness->selectActivity($_POST['activityid']);
            $activitySize= $tagBusiness->selectActivitySize($_POST['activityid']);
            $commentCoincidence = $tagMaker->commentCoincidenceWithActivity($activityTags, $commentWords, $activitySize);

            $comment->setActivityId($_POST['activityid']);
            $comment->setCommentDescription($_POST['commentdescription']);
            $comment->setCommentActor(SSession::getInstance()->user['actorid']);
            $comment->setCommentDate(date("Y-m-d"));
            $comment->setCommentCoincidence($commentCoincidence);
            if(SSession::getInstance()->user['type'] == "student"){
                $comment->setCommentType("Estudiante");
            }else if (SSession::getInstance()->user['type'] == "administrative"){
                $comment->setCommentType("Administrativo");
            }else if (SSession::getInstance()->user['type'] == "professor"){
                $comment->setCommentType("Profesor");
            }else{
                $comment->setCommentType("Admin");
            }
            $activity->setActivityId($_POST['activityid']);


            $result = $commentBusiness->insert($comment);
            $resulta = $activityBusiness->updateComment($activity);

            if ($result == 1 and $resulta == 1) {

                header("location: ../view/CommentView.php?id=" . $_POST['activityid'] . "&title=" . $_POST['activitytitle'] . "&des=" . $_POST['activitydes'] . "&success=inserted");
            } else {
                header("location: ../view/CommentView.php?id=" . $_POST['activityid'] . "&title=" . $_POST['activitytitle'] . "&des=" . $_POST['activitydes'] . "&error=dbError");
            }
        } else {
            header("location: ../view/CommentView.php?id=" . $_POST['activityid'] . "&title=" . $_POST['activitytitle'] . "&des=" . $_POST['activitydes'] . "&error=format");
        }
    } else {
        header("location: ../view/CommentView.php?error=empty");
    }
}

class CommentBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/CommentData.php';
        $this->data = new CommentData();
    }

//End construct

    function insert(Comment $comment) {
        return $this->data->insert($comment);
    }

//End insert

    function selectidActivity($idActivity) {
        return $this->data->selectidActivity($idActivity);
    }
 
//End selectidActivity

    function delete(Comment $comment) {
        return $this->data->delete($comment);
    }

//End delete

    function update(Comment $comment) {
        return $this->data->update($comment);
    }

//End update

    function selectAll() {
        return $this->data->selectAll();
    }

//End selectAll

    function selectAllActivities() {
        return $this->data->selectAllActivities();
    }

    //End selectAllEvents

    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }

//End selectAllTotal
}

//End class EventBusiness