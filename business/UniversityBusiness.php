<?php

require '../domain/University.php';

if (isset($_POST['create'])) {
    if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['headquarter'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['type']) > 0 && strlen($_POST['headquarter']) > 0) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid(0);
            $university->setUniversitycode($_POST['code']);
            $university->setUniversityname($_POST['name']);
            $university->setUniversityType($_POST['type']);
            $university->setUniversityType($_POST['headquarter']);
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
}

class UniversityBusiness {

    //Attributes
    private $universityData;

    function __construct() {
        include_once '../data/UniversityData.php';
        $this->universityData = new UniversityData();
    }//End construct()

    function insert(University $university) {
        return $this->universityData->insert($university);
    }/* End insert() */

    function update(University $university) {
        return $this->universityData->update($university);
    }//End update()

    function selectAll() {
        return $this->universityData->selectAll();
    }//End selectAll()

    function select($universityCode) {
        return $this->universityData->select($universityCode);
    }//End select()

    function delete(University $university) {
        return $this->universityData->delete($university);
    }//End delete()
}//End class UniversityBusiness 