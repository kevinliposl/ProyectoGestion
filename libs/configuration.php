<?php

require 'libs/Config.php';
$config = Config::singleton();
$config->set('controllerFolder', 'controller/');
$config->set('modelFolder', 'model/');
$config->set('viewFolder', 'view/');

$config->set('dbhost', 'fusionacademiacr.com');
$config->set('dbname', 'fusionac_db_fusionAcademiaMusical');
$config->set('dbuser', 'fusionac_website');
$config->set('dbpass', 'websitefusion.2017.7102.noisufetisbew');
