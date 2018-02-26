<?php

require '../domain/Event.php';
require '../domain/Publication.php';
require '../domain/Search.php';

if (isset($_POST['select'])) {
    $searchBusiness = new SearchBusiness;
    $search = new Search;

    $search->setTypeActivity(isset($_POST['typeActivity']) ? $_POST['typeActivity'] : NULL);
    $search->setSearchHour(isset($_POST['searchHour']) ? $_POST['searchHour'] : NULL);
    $search->setSearchGeneral(isset($_POST['searchGeneral']) ? explode(' ', $_POST['searchGeneral']) : NULL);
    $search->setSearchDate(isset($_POST['searchDate']) ? $_POST['searchDate'] : NULL);
    $search->setSearchPlace(isset($_POST['searchPlace']) ? $_POST['searchPlace'] : NULL);
    $search->setSearchActor(isset($_POST['searchActor']) ? $_POST['searchActor'] : NULL);

    $result = $searchBusiness->select($search);

    echo json_encode(array('result' => $result));
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
    function select(Search $search) {
        return $this->data->select($search);
    }

//End class CareerBusiness 
}
