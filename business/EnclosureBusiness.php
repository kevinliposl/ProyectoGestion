<?php

require '../domain/Enclosure.php';

if (isset($_POST['create'])) {
    if ($_POST['action'] == "only") {
        if (isset($_POST['name']) && isset($_POST['universityid'])) {
            if (strlen($_POST['name']) > 0 && strlen($_POST['universityid']) > 0) {
                $enclosureBusiness = new EnclosureBusiness();

                $enclosure = new Enclosure();
                $enclosure->setEnclosurename($_POST['name']);
                $enclosure->setEnclosureuniversityid($_POST['universityid']);
                $result = $enclosureBusiness->insertOnly($enclosure);

                echo json_encode(array("result" => $result));
            } else {
                echo json_encode(array("result" => -1));
            }
        } else {
            echo json_encode(array("result" => -2));
        }
    } else {
        if (isset($_POST['enclosurename']) && isset($_POST['universityid']) && isset($_POST['headquarterid'])) {
            if (strlen($_POST['enclosurename']) > 0 && strlen($_POST['universityid']) > 0 && strlen($_POST['headquarterid']) > 0) {
                $enclosureBusiness = new EnclosureBusiness();
                $enclosure = new Enclosure();
                $enclosure->setEnclosurename($_POST['enclosurename']);
                $enclosure->setEnclosureuniversityid($_POST['universityid']);
                $enclosure->setEnclosureheadquarterid($_POST['headquarterid']);
                $result = $enclosureBusiness->insert($enclosure);

                echo json_encode(array("result" => $result)); //error or success
            } else {
                echo json_encode(array("result" => -1)); //format
            }
        } else {
            echo json_encode(array("result" => -2)); // empty
        }
    }
} else if (isset($_POST['delete'])) {
    if (isset($_POST['enclosureid'])) {
        if (strlen($_POST['enclosureid']) > 0) {
            $enclosureBusiness = new EnclosureBusiness();

            $enclosure = new Enclosure();
            $enclosure->setEnclosureid($_POST['enclosureid']);
            $result = $enclosureBusiness->delete($enclosure);

            if ($result == 1) {
                header("location: ../view/AdministrationInstallationView.php?success=delete");
            } else {
                header("location: ../view/AdministrationInstallationView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrationInstallationView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrationInstallationView.php?error=empty");
    }
} else if (isset($_POST['update'])) {
    if (isset($_POST['enclosureid']) && isset($_POST['enclosurename'])) {
        if (strlen($_POST['enclosureid']) > 0 && strlen($_POST['enclosurename'])) {
            $enclosureBusiness = new EnclosureBusiness();

            $enclosure = new Enclosure();
            $enclosure->setEnclosureid($_POST['enclosureid']);
            $enclosure->setEnclosurename($_POST['enclosurename']);
            $result = $enclosureBusiness->update($enclosure);

            if ($result == 1) {
                header("location: ../view/AdministrationInstallationView.php?success=update");
            } else {
                header("location: ../view/AdministrationInstallationView.php?error=dbError");
            }
        } else {
            header("location: ../view/AdministrationInstallationView.php?error=format");
        }
    } else {
        header("location: ../view/AdministrationInstallationView.php?error=empty");
    }
}

class EnclosureBusiness {

    //Attributes
    private $data;

    function __construct() {
        include_once '../data/EnclosureData.php';
        $this->data = new EnclosureData();
    }

    /**
     * Insertar recinto sin sede
     */
    function insertOnly(Enclosure $enclosure) {
        return $this->data->insertOnly($enclosure);
    }

    /**
     * Insertar recinto con sede
     */
    function insert(Enclosure $enclosure) {
        return $this->data->insert($enclosure);
    }

    /**
     * Actualizar recinto
     */
    function update(Enclosure $enclosure) {
        return $this->data->update($enclosure);
    }

    /**
     * Seleccionar recintos
     */
    function selectAll() {
        return $this->data->selectAll();
    }

    /**
     * Seleccionar un recinto
     */
    function select(Enclosure $enclosure) {
        return $this->data->select($enclosure);
    }

    /**
     * Seleccionar un recinto
     */
    function selectAllByUniversity() {
        return $this->data->selectEnclosurexHeadquarter();
    }

    /**
     * Eliminar un recinto
     */
    function delete(Enclosure $enclosure) {
        return $this->data->delete($enclosure);
    }

//End class HeadquarterBusiness
}
