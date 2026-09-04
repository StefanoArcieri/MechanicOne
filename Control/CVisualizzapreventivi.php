<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VPreventivo.php';

class CVisualizzapreventivi {

    // questo controller è solo lato cliente, la vista "tutti i preventivi" per meccanico/admin sta in CGestiscipreventivi
    public function lista($params = []) {
        $view = new VPreventivo();
        $errore = '';
        try {
            $preventivi = $this->getPreventiviUtente();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $preventivi = [];
        }
        $view->mostraLista($preventivi, $errore);
    }

    public function getPreventiviUtente() {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();
        return $pm->search('EPreventivo', 'idU', $idU) ?: [];
    }

    // non sovrascriviamo la descrizione originale: resta lì finché il meccanico non accetta la proposta,
    // così se l'utente annulla la modifica il preventivo torna com'era
    public function modifica($idPrev) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        if ($prevData->getIdUtente() != $idU) throw new Exception("Non puoi modificare un preventivo che non ti appartiene.");
        // whitelist invece di blacklist: si propone una modifica solo finché è 'inviato', prima che
        // l'admin lo accetti e fissi il prezzo. Dopo (accettato/svolto/rifiutato) non è più modificabile.
        if ($prevData->getStato() !== 'inviato') {
            throw new Exception("Questo preventivo non è più modificabile.");
        }

        $nuovaDescrizione = trim(Request::post('nuovaDescrizione', ''));
        if ($nuovaDescrizione === '') {
            throw new Exception("La descrizione non può essere vuota.");
        }

        $preventivoAggiornato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), $prevData->getStato(), $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            $nuovaDescrizione
        );

        if (!$pm->update($preventivoAggiornato)) {
            throw new Exception("Impossibile inviare la modifica.");
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=modifica_inviata');
        exit();
    }

    // ritira la proposta: il preventivo resta quello già in vigore
    public function annullaModifica($idPrev) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");
        if ($prevData->getIdUtente() != $idU) throw new Exception("Non puoi modificare un preventivo che non ti appartiene.");

        $preventivoRipristinato = new EPreventivo(
            $prevData->getIdPreventivo(), $prevData->getIdUtente(), $prevData->getIdVeicolo(), $prevData->getIdServizio(),
            $prevData->getCosto(), $prevData->getStato(), $prevData->getDescrizione(), $prevData->getPdf(), $prevData->getDataRichiesta(),
            null
        );

        if (!$pm->update($preventivoRipristinato)) {
            throw new Exception("Impossibile annullare la modifica.");
        }

        header('Location: /MechanicOne/visualizzapreventivi/lista?msg=modifica_annullata');
        exit();
    }

    // Il PDF non si serve mai come link statico diretto: passando da qui si controlla che sia
    // davvero il proprietario a scaricarlo, invece di fidarsi solo dell'imprevedibilità del nome file.
    public function scaricaPdf($idPrev) {
        $idU = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $preventivo = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$preventivo || $preventivo->getIdUtente() != $idU) {
            throw new Exception("Non puoi scaricare il PDF di un preventivo che non ti appartiene.");
        }
        // il campo pdf da solo basterebbe (si valorizza solo in updateCosto), ma controllare anche lo
        // stato è una seconda barriera esplicita: finché il preventivo è solo 'inviato' non deve mai
        // risultare scaricabile, qualunque cosa succeda in futuro alla colonna pdf.
        if ($preventivo->getStato() !== 'accettato' && $preventivo->getStato() !== 'svolto') {
            throw new Exception("Il PDF sarà disponibile solo dopo che l'admin avrà accettato e fissato un prezzo.");
        }
        if (!$preventivo->getPdf()) {
            throw new Exception("Nessun PDF disponibile per questo preventivo.");
        }

        $percorso = __DIR__ . '/../uploads/preventivi/' . basename($preventivo->getPdf());
        if (!is_file($percorso)) {
            throw new Exception("Il file PDF non è più disponibile.");
        }

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="preventivo_' . $preventivo->getIdPreventivo() . '.pdf"');
        header('Content-Length: ' . filesize($percorso));
        readfile($percorso);
        exit();
    }
}
?>
