<?php

require '../domain/Headquarter.php';

if (isset($_POST['create'])) {

    
} else if (isset($_POST['delete'])) {

    
} else if (isset($_POST['update'])) {
    if (isset($_POST['id']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['location'])) {
        if (strlen($_POST['id']) > 0 && strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['location']) > 0) {
            $haedquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $headquarter->setHeadquarterid($_POST['id']);
            $headquarter->setHeadquartercode($_POST['code']);
            $headquarter->setHeadquartername($_POST['name']);
            $headquarter->setHeadquarterlocation($_POST['location']);
            $result = $haedquarterBusiness->update($headquarter);

            if ($result == 1) {
//                header("location: ../view/StudentView.php?success=inserted");
            } else {
//                header("location: ../view/StudentView.php?error=dbError");
            }
        } else {
//            header("location: ../view/StudentView.php?error=format");
        }
    } else {
//        header("location: ../view/StudentView.php?error=empty");
    }
}

class HeadquarterBusiness {
    
    //Attributes
    private $headquarterData;
    
    function __construct() {
        include_once '../data/Headquarter.php';
        $this->headquarterData = new HeadquarterData();
    }//End construct()
    
    function insert(Headquarter $headquarter) {
        return $this->headquarterData->insert($headquarter);
    }//End insert()
    
    function update(Headquarter $headquarter) {
        return $this->headquarterData->update($headquarter);
    }//End update()
   
    public function selectAll() {
        return $this->headquarterData->selectAll();
    }//End selectAll()
    
    public function select($headquarterCode) {
        return $this->headquarterData->select($headquarterCode);
    }//End select()
    
    public function delete(Headquarter $headquarter) {
        return $this->headquarterData->delete($headquarter);
    }//End delete()
    
}//End class HeadquarterBusiness
