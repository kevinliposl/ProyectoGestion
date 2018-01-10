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
        if (isset($_POST['name']) && isset($_POST['lastname1']) && isset($_POST['lastname2']) && isset($_POST['password']) &&
                isset($_POST['career1']) && isset($_POST['career2']) && isset($_POST['headquarters'])) {
            require '../model/StudentModel.php';
            require '../public/domain/Student.php';
            $student = new Student(0, $_POST['name'], $_POST['lastname1'], $_POST['lastname2'], $_POST['career1'], $_POST['career2'], $_POST['headquarters'], $_POST['password']);
            $model = new StudentModel();
            $result = $model->insert($student);
            echo json_encode($result);
            //echo json_encode(array('result' => 'Llegue'));
        } else {
            $this->view->show("insertStudentView.php");
        }
    }

    /**
     * @return null
     * @param integer $id Identificador de entidad
     * Funcion para eliminar estudiante
     */
    function delete() {
        require 'model/StudentModel.php';
        if (isset($_POST["id"])) {
            require 'public/domain/Student.php';
            $student = new Student($_POST['id'], '', '', '', '', '', '');
            $model = new StudentModel();
            $result = $model->delete($student);
            echo json_encode($result);
        } else {
            $model = new StudentModel();
            $result = $model->selectAllStudent();
            $this->view->show("deleteStudentView.php", $result);
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
            //$result = $model->selectAllStudent();
            $this->view->show("updateStudentView.php");
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
            $this->view->show("selectStudentView.php");
        }
    }

}
