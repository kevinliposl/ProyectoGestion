<?php

require '../domain/Professor.php';

if (isset($_POST['create'])) {
    if (isset($_POST['']) && isset($_POST[''])) {
        if (strlen($_POST['']) > 0 && strlen($_POST['']) > 0) {






            if ($result == 1) {
                header("location: ../view/ProfessorView.php?success=inserted");
            } else {
                header("location: ../view/ProfessorView.php?error=dbError");
            }
        } else {
            header("location: ../view/ProfessorView.php?error=format");
        }
    } else {
        header("location: ../view/ProfessorView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST[''])) {
        if (strlen($_POST['']) > 0) {




            echo json_encode(array("result" => $result));
        } else {
            echo json_encode(array("result" => -1));
        }
    } else {
        echo json_encode(array("result" => -2));
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST[''])) {
        if (strlen($_POST['']) > 0) {




            echo json_encode(array("result" => $result));
        } else {
            echo json_encode(array("result" => -1));
        }
    } else {
        echo json_encode(array("result" => -2));
    }
}

class ProfessorBusiness {

    private $data;

    function __construct() {
        include_once '../data/ProfessorData.php';
        $this->data = new ProfessorData();
    }

    function insert(Professor $professor) {
        
    }

    function select(Professor $professor) {
        
    }

    function selectAll() {
        return $this->data->selectAll();
    }

    function delete(Professor $professor) {
        
    }

}
