<?php

require '../domain/Post.php';
require '../domain/Tag.php';
require '../domain/Activity.php';
require '../business/ActivityBusiness.php';
require '../business/TagBusiness.php';
require '../util/TagReference.php';
require '../util/TranslateEToS.php';
require '../util/TranslateSToE.php';

if (isset($_POST['create'])) {
    if (isset($_POST['title']) && isset($_POST['description'])) {
        if (strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0) {

            $postBusiness = new PostBusiness();
            $post = new Post();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();
            $tagBusiness = new TagBusiness();
            $tagReference = new TagReference();
            $translateSToE = new TranslateSToE();
            $translateEToS = new TranslateEToS();
            
            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setCreateDate(date("Y-m-d"));
            $activity->setUpdateDate(date("Y-m-d"));
            $activity->setActivityEnclosureId($_POST['postenclosure']);
            $activity->setLikeCount(0);
            $activity->setCommentCoun(0);

            $resulta = $activityBusiness->insert($activity);
            $activityID = $activityBusiness->getActivity();

            //////
            //separar las palabras del titulo y la descripcion 
            $entireWord = strtolower($_POST['title'] . " " . $_POST['description']);
            $allWords = explode(" ", $entireWord);
            $words = array();

            foreach ($allWords as $word) {
                if (strlen($word) >= 4) {
                    $tag = new Tag();
                    $tag->setTagactivityid($activityID->getActivityId());
                    $tag->setTagword($word);
                    array_push($words, $tag);
                }
            }

            //retorna los sinonimos de las palabra
            $allsynonymous = $tagReference->sendGetSynonymous($words);
            $synonymous = array();

            //relaciona los sinonimos con la actividad
            foreach ($allsynonymous as $synonym) {
                $tag = new Tag();
                $tag->setTagactivityid($activityID->getActivityId());
                $tag->setTagword($synonym);
                array_push($synonymous, $tag);
            }
            //retorna los conceptos de las palabras
            $entireConceptsWords = $tagReference->sendGetConcepts($words);
            $uniteConcepts='';
             
             foreach($entireConceptsWords as $divConcepts){
                 if($uniteConcepts==''){
                     $uniteConcepts = $divConcepts;
                 }else{
                    $uniteConcepts = $uniteConcepts.'- '.$divConcepts." "; 
                 }
                 
             }
            
            //separar y limpiar los conceptos en palabras
             $uniteConcepts = str_replace(',',' ',$uniteConcepts);
             $uniteConcepts = str_replace('.',' ',$uniteConcepts);
             $uniteConcepts = str_replace('-',' ',$uniteConcepts);
             $uniteConcepts = str_replace(':',' ',$uniteConcepts);
             $uniteConcepts = str_replace(';',' ',$uniteConcepts);
            $allConcepts = explode(" ", $uniteConcepts);
          
            $concepts=array();

            foreach($allConcepts as $concept){
                if(strlen($concept) >= 4){
                    //relacionar los conceptos con la actividad
                    $tag = new Tag();
                    $tag->setTagactivityid($activityID->getActivityId());
                    $tag->setTagword($concept);
                    array_push($concepts, $tag);
                }
            }
             
            //arreglo con: palabras, sus sinonimos y sus conceptos
            $entireArray = array_merge($words, $synonymous, $concepts);
            ////
            
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

    if (isset($_POST['hourAfter']) && isset($_POST['hourBefore']) && isset($_POST['postid']) && isset($_POST['title']) && isset($_POST['description']) ){
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
