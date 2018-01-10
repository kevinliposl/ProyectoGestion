<?php

class View {

    function show($nombreVista, $vars = array()) {
        $config = Config::singleton();
        $path = $config->get('viewFolder') . $nombreVista;

        if (is_file($path) == FALSE) {
            header("Location:?action=notFound");
            return FALSE;
        }

        if (is_array($vars)) {
            foreach ($vars as $key => $value) {
                $key = $value;
            }
        }
        include $path;
    }

}
