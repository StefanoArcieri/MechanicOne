<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VPreventivo.php';
require_once __DIR__ . '/CGarage.php';
require_once __DIR__ . '/CGestisciservizi.php';

class CRichiedipreventivo {

    public function nuovo($params = []) {
        $view = new VPreventivo();
        $veicoli = (new CGarage())->getVeicoliPersonali();
        $servizi = (new CGestisciservizi())->richiediLista();
        $view->mostraForm($veicoli, $servizi);
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

            if ($descrizione === '') {
                throw new Exception("Descrivi il problema o l'intervento richiesto.");
            }

            $nuovoPreventivo = new EPreventivo(
                null, $idU, $idV, $idS, null, 'inviato', $descrizione, null, date('Y-m-d H:i:s')
            );

            if (!$pm->store($nuovoPreventivo)) {
                throw new Exception("Problema tecnico durante l'invio della richiesta.");
            }
        } catch (Exception $e) {
            $veicoli = (new CGarage())->getVeicoliPersonali();
            $servizi = (new CGestisciservizi())->richiediLista();
            (new VPreventivo())->mostraForm($veicoli, $servizi, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=preventivo_inviato');
        exit();
    }
}
?>
