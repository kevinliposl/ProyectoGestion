<?php

require '../domain/Event.php';

if (isset($_POST['create'])) {
    if (isset($_POST['studentname']) && isset($_POST['studentpassword']) && isset($_POST['studentcareer1']) && isset($_POST['studentlicense']) && isset($_POST['studentmail'])) {
        if (strlen($_POST['studentname']) > 0 && strlen($_POST['studentpassword']) > 0 && strlen($_POST['studentlicense']) > 0 && strlen($_POST['studentmail']) > 0) {

            $studentBusiness = new StudentBusiness();
            $student = new Student();

            $student->setStudentlicense($_POST['studentlicense']);
            $student->setStudentmail($_POST['studentmail']);
            $student->setStudentname($_POST['studentname']);
            $student->setStudentlastname1($_POST['studentlastname1']);
            $student->setStudentlastname2($_POST['studentlastname2']);
            $student->setStudentcareer1(intval($_POST['studentcareer1']));
            $student->setStudentcareer2(intval($_POST['studentcareer2']));
            $student->setStudentpassword($_POST['studentpassword']);

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
            $student->setStudentid((int)$_POST['studentid']);
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

class EventBusiness {
    
    //Attributes
    private $data;

    function __construct() {
        include_once '../data/EventData.php';
        $this->data = new EventData();
    }//End construct

    function insert(Event $event) {
        return $this->data->insert($event);
    }//End insert

    function delete(Event $event) {
        return $this->data->delete($event);
    }//End delete

    function update(Event $event) {
        return $this->data->update($event);
    }//End update

    function selectAll() {
        return $this->data->selectAll();
    }//End selectAll
    
}//End class EventBusiness
