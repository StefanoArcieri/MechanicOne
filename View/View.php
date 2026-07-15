<?php
// View/View.php

require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../smarty/src/functions.php';

// autoloader manuale per Smarty: non usiamo composer, quindi le classi Smarty\* le carichiamo a mano dal path
spl_autoload_register(function ($class) {
    if (strpos($class, 'Smarty\\') !== 0) {
        return;
    }

    $relative_class = substr($class, 7); // rimuove "Smarty\"
    $file = __DIR__ . '/../smarty/src/' . str_replace('\\', '/', $relative_class) . '.php';

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

        $this->initializeCommonData();
    }

    protected function initializeCommonData() {
        $this->assignData([
            'isLogged' => !empty(Session::get('idU')),
            'userRole' => Session::get('ruolo'),
            'nomeUtente' => Session::get('nome') ?: ''
        ]);
    }

    protected function assignData(array $data = []) {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this;
    }

    protected function renderTemplate($template, array $data = []) {
        $this->assignData($data);
        $this->smarty->display($template);
    }
}