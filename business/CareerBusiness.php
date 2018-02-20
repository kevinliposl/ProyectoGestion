<?php

require '../domain/Career.php';

if (isset($_POST['create'])) {
    if (isset($_POST['careercode'])) {
        if (strlen($_POST['careercode']) > 0) {

            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareercode($_POST['careercode']);
            $Career->setCareername($_POST['careername']);
            $Career->setCareergrade($_POST['careergrade']);
            $Career->setCareerenclosureid($_POST['careerenclosure']);
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
    if (isset($_POST['careerid'])) {
        if (strlen($_POST['careerid']) > 0) {
            $CareerBusiness = new CareerBusiness();

            $Career = new Career();
            $Career->setCareerid($_POST['careerid']);
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
    if (isset($_POST['careercode']) && isset($_POST['careername']) && isset($_POST['careerid']) && isset($_POST['careergrade'])) {
        if (strlen($_POST['careercode']) > 0 && strlen($_POST['careername']) > 0 && strlen($_POST['careerid']) > 0 && strlen($_POST['careergrade']) > 0) {
            $careerBusiness = new CareerBusiness();

            $career = new Career();
            $career->setCareerid($_POST['careerid']);
            $career->setCareergrade($_POST['careergrade']);
            $career->setCareercode($_POST['careercode']);
            $career->setCareername($_POST['careername']);
            $result = $careerBusiness->update($career);

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

    /**
     * Contructor de Clase
     */
    function __construct() {
        include_once '../data/CareerData.php';
        $this->data = new CareerData();
    }

    /**
     * Funcion para insertar la carrera
     */
    function insert(Career $career) {
        return $this->data->insert($career);
    }

    /**
     * Funcion para actualizar la carrera 
     */
    function update(Career $career) {
        return $this->data->update($career);
    }

    /**
     * Funcion para seleccionar todas las carreras activas 
     */
    function selectAll() {
        return $this->data->selectAll();
    }

    /**
     * Funcion para seleccionar todas las carreras activas 
     */
    function selectAllNames() {
        return $this->data->selectAllNames();
    }

    /**
     * Funcion para seleccionar una carrera especifica
     */
    function select($careerCode) {
        return $this->data->select($careerCode);
    }

    /**
     * Funcion para desactivar una carrera
     */
    function delete(Career $career) {
        return $this->data->delete($career);
    }

    /**
     * Funcion para seleccionar las carreras por universidad 
     */
    function selectAllByUniversity() {
        return $this->data->selectByUniversity();
    }

    function selectByEnclosure() {
        return $this->data->selectByEnclosure();
    }

    

//End class CareerBusiness 
}
