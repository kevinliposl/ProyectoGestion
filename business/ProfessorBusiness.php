<?php

require '../domain/Professor.php';

if (isset($_POST['create'])) {
    if ($_POST['action'] == "only") {
        if (isset($_POST['name']) && isset($_POST['universityid'])) {
            if (strlen($_POST['name']) > 0 && strlen($_POST['universityid']) > 0) {

                echo json_encode(array("result" => $result));
            } else {
                echo json_encode(array("result" => -1));
            }
        } else {
            echo json_encode(array("result" => -2));
        }
    } else {
        if (isset($_POST['enclosurename']) && isset($_POST['universityid']) && isset($_POST['headquarterid'])) {
            if (strlen($_POST['enclosurename']) > 0 && strlen($_POST['universityid']) > 0 && strlen($_POST['headquarterid']) > 0) {
                $enclosureBusiness = new EnclosureBusiness();
                $enclosure = new Enclosure();
                $enclosure->setEnclosurename($_POST['enclosurename']);
                $enclosure->setEnclosureuniversityid($_POST['universityid']);
                $enclosure->setEnclosureheadquarterid($_POST['headquarterid']);
                $result = $enclosureBusiness->insert($enclosure);

                echo json_encode(array("result" => $result)); //error or success
            } else {
                echo json_encode(array("result" => -1)); //format
            }
        } else {
            echo json_encode(array("result" => -2)); // empty
        }
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['enclosureid'])) {
        if (strlen($_POST['enclosureid']) > 0) {
            $enclosureBusiness = new EnclosureBusiness();

            $enclosure = new Enclosure();
            $enclosure->setEnclosureid($_POST['enclosureid']);
            $result = $enclosureBusiness->delete($enclosure);

            echo json_encode(array("result" => $result));
        } else {
            echo json_encode(array("result" => "error"));
        }
    } else {
        echo json_encode(array("result" => "empty"));
    }
} else if (isset($_POST['update'])) {
    
}


class ProfessorBusiness {

    private $data;

    function __construct() {
        ;
    }

    function insert(Professor $professor) {
        
    }

    function select(Professor $professor) {
        
    }

    function selectAll() {
        
    }

    function delete(Professor $professor) {
        
    }

}
