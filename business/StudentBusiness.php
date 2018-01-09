<?php

if (isset($_POST['create'])) {
    $studentBusiness = new StudentBusiness();
    include_once '../domain/Student.php';
    $student = new Student();
    
    $result = $studentBusiness->insert($student);
    //echo json_encode($result);///SOLO SI SE USA CON AJAX
    //header("location: ../view/bullView.php?success=updated");///SOLO SI NO SE USA CON AJAX
    
} else if (isset($_POST['delete'])) {
    $studentBusiness = new StudentBusiness();
    include_once '../domain/Student.php';
    $student = new Student();
    
    $result = $studentBusiness->delete($student);
    
} else if (isset($_POST['select'])) {
    $studentBusiness = new StudentBusiness();
    include_once '../domain/Student.php';
    $student = new Student();
    
    $result = $studentBusiness->select($student);
    
}else if (isset($_POST['update'])) {
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
