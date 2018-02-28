<?php

require '../domain/Event.php';
require '../domain/Publication.php';
require '../domain/Search.php';

if (isset($_POST['selectEvent'])) {
    $searchBusiness = new SearchBusiness;
    $search = new Search;

    $search->setTypeActivity('post');
    $search->setSearchGeneral(isset($_POST['searchGeneral']) ? explode(' ', $_POST['searchGeneral']) : NULL);
    $search->setSearchDate(isset($_POST['searchDate']) ? $_POST['searchDate'] : NULL);
    $search->setSearchPlace(isset($_POST['searchPlace']) ? $_POST['searchPlace'] : NULL);
    $search->setSearchHour(isset($_POST['searchHour']) ? $_POST['searchHour'] : NULL);
    $result = $searchBusiness->selectEvent($search);
    echo json_encode(array('result' => $result));
}

if (isset($_POST['selectPost'])) {
    $searchBusiness = new SearchBusiness;
    $search = new Search;

    $search->setTypeActivity('post');
    $search->setSearchGeneral(isset($_POST['searchGeneral']) ? explode(' ', $_POST['searchGeneral']) : NULL);
    $search->setSearchDate(isset($_POST['searchDate']) ? $_POST['searchDate'] : NULL);
    $result = $searchBusiness->selectPost($search);

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
     * Funcion para buscar eventos
     */
    function selectEvent(Search $search) {
        return $this->data->selectEvent($search);
    }

    /**
     * Funcion para buscar post
     */
    function selectPost(Search $search) {
        return $this->data->selectPost($search);
    }

//End class SearchBusiness 
}
