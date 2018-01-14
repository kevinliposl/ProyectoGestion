<?php

require '../domain/Student.php';

if (isset($_POST['create'])) {
    if (isset($_POST['name']) && isset($_POST['lastname1']) && isset($_POST['lastname2']) && isset($_POST['password']) &&
            isset($_POST['career1']) && isset($_POST['career2']) && isset($_POST['headquarters']) && isset($_POST['carnet'])) {
        if (strlen($_POST['name']) > 0 && strlen($_POST['lastname1']) > 0 && strlen($_POST['lastname2']) > 0 && strlen($_POST['password']) > 0 &&
                strlen($_POST['career1']) > 0 && strlen($_POST['career2']) > 0 && strlen($_POST['headquarters']) > 0 && strlen($_POST['carnet']) > 0) {
            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setCarnet($_POST['carnet']);
            $student->setName($_POST['name']);
            $student->setLastname1($_POST['lastname1']);
            $student->setLastname2($_POST['lastname2']);
            $student->setCareer1($_POST['career1']);
            $student->setCareer2($_POST['career2']);
            $student->setHeadquarters($_POST['headquarters']);
            $student->setPassword($_POST['password']);
            $result = $studentBusiness->insert($student);
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
} else if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        if (strlen($_POST['name']) > 0) {

            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setId($_POST['id']);
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
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['lastname1']) && isset($_POST['lastname2']) && isset($_POST['password']) &&
            isset($_POST['career1']) && isset($_POST['career2']) && isset($_POST['headquarters']) && isset($_POST['carnet'])) {
        if (strlen($_POST['id']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['lastname1']) > 0 && strlen($_POST['lastname2']) > 0 &&
                strlen($_POST['password']) > 0 && strlen($_POST['career1']) > 0 && strlen($_POST['career2']) > 0 && strlen($_POST['headquarters']) > 0 && strlen($_POST['carnet']) > 0) {
            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setId($_POST['id']);
            $student->setCarnet($_POST['carnet']);
            $student->setName($_POST['name']);
            $student->setLastname1($_POST['lastname1']);
            $student->setLastname2($_POST['lastname2']);
            $student->setCareer1($_POST['career1']);
            $student->setCareer2($_POST['career2']);
            $student->setHeadquarters($_POST['headquarters']);
            $student->setPassword($_POST['password']);
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
        require '../data/StudentData.php';
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
