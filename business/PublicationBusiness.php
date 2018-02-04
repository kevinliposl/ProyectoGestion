<?php

require '../domain/Publication.php';
require '../business/ActivityBusiness.php';

if (isset($_POST['create'])) {
    if (isset($_POST['title']) && isset($_POST['description']) ) {
        if (strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0) {

            $eventBusiness = new PublicationBusiness();
            $publication = new Publication();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setCreateDate(date("Y-m-d"));
            $activity->setUpdateDate(date("Y-m-d"));
            $activity->setLikeCount(0);
            $activity->setCommentCoun(0);
            
            $resulta = $activityBusiness->insert($activity);
            $activityID = $activityBusiness->getActivity();
            
            $publication->setActivityId($activityID->getActivityId());
            

            $result = $eventBusiness->insert($activityID,$publication);

            if ($resulta == 1 and $result == 1) {
                header("location: ../view/AdministrativePublicationView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePublicationView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePublicationView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePublicationView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['publicationid'])) {
        if (strlen($_POST['publicationid']) > 0) {

            $eventBusiness = new PublicationBusiness();
            $publication = new Publication();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            $publication->setActivityId($_POST['publicationid']);
            $result = $eventBusiness->delete($publication);
            
            $activity->setActivityId($_POST['publicationid']);
            $resulta = $activityBusiness->delete($activity);

            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativePublicationView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePublicationView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePublicationView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePublicationView.php?error=empty");
    }
} else if (isset($_POST['update'])) {

    if (isset($_POST['publicationid']) && isset($_POST['title']) && isset($_POST['description']) ) {
        if (strlen($_POST['publicationid']) > 0 && strlen($_POST['title']) > 0 && strlen($_POST['description']) > 0 ) {
            
            $eventBusiness = new PublicationBusiness();
            $publication = new Publication();
            $activityBusiness = new ActivityBusiness();
            $activity = new Activity();

            
            $activity->setActivityTitle($_POST['title']);
            $activity->setActivityDescription($_POST['description']);
            $activity->setActivityId($_POST['publicationid']);
            
            $resulta = $activityBusiness->update($activity);
            
            $publication->setActivityId($_POST['publicationid']);
            
            $result = $eventBusiness->update($publication);
            
            if ($result == 1 and $resulta == 1) {
                header("location: ../view/AdministrativePublicationView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativePublicationView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativePublicationView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativePublicationView.php?error=empty");
    }
}

class PublicationBusiness {
    
    //Attributes
    private $data;

    function __construct() {
        include_once '../data/PublicationData.php';
        $this->data = new PublicationData();
    }//End construct

    function insert(Activity $activ, Publication $publication) {
        return $this->data->insert($activ,$publication);
    }//End insert

    function delete(Publication $publication) {
        return $this->data->delete($publication);
    }//End delete

    function update(Publication $publication) {
        return $this->data->update($publication);
    }//End update

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll
    
    function selectAllTotal() {
        return $this->data->selectAllTotal();
    }//End selectAllTotal
    
}//End class PublicationBusiness
