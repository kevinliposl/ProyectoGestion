<?php

require '../domain/Event.php';
require '../domain/Publication.php';

if (isset($_POST['create'])) {
    if (isset($_POST[''])) {
        if (strlen($_POST['']) > 0) {


            if ($result == 1) {
                header("location: ../view/SearchView.php?success=inserted");
            } else {
                header("location: ../view/SearchView.php?error=dbError");
            }
        } else {
            header("location: ../view/SearchView.php?error=format");
        }
    } else {
        header("location: ../view/SearchView.php?error=empty");
    }
}

class SearchBusiness {

    //Attributes
    private $data;

    /**
     * Contructor de Clase
     */
    function __construct() {
        include_once '../data/SearchData.php';
        $this->data = new SearchData();
    }

    /**
     * Funcion para insertar la carrera
     */
    function searchGeneral() {
        return $this->data->searchGeneral();
    }

    /**
     * Funcion para actualizar la carrera 
     */
    function searchForDate() {
        return $this->data->searchForDate();
    }

    /**
     * Funcion para seleccionar todas las carreras activas 
     */
    function searchForActor() {
        return $this->data->searchForActor();
    }

    /**
     * Funcion para seleccionar todas las carreras activas 
     */
    function searchForPlays() {
        return $this->data->searchForPlays();
    }

//End class CareerBusiness 
}
