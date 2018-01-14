<?php

require '../domain/University.php';

if (isset($_POST['create'])) {

    
} else if (isset($_POST['delete'])) {

    
} else if (isset($_POST['update'])) {
    if (isset($_POST['id']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['type'])) {
        if (strlen($_POST['id']) > 0 && strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['type']) > 0) {
            $universityBusiness = new UniversityBusiness();

            $university = new University();
            $university->setUniversityid($_POST['id']);
            $university->setUniversitycode($_POST['code']);
            $university->setUniversityname($_POST['name']);
            $university->setUniversityType($_POST['type']);
            $result = $universityBusiness->update($university);

            if ($result == 1) {
//                header("location: ../view/StudentView.php?success=inserted");
            } else {
//                header("location: ../view/StudentView.php?error=dbError");
            }
        } else {
//            header("location: ../view/StudentView.php?error=format");
        }
    } else {
//        header("location: ../view/StudentView.php?error=empty");
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
    }//End insert()
    
    function update(University $university) {
        return $this->universityData->update($university);
    }//End update()
    
    public function selectAll() {
        return $this->universityData->selectAll();
    }//End selectAll()
    
    public function select($universityCode) {
        return $this->universityData->select($universityCode);
    }//End select()
    
    public function delete(University $university) {
        return $this->universityData->delete($university);
    }//End delete()
    
}//End class UniversityBusiness 
