<?php
require 'libs/SSession.php';
require 'libs/FrontController.php';
SSession::getInstance();
FrontController::main();
