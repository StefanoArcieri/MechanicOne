<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../Entity/EVeicolo.php';
require_once __DIR__ . '/../View/VVeicolo.php';

class CVeicolo {

    public function lista($params = []) {
        $view = new VVeicolo();
        $errore = '';
        try {
            $veicoli = $this->getVeicoliPersonali();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $veicoli = [];
        }
        $veicoli = array_map(function ($v) { return $v->toArray(); }, $veicoli);
        $view->mostraGarage($veicoli, $errore);
    }

    public function getVeicoliPersonali() {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();
        return $pm->search('EVeicolo', 'idU', $idU) ?: [];
    }

    public function eliminaVeicolo($idV) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $veicolo = $pm->load('EVeicolo', 'idV', $idV);
        if (!$veicolo || $veicolo->getIdUtente() != $idU) {
            throw new Exception("Non puoi eliminare un veicolo che non ti appartiene.");
        }

        if (!$pm->delete('EVeicolo', 'idV', $idV)) {
            throw new Exception("Impossibile eliminare il veicolo.");
        }

        header('Location: /MechanicOne/veicolo/lista?msg=veicolo_eliminato');
        exit();
    }
    
    public function nuovo() {
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
            // la colonna è varchar(7): senza questo controllo una targa più lunga (il campo nel
            // form ha solo un maxlength HTML, aggirabile) verrebbe troncata in silenzio da MySQL
            if (strlen($targa) > 7) {
                throw new Exception("La targa non può superare i 7 caratteri.");
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

        header('Location: /MechanicOne/veicolo/lista?msg=veicolo_aggiunto#veicolo-'.$pm->load('EVeicolo', 'targa', strtoupper($targa))->getIdVeicolo());
        exit();
    }
}
?>
