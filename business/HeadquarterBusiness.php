<?php

require '../domain/Headquarter.php';

if (isset($_POST['create'])) {
    if (isset($_POST['headquartername']) && isset($_POST['headquarteruniversityid'])) {
        if (strlen($_POST['headquartername']) > 0 && strlen($_POST['headquarteruniversityid']) > 0) {
            $headquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $headquarter->setHeadquartername($_POST['headquartername']);
            $headquarter->setHeadquarteruniversityid($_POST['headquarteruniversityid']);
            $result = $headquarterBusiness->insert($headquarter);

            echo json_encode(array("result" => $result));
        } else {
            echo json_encode(array("result" => "format"));
        }
    } else {
        echo json_encode(array("result" => "empty"));
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['headquarterid']) && isset($_POST['headquartername'])) {
        if (strlen($_POST['headquarterid']) > 0 && strlen($_POST['headquartername']) > 0) {
            $headquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $headquarter->setHeadquarterid($_POST['headquarterid']);
            $headquarter->setHeadquartername($_POST['headquartername']);

            $result = $headquarterBusiness->update($headquarter);

            if ($result == 1) {
                header("location: ../view/HeadquarterView.php?success=inserted");
            } else {
                header("location: ../view/HeadquarterView.php?error=dbError");
            }
        } else {
            header("location: ../view/HeadquarterView.php?error=format");
        }
    } else {
        header("location: ../view/HeadquarterView.php?error=empty");
    }
} else if (isset($_POST['select'])) {
    if (isset($_POST['universityid'])) {
        if (strlen($_POST['universityid']) > 0) {
            $headquarterBusiness = new HeadquarterBusiness;

            $headquarter = new Headquarter();
            $headquarter->setHeadquarteruniversityid($_POST['universityid']);
            $result = $headquarterBusiness->selectbyUniversity($headquarter);
            echo json_encode($result);
        } else {
            echo json_encode(array("result" => "format"));
        }
    } else {
        echo json_encode(array("result" => "empty"));
    }
}

class HeadquarterBusiness {

    //Attributes
    private $data;

    /**
     * Construct
     */
    function __construct() {
        include_once '../data/HeadquarterData.php';
        $this->data = new HeadquarterData();
    }

    /**
     * Funcion para insertar Sede
     */
    function insert(Headquarter $headquarter) {
        return $this->data->insert($headquarter);
    }

    /**
     * Funcion para actualizar Sede
     */
    function update(Headquarter $headquarter) {
        return $this->data->update($headquarter);
    }

    /**
     * Funcion para seleccionar sedes
     */
    function selectAll() {
        return $this->data->selectAll();
    }

    /**
     * Funcion para seleccionar una sede 
     */
    function selectbyUniversity(Headquarter $headquarter) {
        return $this->data->selectbyUniversity($headquarter);
    }

    /**
     * Funcion para seleccionar una sede 
     */
    function select($headquarterCode) {
        return $this->data->select($headquarterCode);
    }

    /**
     *  Funcion para eliminar una sede 
     */
    function delete(Headquarter $headquarter) {
        return $this->data->delete($headquarter);
    }

//End class HeadquarterBusiness
}
