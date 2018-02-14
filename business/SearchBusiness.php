<?php

require '../domain/Event.php';
require '../domain/Publication.php';
require '../domain/Search.php';

if (isset($_POST['create'])) {
    $searchBusiness = new SearchBusiness;
    $search = new Search;

    $search->setTypeActivity(isset($_POST['typeActivity']) ? $_POST['typeActivity'] : NULL);
    $search->setSearchGeneral(isset($_POST['searchGeneral']) ? explode(' ', $_POST['searchGeneral']) : NULL);
    $search->setSearchData(isset($_POST['searchData']) ? $_POST['searchData'] : NULL);
    $search->setSearchPlays(isset($_POST['searchPlays']) ? $_POST['searchPlays'] : NULL);
    $search->setSearchActor(isset($_POST['searchActor']) ? $_POST['searchActor'] : NULL);

    $searchBusiness->startSearch($search);

    if ($result == 1) {
        header("location: ../view/SearchView.php?success=inserted");
    } else {
        header("location: ../view/SearchView.php?error=dbError");
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
    function startSearch(Search $search) {
        return $this->data->startSearch($search);
    }

//End class CareerBusiness 
}
