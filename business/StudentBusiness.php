<?php

require '../domain/Student.php';
require_once '../util/RandomPassGenerator.php';

if (isset($_POST['create'])) {
    if (isset($_POST['actormail']) && isset($_POST['actorname']) && isset($_POST['actorlastname1']) && isset($_POST['actorlastname2']) && isset($_POST['actorcareer1'])) {
        if (strlen($_POST['actormail']) > 0 && strlen($_POST['actorname']) > 0 && strlen($_POST['actorlastname1']) > 0 && strlen($_POST['actorlastname2']) > 0 &&
                filter_var($_POST['actormail'], FILTER_VALIDATE_EMAIL)) {
            $studentBusiness = new StudentBusiness();
            $student = new Student();

            $student->setStudentmail($_POST['actormail']);
            $student->setStudentname($_POST['actorname']);
            $student->setStudentlastname1($_POST['actorlastname1']);
            $student->setStudentlastname2($_POST['actorlastname2']);
            $student->setStudentcareer1(intval($_POST['actorcareer1']));
            $student->setStudentpassword(RandomPassGenerator::getInstance()->keygen(10));

            $result = $studentBusiness->insert($student);
            
            echo json_encode(array('result' => $result));
        } else {
            echo json_encode(array('result' => -1));
        }
    } else {
        echo json_encode(array('result' => -2));
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['studentid'])) {
        if (strlen($_POST['studentid']) > 0) {

            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setStudentid($_POST['studentid']);
            $result = $studentBusiness->delete($student);

            if ($result == 1) {
                header("location: ../view/StudentView.php?success=inserted");
            } else {
                header("location: ../view/StudentView.php?error=dbError");
            }
        } else {
            header("location: ../view/StudentView.php?error=format");
        }
    } else {
        header("location: ../view/StudentView.php?error=empty");
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['studentid']) && isset($_POST['studentmail']) && isset($_POST['studentpassword']) && isset($_POST['studentcareer1']) && isset($_POST['studentlicense'])) {
        if (strlen($_POST['studentid']) > 0 && strlen($_POST['studentmail']) > 0 && strlen($_POST['studentpassword']) > 0 && strlen($_POST['studentcareer1']) > 0 && strlen($_POST['studentlicense']) > 0) {
            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setStudentid((int) $_POST['studentid']);
            $student->setStudentlicense($_POST['studentlicense']);
            $student->setStudentmail($_POST['studentmail']);
            $student->setStudentname($_POST['studentname']);
            $student->setStudentlastname1($_POST['studentlastname1']);
            $student->setStudentlastname2($_POST['studentlastname2']);
            $student->setStudentcareer1((int) $_POST['studentcareer1']);
            $student->setStudentcareer2((int) $_POST['studentcareer2']);
            $student->setStudentpassword($_POST['studentpassword']);

            $result = $studentBusiness->update($student);

            if ($result == 1) {
                header("location: ../view/StudentView.php?success=inserted");
            } else {
                header("location: ../view/StudentView.php?error=dbError");
            }
        } else {
            header("location: ../view/StudentView.php?error=format");
        }
    } else {
        header("location: ../view/StudentView.php?error=empty");
    }
}

class StudentBusiness {

    private $data;

    function __construct() {
        include_once '../data/StudentData.php';
        $this->data = new StudentData();
    }

    function insert(Student $student) {
        return $this->data->insert($student);
    }

    function delete(Student $student) {
        return $this->data->delete($student);
    }

    function update(Student $student) {
        return $this->data->update($student);
    }

    function selectAll() {
        return $this->data->selectAll();
    }

}
