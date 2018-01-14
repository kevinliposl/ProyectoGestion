<?php

require '../domain/Headquarter.php';

if (isset($_POST['create'])) {
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
                header("location: ../view/HeadquarterView.php?success=inserted");
            } else {
                header("location: ../view/HeadquarterView.php?error=dbError");
            }
        } else {
            header("location: ../view/HeadquarterView.php?error=format");
        }
    } else {
        header("location: ../view/HeadquarterView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['id'])) {
        if (strlen($_POST['id']) > 0) {
            $haedquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $result = $haedquarterBusiness->delete($headquarter);

            if ($result == 1) {
                header("location: ../view/HeadquarterView.php?success=inserted");
            } else {
                header("location: ../view/HeadquarterView.php?error=dbError");
            }
        } else {
            header("location: ../view/HeadquarterView.php?error=format");
        }
    } else {
        header("location: ../view/HeadquarterView.php?error=empty");
    }
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
//                header("location: ../view/HeadquarterView.php?success=inserted");
            } else {
//                header("location: ../view/HeadquarterView.php?error=dbError");
            }
        } else {
//            header("location: ../view/HeadquarterView.php?error=format");
        }
    } else {
//        header("location: ../view/HeadquarterView.php?error=empty");
    }
}

class HeadquarterBusiness {

    //Attributes
    private $headquarterData;

    function __construct() {
        include_once '../data/Headquarter.php';
        $this->headquarterData = new HeadquarterData();
    }

//End construct()

    function insert(Headquarter $headquarter) {
        return $this->headquarterData->insert($headquarter);
    }

//End insert()

    function update(Headquarter $headquarter) {
        return $this->headquarterData->update($headquarter);
    }

//End update()

    function selectAll() {
        return $this->headquarterData->selectAll();
    }

//End selectAll()

    function select($headquarterCode) {
        return $this->headquarterData->select($headquarterCode);
    }

//End select()

    function delete(Headquarter $headquarter) {
        return $this->headquarterData->delete($headquarter);
    }

//End delete()
}

//End class HeadquarterBusiness
