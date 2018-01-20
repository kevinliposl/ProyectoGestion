<?php

require '../domain/Enclosure.php';

if (isset($_POST['create']) && isset($_POST['action'])) {
    if ($_POST['action'] == "only") {
        if (isset($_POST['name']) && isset($_POST['universityid']) && isset($_POST['code']) && isset($_POST['headquaerterid'])) {
            if (strlen($_POST['name']) > 0 && strlen($_POST['universityid']) > 0 && strlen($_POST['code']) > 0 && strlen($_POST['headquaerterid']) > 0) {
                $enclosureBusiness = new EnclosureBusiness();

                $enclosure = new Enclosure();
                $enclosure->setEnclosurename($_POST['name']);
                $enclosure->setEnclosureuniversityid($_POST['universityid']);
                $result = $enclosureBusiness->insert($enclosure);

                echo json_encode(array("result" => $result));
            } else {
                echo json_encode(array("result" => "error"));
            }
        } else {
            echo json_encode(array("result" => "empty"));
        }
    } else {
        
    }
} else if (isset($_POST['delete'])) {
    
} else if (isset($_POST['update'])) {
    
}

class EnclosureBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/EnclosureData.php';
        $this->data = new EnclosureData();
    }

    /**
     * Insertar recinto sin sede
     */
    function insertOnly(Enclosure $enclosure) {
        return $this->data->insertOnly($enclosure);
    }

    /**
     * Insertar recinto con sede
     */
    function insert(Enclosure $enclosure) {
        return $this->data->insert($enclosure);
    }

    /**
     * Actualizar recinto
     */
    function update(Enclosure $enclosure) {
        return $this->data->update($enclosure);
    }

    /**
     * Seleccionar recintos
     */
    function selectAll() {
        return $this->data->selectAll();
    }

    /**
     * Seleccionar un recinto
     */
    function select(Enclosure $enclosure) {
        return $this->data->select($enclosure);
    }

    /**
     * Eliminar un recinto
     */
    function delete(Enclosure $enclosure) {
        return $this->data->delete($enclosure);
    }

//End class HeadquarterBusiness
}
