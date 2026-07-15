<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';

class CGestiscipreventivi {

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPreventivo') ?: [];
    }

    public function updateCosto($idPrev) {
        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $nuovoCosto = $_POST['costo'] ?? null;

        // Se il preventivo veniva accettato con una proposta di modifica in sospeso, la proposta diventa la descrizione definitiva.
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
}
?>
