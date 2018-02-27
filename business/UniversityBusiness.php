<?php

require '../domain/University.php';

if (isset($_POST['create'])) {
    if (isset($_POST['universityname']) && isset($_POST['universitytype']) && isset($_POST['universityhadheadquarter'])) {
        if (strlen($_POST['universityname']) > 0 && strlen($_POST['universitytype']) > 0 && strlen($_POST['universityhadheadquarter'])) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityname($_POST['universityname']);
            $university->setUniversitytype($_POST['universitytype']);
            $university->setUniversityhadheadquarter($_POST['universityhadheadquarter']);
            $result = $universityBusiness->insert($university);

            if ($result == 1) {
                header("location: ../view/UniversityView.php?success=inserted");
            } else {
                header("location: ../view/UniversityView.php?error=dbError");
            }
        } else {
            header("location: ../view/UniversityView.php?error=format");
        }
    } else {
        header("location: ../view/UniversityView.php?error=empty");
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['universityid']) && isset($_POST['universityname']) && isset($_POST['universitytype'])) {
        if (strlen($_POST['universityid']) > 0 && strlen($_POST['universityname']) > 0 && strlen($_POST['universitytype']) > 0) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid($_POST['universityid']);
            $university->setUniversityname($_POST['universityname']);
            $university->setUniversitytype($_POST['universitytype']);
            $university->setUniversityhadheadquarter($_POST['universityhadheadquarter']);
            $result = $universityBusiness->update($university);

            if ($result == 1) {
                header("location: ../view/UniversityView.php?success=inserted");
            } else {
                header("location: ../view/UniversityView.php?error=dbError");
            }
        } else {
            header("location: ../view/UniversityView.php?error=format");
        }
    } else {
        header("location: ../view/UniversityView.php?error=empty");
    }
} else if (isset($_POST['select'])) {
    if (isset($_POST['id'])) {
        if (strlen($_POST['id']) > 0) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid($_POST['id']);
            $result = $universityBusiness->select($university);

            echo json_encode($result);
            //echo json_encode(array("result"=>"select"));
            return;
        } else {
            echo json_encode(array("result" => "select"));
            return;
        }
    } else {
        echo json_encode(array("result" => "Error"));
        return;
    }
}

class UniversityBusiness {

    private $universityData;

    function __construct() {
        include_once '../data/UniversityData.php';
        $this->universityData = new UniversityData();
    }

    function insert(University $university) {
        return $this->universityData->insert($university);
    }

    function update(University $university) {
        return $this->universityData->update($university);
    }

    function selectAll() {
        return $this->universityData->selectAll();
    }

    function select(University $university) {
        return $this->universityData->select($university);
    }

    function delete(University $university) {
        return $this->universityData->delete($university);
    }

}
