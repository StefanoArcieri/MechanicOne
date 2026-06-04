<?php
// View/View.php

// 1. Registriamo un autoloader per il namespace "Smarty"
spl_autoload_register(function ($class) {
    // Se la classe non inizia con "Smarty\", ignorala
    if (strpos($class, 'Smarty\\') !== 0) {
        return;
    }

    // Trasformiamo "Smarty\TemplateBase" in un percorso file
    // Sostituiamo il namespace con la cartella src
    $relative_class = substr($class, 7); // Rimuove "Smarty\"
    $file = __DIR__ . '/../smarty/src/' . str_replace('\\', '/', $relative_class) . '.php';

    // Se il file esiste, caricalo
    if (file_exists($file)) {
        require_once $file;
    }
});

use Smarty\Smarty;

class View {
    protected $smarty;

    public function __construct() {
        $this->smarty = new Smarty();
        
        $rootPath = dirname(__DIR__);
        $this->smarty->setTemplateDir($rootPath . '/templates/');
        $this->smarty->setCompileDir($rootPath . '/templates_c/');
        $this->smarty->setCacheDir($rootPath . '/cache/');
        $this->smarty->setConfigDir($rootPath . '/configs/');
    }
}