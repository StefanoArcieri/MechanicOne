<?php

require_once __DIR__ . '/Foundation/Session.php';
Session::get('idU'); 

require_once __DIR__ . '/Control/FrontController.php';

$frontController = new FrontController();
$frontController->run();
?>