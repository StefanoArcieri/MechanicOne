<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EVeicolo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VVeicolo.php';

class CAggiungiveicolo {

    public function nuovo($params = []) {
        $view = new VVeicolo();
        $view->mostraFormAggiungi();
    }

    public function aggiungiVeicolo() {
        $idU = Session::get('idU');
        $targa = trim(Request::post('targa', ''));
        $marca = trim(Request::post('marca', ''));
        $modello = trim(Request::post('modello', ''));

        try {
            if ($targa === '' || $marca === '' || $modello === '') {
                throw new Exception("Compila tutti i campi del veicolo.");
            }

            $pm = PersistentManager::getInstance();

            if ($pm->load('EVeicolo', 'targa', strtoupper($targa))) {
                throw new Exception("Questo veicolo è già registrato nel sistema.");
            }

            $nuovoVeicolo = new EVeicolo(null, strtoupper($targa), $marca, $modello, $idU);

            if (!$pm->store($nuovoVeicolo)) {
                throw new Exception("Errore tecnico durante il salvataggio del veicolo.");
            }
        } catch (Exception $e) {
            (new VVeicolo())->mostraFormAggiungi($e->getMessage());
            return;
        }

        header('Location: /MechanicOne/garage/lista?msg=veicolo_aggiunto');
        exit();
    }
}
?>
