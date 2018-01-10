<?php

class StudentController {

    function __construct() {
        $this->view = new View();
    }

    /**
     * @return null
     * @param integer $id Identificador de entidad
     * Funcion para insertar estudiante
     */
    function insert() {
        if (isset($_POST["id"]) && isset($_POST["email"])) {
            require 'model/StudentModel.php';
            $model = new StudentModel();
            $result = $model->insertStudent($_POST["id"], $_POST["name"], $_POST["lastname1"], $_POST["lastname2"]);
            echo json_encode($result);
        } else {
            $file = file_get_contents("libs/nationalities.json");
            $this->view->show("insertStudentView.php", json_decode($file, true));
        }
    }

    /**
     * @return null
     * @param integer $id Identificador de entidad
     * Funcion para eliminar estudiante
     */
    function delete() {
        require 'model/StudentModel.php';
        if (!isset($_POST["id"]) && !isset($_POST["email"])) {
            $model = new StudentModel();
            $result = $model->selectAllStudent();
            $this->view->show("deleteStudentView.php", $result);
        } else {
            $model = new StudentModel();
            $result = $model->deleteStudent($_POST['id']);
            echo json_encode($result);
        }
    }

    /**
     * @return null
     * @param integer $id Identificador de entidad
     * @param string $email Email de entidad
     * @param string $name Nombre de entidad
     * @param string $firstLastName Apellido de entidad
     * @param string $secondLastName Apellido de entidad
     * Funcion para actualizar estudiante
     */
    function update() {
        require 'model/StudentModel.php';
        if (!isset($_POST["id"]) && !isset($_POST["email"])) {
            $model = new StudentModel();
            $result = $model->selectAllStudent();
            $this->view->show("updateStudentView.php", $result);
        } else {
            $model = new StudentModel();
            $result = $model->updateStudent($_POST["id"], $_POST["name"], $_POST["lastname1"], $_POST["lastname2"]);
            echo json_encode($result);
        }
    }

    /**
     * @return null
     * @param integer $id Identificador de entidad
     * Funcion para seleccionar estudiante
     */
    function select() {
        if (isset($_POST["id"])) {
            require 'model/StudentModel.php';
            $model = new StudentModel();
            $result = $model->selectStudent($_POST["id"]);
            echo json_encode($result);
        } else {
            $result = 0;
            echo json_encode($result);
        }
    }

}
