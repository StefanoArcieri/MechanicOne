<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPreventivo.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VPreventivo.php';

class CPreventivo {

    public static function richiedi($idV, $idS, $descrizione) {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Effettua il login per richiedere un preventivo.");

        $pm = PersistentManager::getInstance();
        $nuovoPreventivo = new EPreventivo(
            null, $idU, $idV, $idS, null, 'inviato', $descrizione, null, date('Y-m-d H:i:s')
        );

        if (!$pm->store($nuovoPreventivo)) {
            throw new Exception("Problema tecnico durante l'invio della richiesta.");
        }

        header('Location: /MechanicOne/preventivo/lista?msg=preventivo_inviato');
        exit();
    }

    public function lista($params = []) {
        $view = new VPreventivo();
        $ruolo = Session::get('ruolo');
        $errore = '';
        try {
            if ($ruolo === 'admin') {
                $preventivi = self::richiediLista();
            } else {
                $preventivi = self::getPreventiviUtente();
            }
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $preventivi = [];
        }
        $view->mostraLista($preventivi, $errore);
    }

    public static function getPreventiviUtente() {
        $idU = Session::get('idU');
        if (!$idU) throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        return $pm->search('EPreventivo', 'idU', $idU) ?: [];
    }

    public static function richiediLista() {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        return $pm->getAll('EPreventivo') ?: [];
    }

    public static function updateCosto($idPrev, $nuovoCosto) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $preventivoAggiornato = new EPreventivo(
            $prevData['idPrev'], $prevData['idU'], $prevData['idV'], $prevData['idS'],
            $nuovoCosto, 'accettato', $prevData['descrizione'], $prevData['pdf'], $prevData['data_richiesta']
        );

        if (!$pm->update($preventivoAggiornato)) {
            throw new Exception("Impossibile salvare il prezzo.");
        }

        header('Location: /MechanicOne/preventivo/lista?msg=preventivo_prezzato');
        exit();
    }

    public static function rifiuta($idPrev) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        $prevData = $pm->load('EPreventivo', 'idPrev', $idPrev);
        if (!$prevData) throw new Exception("Preventivo non trovato.");

        $preventivoRifiutato = new EPreventivo(
            $prevData['idPrev'], $prevData['idU'], $prevData['idV'], $prevData['idS'],
            $prevData['costo'], 'rifiutato', $prevData['descrizione'], $prevData['pdf'], $prevData['data_richiesta']
        );

        if (!$pm->update($preventivoRifiutato)) {
            throw new Exception("Impossibile rifiutare il preventivo.");
        }

        header('Location: /MechanicOne/preventivo/lista?msg=preventivo_rifiutato');
        exit();
    }
}
?>
