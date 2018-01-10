<?php

class IndexController {

    function __construct() {
        $this->view = new View();
    }

    /**
     * @return null
     * Funcion para mostrar index
     */
    function defaultAction() {
        $this->view->show("indexView.php");
    }

    /**
     * @return null
     * Funcion para mostrar 404
     */
    function notFound() {
        $this->view->show("404View.php");
    }

}
