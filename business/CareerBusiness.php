<?php

require '../domain/Career.php';

if (isset($_POST['create'])) {

    
} else if (isset($_POST['delete'])) {

    
} else if (isset($_POST['update'])) {
    if (isset($_POST['id']) && isset($_POST['code']) && isset($_POST['name'])) {
        if (strlen($_POST['id']) > 0 && strlen($_POST['code']) > 0 && strlen($_POST['name'])) {
            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareerid($_POST['id']);
            $Career->setCareercode($_POST['code']);
            $Career->setCareername($_POST['name']);
            $result = $CareerBusiness->update($Career);

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

class CareerBusiness {
    
    //Attributes
    private $CareerData;
    
    function __construct() {
        include_once '../data/CareerData.php';
        $this->CareerData = new CareerData();
    }//End construct()
    
    function insert(Career $career) {
        return $this->CareerData->insert($career);
    }//End insert()
    
    function update(Career $career) {
        return $this->CareerData->update($career);
    }//End update()
    
    public function selectAll() {
        return $this->CareerData->selectAll();
    }//End selectAll()
    
    public function select($careerCode) {
        return $this->CareerData->select($careerCode);
    }//End select()
    
    public function delete(Career $career) {
        return $this->CareerData->delete($career);
    }//End delete()
    
}//End class CareerBusiness 
