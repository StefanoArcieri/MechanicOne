<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VPrenotazione.php';

class CPrenotazione {

    public static function prenota($idV, $idPrev, $data, $ora) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Effettua il login per prenotare.");

        $pm = PersistentManager::getInstance();
        $nuovaPrenotazione = new EPrenotazione(null, $idPrev, null, $idU, $idV, $data, 'in attesa', $ora);

        if (!$pm->store($nuovaPrenotazione)) {
            throw new Exception("Errore durante il salvataggio della prenotazione.");
        }

        header('Location: /MechanicOne/prenotazione/lista?msg=prenotazione_effettuata');
        exit();
    }

    public function lista($params = []) {
        $view = new VPrenotazione();
        $ruolo = Session::get('ruolo');
        $errore = '';
        try {
            if ($ruolo === 'admin' || $ruolo === 'meccanico') {
                $prenotazioni = self::richiediLista();
            } else {
                $prenotazioni = self::getPrenotazioniUtente();
            }
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $prenotazioni = [];
        }
        $view->mostraLista($prenotazioni, $errore);
    }

    public static function getPrenotazioniUtente() {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        return $pm->search('EPrenotazione', 'idU', $idU) ?: [];
    }

    public static function richiediLista() {
        $ruolo = Session::get('ruolo');
        if ($ruolo !== 'admin' && $ruolo !== 'meccanico') {
            throw new Exception("Accesso negato.");
        }

        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPrenotazione') ?: [];
    }

    public static function annullaPrenotazione($idPren) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();

        $prenotazione = $pm->load('EPrenotazione', 'idPren', $idPren);
        if (!$prenotazione) throw new Exception("Prenotazione non trovata.");

        $ruolo = Session::get('ruolo');
        if ($ruolo !== 'admin' && $ruolo !== 'meccanico' && $prenotazione['idU'] != $idU) {
            throw new Exception("Non puoi annullare una prenotazione che non ti appartiene.");
        }

        if (!$pm->delete('EPrenotazione', 'idPren', $idPren)) {
            throw new Exception("Impossibile annullare la prenotazione.");
        }

        header('Location: /MechanicOne/prenotazione/lista?msg=prenotazione_annullata');
        exit();
    }
}
?>
