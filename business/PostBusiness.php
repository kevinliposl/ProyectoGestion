<?php

require '../domain/Post.php';
require '../domain/Activity.php';
require '../business/ActivityBusiness.php';
require '../business/TagBusiness.php';
require '../util/TagMaker.php';

if (isset($_POST['create'])) {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        if (strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0) {

            $post = new Post();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $postBusiness = new PostBusiness();
            $activityBusiness = new ActivityBusiness();
            $tagMaker = new TagMaker();

            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setCreateDate(date("Y-m-d"));
            $activity->setUpdateDate(date("Y-m-d"));
            $activity->setActivityEnclosureId($_POST['postenclosure']);
            $activity->setLikeCount(0);
            $activity->setCommentCoun(0);

            $resulta = $activityBusiness->insert($activity);
            $activityID = $activityBusiness->getActivity();

            $entireWord = strtolower($_POST['title'] . " " . $_POST['description']);
            $entireArray = $tagMaker->makeTags($entireWord, $activityID->getActivityId());

            //inserta todo el arreglo con posibles palabras relacionadas
            $tagBusiness->insert($entireArray);

            $post->setActivityId($activityID->getActivityId());

            $result = $postBusiness->insert($activityID, $post);

            if ($resulta == 1 and $result == 1) {
                header("location: ../view/AdministrativePostView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePostView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePostView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePostView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['postid'])) {
        if (strlen($_POST['postid']) > 0) {

            $postBusiness = new PostBusiness();
            $post = new Post();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $post->setActivityId($_POST['postid']);
            $result = $postBusiness->delete($post);

            $activity->setActivityId($_POST['postid']);
            $resulta = $activityBusiness->delete($activity);

            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativePostView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePostView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePostView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePostView.php?error=empty");
    }
} else if (isset($_POST['update'])) {

    if (isset($_POST['hourAfter']) && isset($_POST['hourBefore']) && isset($_POST['postid']) && isset($_POST['title']) && isset($_POST['description'])) {
        if (strlen($_POST['hourBefore']) > 0 && strlen($_POST['hourAfter']) > 0 && strlen($_POST['postid']) > 0 && strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0) {

            $postBusiness = new PostBusiness();
            $post = new Post();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();


            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setActivityId($_POST['postid']);
            $activity->setDayAfther($_POST['hourAfter']);
            $activity->setDayBefore($_POST['hourBefore']);

            $resulta = $activityBusiness->update($activity);

            $post->setActivityId($_POST['postid']);


            $result = $postBusiness->update($post);

            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativePostView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePostView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePostView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePostView.php?error=empty");
    }
}

class PostBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/PostData.php';
        $this->data = new PostData();
    }

//End construct

    function insert(Activity $activ, Post $post) {
        return $this->data->insert($activ, $post);
    }

//End insert

    function delete(Post $post) {
        return $this->data->delete($post);
    }

//End delete

    function update(Post $post) {
        return $this->data->update($post);
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
