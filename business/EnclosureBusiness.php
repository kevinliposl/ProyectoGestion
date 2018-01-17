<?php

require '../domain/Enclosure.php';

if (isset($_POST['create'])) {
    if (isset($_POST['name']) && isset($_POST['universityid']) && isset($_POST['code']) && isset($_POST['headquaerterid'])) {
        if (strlen($_POST['name']) > 0 && strlen($_POST['universityid']) > 0 && strlen($_POST['code']) > 0 && strlen($_POST['headquaerterid']) > 0) {
            $enclosureBusiness = new EnclosureBusiness();

            $enclosure = new Enclosure();
            $enclosure->setEnclosurename($_POST['name']);
            $enclosure->setEnclosureuniversityid($_POST['universityid']);
            $enclosure->setEnclosurecode($_POST['code']);
            $enclosure->setEnclosureheadquarterid($_POST['headquaerterid']);
            $result = $enclosureBusiness->insert($enclosure);

            if ($result == 1) {
                header("location: ../view/EnclosureView.php?success=inserted");
            } else {
                header("location: ../view/EnclosureView.php?error=dbError");
            }
        } else {
            header("location: ../view/EnclosureView.php?error=format");
        }
    } else {
        header("location: ../view/EnclosureView.php?error=empty");
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['code'])) {
        if (strlen($_POST['code']) > 0) {
            $haedquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $headquarter->setHeadquartercode($_POST['code']);
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
    if (isset($_POST['code']) && isset($_POST['name']) && isset($_POST['location']) && isset($_POST['universityid'])) {
        if (strlen($_POST['code']) > 0 && strlen($_POST['name']) > 0 && strlen($_POST['location']) > 0 && strlen($_POST['universityid']) > 0) {
            $haedquarterBusiness = new HeadquarterBusiness();

            $headquarter = new Headquarter();
            $headquarter->setHeadquartercode($_POST['code']);
            $headquarter->setHeadquartername($_POST['name']);
            $headquarter->setHeadquarterlocation($_POST['location']);
            $headquarter->setHeadquarteruniversityid($_POST['universityid']);
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
}

class EnclosureBusiness {

    //Attributes
    private $enclosureData;

    function __construct() {
        include_once '../data/EnclosureData.php';
        $this->enclosureData = new EnclosureData();
    }

//End construct()

    function insert(Headquarter $headquarter) {
        return $this->enclosureData->insert($headquarter);
    }

//End insert()

    function update(Headquarter $headquarter) {
        return $this->enclosureData->update($headquarter);
    }

//End update()

    function selectAll() {
        return $this->enclosureData->selectAll();
    }

//End selectAll()

    function select($headquarterCode) {
        return $this->enclosureData->select($headquarterCode);
    }

//End select()

    function delete(Headquarter $headquarter) {
        return $this->enclosureData->delete($headquarter);
    }

//End delete()
}

//End class HeadquarterBusiness
