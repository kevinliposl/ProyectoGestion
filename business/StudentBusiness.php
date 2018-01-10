<?php


if (isset($_POST['create'])) {
    if (isset($_POST['name']) && isset($_POST['lastname1']) && isset($_POST['lastname2']) && isset($_POST['career1']) && isset($_POST['career2']) && isset($_POST['headquarters'])) {
        $studentBusiness = new StudentBusiness();
        include_once '../domain/Student.php';
        $student = new Student(0, $_POST['name'], $_POST['lastname1'], $_POST['lastname2'], $_POST['career1'], $_POST['career2'], $_POST['headquarters']);
        //$result = $studentBusiness->insert($student);
        $result = 'Success';//$student->__get('name');
        echo json_encode(array("result" => $result));
    } else {
        echo json_encode(array("result" => "Campos Vacios"));
    }////////////////Faltan validaciones
} else if (isset($_POST['delete'])) {
    if (isset($_POST['mail'])) {
        $studentBusiness = new StudentBusiness();
        include_once '../domain/Student.php';
        $student = new Student(0, $_POST['mail'],'','','','','','');
        //$result = $studentBusiness->delete($student);    
        echo json_encode(array("result" => $result));
    } else {
        echo json_encode(array("result" => "Campos Vacios"));
    }////////////////Faltan validaciones
} else if (isset($_POST['select'])) {
    $studentBusiness = new StudentBusiness();
    include_once '../domain/Student.php';
    $student = new Student();

    $result = $studentBusiness->select($student);
} else if (isset($_POST['update'])) {
    $studentBusiness = new StudentBusiness();
    include_once '../domain/Student.php';
    $student = new Student();

    $result = $studentBusiness->update($student);
}

class StudentBusiness {

    private $studentData;

    function __construct() {
        include_once '../data/StudentData.php';
        $this->studentData = new StudentData();
    }

    function insert(Student $student) {
        return $this->studentData->insert($student);
    }

    function update(Student $student) {
        return $this->studentData->update($student);
    }

    function delete(Student $student) {
        return $this->studentData->deleteTBBull($student);
    }

    function selectAll() {
        return $this->studentData->getAllTBBull();
    }

    function select(Student $student) {
        return $this->studentData->select($student);
    }

}
