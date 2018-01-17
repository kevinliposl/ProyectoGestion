<?php

require '../domain/University.php';

if (isset($_POST['create'])) {
    if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['hadheadquarter'])) {
        if (strlen($_POST['name']) > 0 && strlen($_POST['type']) > 0 && strlen($_POST['hadheadquarter'])) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityname($_POST['name']);
            $university->setUniversityType($_POST['type']);
            $university->setUniversityhadheadquarter($_POST['hadheadquarter']);
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
} else if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        if (strlen($_POST['id'])) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid($_POST['id']);
            $result = $universityBusiness->delete($university);

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
    if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['headquarter'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['type']) > 0 && strlen($_POST['headquarter']) > 0) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid(0);
            $university->setUniversitycode($_POST['code']);
            $university->setUniversityname($_POST['name']);
            $university->setUniversityType($_POST['type']);
            $university->setUniversityType($_POST['headquarter']);
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
            echo json_encode(array("result"=>"select"));
            return;
        }
    } else {
        echo json_encode(array("result"=>"Error"));
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