<?php

include_once 'Connection.php';
include '../domain/student.php';


class StudentData extends Connection {

    function __construct() {
        ;
    }
    
    public function insertStudent($student) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        //get del recinto al que pertenece
        //$queryGetLastId = "SELECT MAX(idEstudiante) AS idtEstudiante  FROM tbEstudiante";
        //$idCont = mysqli_query($conn, $queryGetLastId);
        $idEnclosure = 1;
        
        //estado de la cuenta(activo/inactivo)
        $status = 0;
        
        //Get the last id
        $queryGetLastId = "SELECT MAX(idStudent) AS idStudent  FROM tbStudent";
        $idCont = mysqli_query($conn, $queryGetLastId);
        $nextId = 1;

        if ($row = mysqli_fetch_row($idCont)) {
            $nextId = trim($row[0]) + 1;
        }
        $queryInsert = "INSERT INTO tbStudent VALUES (" . $nextId . ",'" .
                $student->getName() . "','" .
                $student->getLastName1() . "','" .
                $student->getLastName2() . "'," .
                $student->getFirstCareer() . "," .
                $student->getSecondCareer() . "," .
                $status . "," .
                $student->getPassword() . "," .
                $student->getHeadquarters() . ");";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

        public function updateTBEstudiante($student) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        $queryUpdate = "UPDATE tbStudent SET idStudent ='" . $student->getIdStudent() .
                "', name='" . $student->getName() .
                "', lastName1='" . $student->getLastName1() .
                "', lastName2='" . $student->getLastName2() .
                "', firstCareer='" . $student->getFirstCareer() .
                "', secondCareer='" . $student->getSecondCareer() .
                "', idEnclosure='" . $student->getHeadquarters() .
                "', password='" . $student->getPassword() .
                " WHERE idStudent=" . $student->getIdStudent() . ";";

        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function deleteStudent($idStudent) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryUpdate = "UPDATE tbStudent SET status=" . 0 ." WHERE idStudent=". $idStudent .";";
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function getAllStudent() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tbStudent;";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $students = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentStudent = new Student($row['idStudent'], $row['name'], $row['lastName1'], $row['lastName2'], $row['firstCareer'], $row['secondCareer'], $row['headquarters'], $row['password'], $row['status']);
            array_push($students, $currentStudent);
        }
        return $students;
    }
    
    public function getStudent($idStudent) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tbStudent where idStudent=". $idStudent .";";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $students = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentStudent = new Student($row['idStudent'], $row['name'], $row['lastName1'], $row['lastName2'], $row['firstCareer'], $row['secondCareer'], $row['headquarters'], $row['password'], $row['status']);
            array_push($students, $currentStudent);
        }
        return $students;
    }
    
    /**public function getBullsInventary() {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "select tbbull.idtbbull as 'idtbbull', CONCAT(tbbull.namebull, "
                . "' - ', tbbull.codebull) as 'bull', tbbull.strawsquantity as "
                . "'strawsquantity' from tbbull group by tbbull.idtbbull; ";
        $result = mysqli_query($conn, $querySelect);
        
        $bulls = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentBull = array('idtbbull' => $row['idtbbull'], 
                'bull' => $row['bull'], 
                'strawsquantity' => $row['strawsquantity']);
            array_push($bulls, $currentBull);
        }
        
        $newBulls = [];
        foreach ($bulls as $currentBull) {
            $querySelect = "select sum(tbinsemination.strawsquantity) as 'strawsquantity' " .
            "from tbinsemination where bull =" . $currentBull['idtbbull'] . " group by tbinsemination.bull;";
            $result = mysqli_query($conn, $querySelect);
            $row = mysqli_fetch_array($result);
            $quantityStrawsUse = $row[0];
            $currentBull['strawsquantity'] = $currentBull['strawsquantity'] - $quantityStrawsUse;
            array_push($newBulls, $currentBull);
        }
        
        mysqli_close($conn);
        return $newBulls;
        
    }**/

}

