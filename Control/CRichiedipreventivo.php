<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VPreventivo.php';
require_once __DIR__ . '/CVeicolo.php';
require_once __DIR__ . '/CGestisciservizi.php';

class CRichiedipreventivo {

    public function nuovo($idV = null) {
        $view = new VPreventivo();
        $veicoli = array_map(function ($v) { return $v->toArray(); }, (new CVeicolo())->getVeicoliPersonali());
        $servizi = array_map(function ($s) { return $s->toArray(); }, (new CGestisciservizi())->richiediLista());
        $view->mostraForm($veicoli, $servizi, $idV);
    }

    public function richiedi() {
        $idU = Session::get('idU');
        $idV = Request::post('idV', '');
        $idS = Request::post('idS', '');
        $descrizione = trim(Request::post('descrizione', ''));

        try {
            $pm = PersistentManager::getInstance();

            $veicolo = $pm->load('EVeicolo', 'idV', $idV);
            if (!$veicolo || $veicolo->getIdUtente() != $idU) {
                throw new Exception("Il veicolo selezionato non appartiene al tuo garage.");
            }

            if (!$pm->load('EServizio', 'idS', $idS)) {
                throw new Exception("Il servizio selezionato non è valido.");
            }

            if ($descrizione === '') {
                throw new Exception("Descrivi il problema o l'intervento richiesto.");
            }

            $dataRichiesta = date('Y-m-d H:i:s');
            $nuovoPreventivo = new EPreventivo(
                null, $idU, $idV, $idS, null, 'inviato', $descrizione, null, $dataRichiesta
            );

            $nuovoIdPrev = $pm->store($nuovoPreventivo);
            if (!$nuovoIdPrev) {
                throw new Exception("Problema tecnico durante l'invio della richiesta.");
            }
        } catch (Exception $e) {
            $veicoli = array_map(function ($v) { return $v->toArray(); }, (new CVeicolo())->getVeicoliPersonali());
            $servizi = array_map(function ($s) { return $s->toArray(); }, (new CGestisciservizi())->richiediLista());
            (new VPreventivo())->mostraForm($veicoli, $servizi, $idV, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=preventivo_inviato#preventivo-'.$nuovoIdPrev);
        exit();
    }
}
?>
