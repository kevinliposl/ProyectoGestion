<?php

require '../domain/Comment.php';
require '../business/ActivityBusiness.php';

if (isset($_POST['create'])) {
    if (isset($_POST['commentactor']) && isset($_POST['activityid']) && isset($_POST['commentdescription'])) {
        if (strlen($_POST['activityid']) > 0 && strlen($_POST['commentdescription']) > 0 && strlen($_POST['commentactor']) > 0) {
            $commentBusiness = new CommentBusiness();
            $comment = new Comment();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $comment->setActivityId($_POST['activityid']);
            $comment->setCommentDescription($_POST['commentdescription']);
            $comment->setCommentActor($_POST['commentactor']);
            $comment->setCommentDate(date("Y-m-d"));
            $activity->setActivityId($_POST['activityid']);

            $result = $commentBusiness->insert($comment);
            $resulta = $activityBusiness->updateComment($activity);

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
} else if (isset($_POST['delete'])) {
    if (isset($_POST['commentid'])) {
        if (strlen($_POST['commentid']) > 0) {

            $commentBusiness = new CommentBusiness();
            $comment = new Comment();

            $comment->setCommentId($_POST['commentid']);
            $result = $commentBusiness->delete($comment);


            if ($result == 1) {
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
    
    function selectAllEvents() {
        return $this->data->selectAllEvents();
    }

    //End selectAllEvents
    
    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }

//End selectAllTotal
}

//End class EventBusiness
