<?php

require '../domain/Comment.php';

if (isset($_POST['create'])) {
    if (isset($_POST['commentactor']) && isset($_POST['activityid']) && isset($_POST['commentdescription'])) {
        if (strlen($_POST['activityid']) > 0 && strlen($_POST['commentdescription']) > 0 && strlen($_POST['commentactor']) > 0) {
            $commentBusiness = new CommentBusiness();
            $comment = new Comment();

            $comment->setActivityId($_POST['activityid']);
            $comment->setCommentDescription($_POST['commentdescription']);
            $comment->setCommentActor($_POST['commentactor']);
            $comment->setCommentDate(date("Y-m-d"));

            $result = $commentBusiness->insert($comment);

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
} else if (isset($_POST['delete'])) {
    if (isset($_POST['commentid'])) {
        if (strlen($_POST['commentid']) > 0) {

            $commentBusiness = new CommentBusiness();
            $comment = new Comment();

            $comment->setCommentId($_POST['commentid']);
            $result = $commentBusiness->delete($comment);


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

    function delete(Event $event) {
        return $this->data->delete($event);
    }

//End delete

    function update(Event $event) {
        return $this->data->update($event);
    }

//End update

    function selectAll() {
        return $this->data->selectAll();
    }

//End selectAll

    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }

//End selectAllTotal
}

//End class EventBusiness
