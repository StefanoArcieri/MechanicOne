<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VPrenotazione.php';

class CPrenotazione {

    public static function prenota($idV, $idS, $data, $ora) {
        try {
            $idU = Session::get('idU');
            if (!$idU) throw new Exception("Effettua il login per prenotare.");

            $pm = PersistentManager::getInstance();
            $nuovaPrenotazione = new EPrenotazione(null, null, null, $idV, $data, 'confermata', $ora);

            if (!$pm->store($nuovaPrenotazione)) {
                throw new Exception("Errore durante il salvataggio della prenotazione.");
            }

            header('Location: /MechanicOne/prenotazione/lista?msg=prenotazione_effettuata');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function lista($params = []) {
        $view = new VPrenotazione();
        $ruolo = Session::get('ruolo');

        if ($ruolo === 'admin' || $ruolo === 'meccanico') {
            $prenotazioni = self::richiediLista();
        } else {
            $prenotazioni = self::getPrenotazioniUtente();
        }

        $view->mostraLista($prenotazioni);
    }

    public static function getPrenotazioniUtente() {
        try {
            $idU = Session::get('idU');
            if (!$idU) return [];

            $pm = PersistentManager::getInstance();
            $prenotazioni = $pm->search('EPrenotazione', 'idU', $idU);
            return $prenotazioni ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            if (Session::get('ruolo') !== 'admin' && Session::get('ruolo') !== 'meccanico') {
                throw new Exception("Accesso negato.");
            }

            $pm = PersistentManager::getInstance();
            $prenotazioni = $pm->getAll('EPrenotazione');
            return $prenotazioni ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function annullaPrenotazione($idPren) {
        try {
            $pm = PersistentManager::getInstance();
            if (!$pm->delete('EPrenotazione', 'idPren', $idPren)) {
                throw new Exception("Impossibile annullare la prenotazione.");
            }

            header('Location: /MechanicOne/prenotazione/lista?msg=prenotazione_annullata');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>