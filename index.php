<?php

require_once __DIR__ . '/Foundation/Session.php';
Session::get('idU');

try {
    require_once __DIR__ . '/Control/FrontController.php';
    $frontController = new FrontController();
    $frontController->run();
} catch (Exception $e) {
    require_once __DIR__ . '/View/VErrori.php';
    $vErrori = new VErrori();
    http_response_code(500);
    $vErrori->errore(500, $e->getMessage());
}
?>
