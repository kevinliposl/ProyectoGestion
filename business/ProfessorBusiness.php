<?php

require '../domain/Professor.php';

if (isset($_POST['create'])) {
    if (isset($_POST['professormail']) && isset($_POST['professorlicense']) && isset($_POST['professorname']) &&
            isset($_POST['professorlastname1']) && isset($_POST['professorlastname2']) && isset($_POST['professorpassword'])) {
        if (strlen($_POST['professormail']) > 0 && strlen($_POST['professorlicense']) > 0 && strlen($_POST['professorname']) > 0 && strlen($_POST['professorlastname1']) > 0 && strlen($_POST['professorlastname2']) > 0 && strlen($_POST['professorpassword']) > 0) {
            $professorBusiness = new ProfessorBusiness;
            $professor = new Professor;

            $professor->setProfessorid(0);
            $professor->setProfessormail($_POST['professormail']);
            $professor->setProfessorname($_POST['professorname']);
            $professor->setProfessorlastname1($_POST['professorlastname1']);
            $professor->setProfessorlastname2($_POST['professorlastname2']);
            $professor->setProfessorlicense($_POST['professorlicense']);
            $professor->setProfessorpassword($_POST['professorpassword']);

            $result = $professorBusiness->insert($professor);

            if ($result === 1) {
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
        return $this->data->insert($professor);
    }

    function select(Professor $professor) {
        
    }

    function selectAll() {
        return $this->data->selectAll();
    }

    function delete(Professor $professor) {
        
    }

}
