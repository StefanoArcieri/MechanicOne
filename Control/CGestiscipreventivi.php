<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VGestiscipreventivi.php';

class CGestiscipreventivi {

    public function lista($params = []) {
        $view = new VGestiscipreventivi();
        $errore = '';
        try {
            $preventivi = array_map([$this, 'arricchisci'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $preventivi = [];
        }
        $view->mostraLista($preventivi, $errore);
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPreventivo') ?: [];
    }

    // idV/idS/idU sono solo id: qui aggiungiamo le etichette leggibili per la tabella admin
    private function arricchisci($pEntity) {
        $p = $pEntity->toArray();
        $pm = PersistentManager::getInstance();

        $veicolo = $pm->load('EVeicolo', 'idV', $p['idV']);
        $p['veicoloLabel'] = $veicolo ? $veicolo->getMarca() . ' ' . $veicolo->getModello() . ' (' . $veicolo->getTarga() . ')' : '—';

        $servizio = $pm->load('EServizio', 'idS', $p['idS']);
        $p['servizioLabel'] = $servizio ? $servizio->getTitolo() : '—';

        $cliente = $pm->load('EUtente', 'idU', $p['idU']);
        $p['clienteLabel'] = $cliente ? trim($cliente->getNome() . ' ' . $cliente->getCognome()) : '—';

        return $p;
    }

    public function updateCosto($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $nuovoCosto = Request::post('costo');

        // se il preventivo aveva una proposta di modifica in sospeso, accettandolo la proposta diventa definitiva
        $descrizioneFinale = $prevData->getDescrizioneProposta() ?: $prevData->getDescrizione();

        $preventivoAggiornato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $nuovoCosto, 'accettato', $descrizioneFinale, $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoAggiornato)) {
            throw new Exception("Impossibile salvare il prezzo.");
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_prezzato');
        exit();
    }

    public function rifiuta($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $preventivoRifiutato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), 'rifiutato', $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoRifiutato)) {
            throw new Exception("Impossibile rifiutare il preventivo.");
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_rifiutato');
        exit();
    }

    public function segnaSvolto($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        if ($prevData->getStato() !== 'accettato') {
            throw new Exception("Solo un preventivo accettato può essere segnato come svolto.");
        }

        $preventivoSvolto = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), 'svolto', $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoSvolto)) {
            throw new Exception("Impossibile aggiornare il preventivo.");
        }

        header('Location: /MechanicOne/gestiscipreventivi/lista?msg=preventivo_svolto');
        exit();
    }
}
?>
