<?php

require '../domain/Administrative.php';

if (isset($_POST['create'])) {
    if (isset($_POST['administrativelicense']) && isset($_POST['administrativemail']) && isset($_POST['administrativename']) && isset($_POST['administrativelastname1']) &&
            isset($_POST['administrativelastname2']) && isset($_POST['administrativearea']) && isset($_POST['administrativepassword'])) {
        if (strlen($_POST['administrativelicense']) > 0 && strlen($_POST['administrativemail']) > 0 && strlen($_POST['administrativename']) > 0 && strlen($_POST['administrativelastname1']) > 0 && strlen($_POST['administrativelastname2']) > 0 && strlen($_POST['administrativearea']) > 0 &&
                strlen($_POST['administrativepassword']) > 0 && filter_var($_POST['administrativemail'], FILTER_VALIDATE_EMAIL)) {

            $administrativeBusiness = new AdministrativeBusiness;
            $administrative = new Administrative;

            $administrative->setAdministrativelicense($_POST['administrativelicense']);
            $administrative->setAdministrativemail($_POST['administrativemail']);
            $administrative->setAdministrativename($_POST['administrativename']);
            $administrative->setAdministrativelastname1($_POST['administrativelastname1']);
            $administrative->setAdministrativelastname2($_POST['administrativelastname2']);
            $administrative->setAdministrativearea($_POST['administrativearea']);
            $administrative->setAdministrativepassword($_POST['administrativepassword']);

            //$result = $administrativeBusiness->insert($administrative);

            if ($result == 1) {
                header("location: ../view/AdministrativeView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['studentid'])) {
        if (strlen($_POST['studentid']) > 0) {

            $studentBusiness = new StudentBusiness();

            $student = new Student();
            $student->setStudentid($_POST['studentid']);
            $result = $studentBusiness->delete($student);

            if ($result == 1) {
                header("location: ../view/AdministrativeView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeView.php?error=empty");
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
            //$student->setStudentcareer1((int)$_POST['studentcareer1']);
            //$student->setStudentcareer2($_POST['studentcareer2']);
            $student->setStudentpassword($_POST['studentpassword']);

            $result = $studentBusiness->update($student);

            if ($result == 1) {
                header("location: ../view/AdministrativeView.php?success=inserted");
            } else {
                header("location: ../view/AdministrativeView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrativeView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrativeView.php?error=empty");
    }
}

class AdministrativeBusiness {

    private $data;

    function __construct() {
        include_once '../data/AdministrativeData.php';
        $this->data = new AdministrativeData();
    }

    function insert(Administrative $administrative) {
        return $this->data->insert($administrative);
    }

    function delete(Administrative $administrative) {
        return $this->data->delete($administrative);
    }

    function update(Administrative $administrative) {
        return $this->data->update($administrative);
    }

    function selectAll() {
        return $this->data->selectAll();
    }

}
