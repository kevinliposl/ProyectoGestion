<?php

require '../domain/Career.php';

if (isset($_POST['create'])) {
    if (isset($_POST['code']) && isset($_POST['name'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0) {
            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareercode($_POST['code']);
            $Career->setCareername($_POST['name']);
            $result = $CareerBusiness->insert($Career);

            if ($result == 1) {
                header("location: ../view/CareerView.php?success=inserted");
            } else {
                header("location: ../view/CareerView.php?error=dbError");
            }
        } else {
            header("location: ../view/CareerView.php?error=format");
        }
    } else {
        header("location: ../view/CareerView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['code']) && isset($_POST['name'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0) {
            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareercode($_POST['code']);
            $result = $CareerBusiness->delete($Career);

            if ($result == 1) {
                header("location: ../view/CareerView.php?success=inserted");
            } else {
                header("location: ../view/CareerView.php?error=dbError");
            }
        } else {
            header("location: ../view/CareerView.php?error=format");
        }
    } else {
        header("location: ../view/CareerView.php?error=empty");
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['code']) && isset($_POST['name'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0) {
            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareerid(0);
            $Career->setCareercode($_POST['code']);
            $Career->setCareername($_POST['name']);
            $result = $CareerBusiness->update($Career);

            if ($result == 1) {
                header("location: ../view/CareerView.php?success=inserted");
            } else {
                header("location: ../view/CareerView.php?error=dbError");
            }
        } else {
            header("location: ../view/CareerView.php?error=format");
        }
    } else {
        header("location: ../view/CareerView.php?error=empty");
    }
}

class CareerBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/CareerData.php';
        $this->data = new CareerData();
    }//End construct()

    function insert(Career $career) {
        return $this->data->insert($career);
    }//End insert()

    function update(Career $career) {
        return $this->data->update($career);
    }//End update()

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll()

    function select($careerCode) {
        return $this->data->select($careerCode);
    }//End select()

    function delete(Career $career) {
        return $this->data->delete($career);
    }//End delete()
}//End class CareerBusiness 
