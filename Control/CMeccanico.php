<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VMeccanico.php';

class CMeccanico {

    public static function getProfilo() {
        $idM = Session::get('idU');
        $ruolo = strtolower((string) Session::get('ruolo'));
        if (!$idM || !in_array($ruolo, ['meccanico', 'admin'], true)) {
            throw new Exception("Accesso negato.");
        }

        $pm = PersistentManager::getInstance();
        $profilo = $pm->load('EMeccanico', 'idM', $idM);
        if (!$profilo) throw new Exception("Profilo meccanico non trovato.");

        return $profilo;
    }

    public function area($params = []) {
        $view = new VMeccanico();
        $ruolo = strtolower((string) Session::get('ruolo'));
        $errore = '';

        if ($ruolo === 'meccanico') {
            try {
                $profilo = self::getProfilo();
            } catch (Exception $e) {
                $errore = $e->getMessage();
                $profilo = null;
            }
            $view->mostraProfilo($profilo, $errore);
            return;
        }

        if ($ruolo === 'admin') {
            try {
                $meccanici = self::richiediLista();
            } catch (Exception $e) {
                $errore = $e->getMessage();
                $meccanici = [];
            }
            $view->mostraLista($meccanici, $errore);
            return;
        }

        $view->mostraAreaTeam();
    }

    public function profilo($params = []) {
        $view = new VMeccanico();
        $errore = '';
        try {
            $profilo = self::getProfilo();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $profilo = null;
        }
        $view->mostraProfilo($profilo, $errore);
    }

    public function lista($params = []) {
        $ruolo = strtolower((string) Session::get('ruolo'));
        if (!in_array($ruolo, ['admin', 'meccanico', 'cliente'], true)) {
            throw new Exception("Accesso negato.");
        }

        $view = new VMeccanico();
        $errore = '';
        try {
            $meccanici = self::richiediLista();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $meccanici = [];
        }
        $view->mostraLista($meccanici, $errore);
    }

    public static function aggiornaProfilo($nuovaSpecializzazione, $nuovaFoto) {
        $idM = Session::get('idU');
        if (Session::get('ruolo') !== 'meccanico') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
        if (!$datiAttuali) throw new Exception("Profilo meccanico non trovato.");

        $meccanicoAggiornato = new EMeccanico(
            null, '', '', '', '', '', null, null,
            $idM, $nuovaSpecializzazione, $nuovaFoto, $datiAttuali['status']
        );

        if (!$pm->update($meccanicoAggiornato)) {
            throw new Exception("Impossibile aggiornare il profilo.");
        }

        header('Location: /MechanicOne/meccanico/profilo?msg=profilo_aggiornato');
        exit();
    }

    public static function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EMeccanico') ?: [];
    }

    public static function approvaMeccanico($idM) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
        if (!$datiAttuali) throw new Exception("Meccanico non trovato.");

        $meccanicoApprovato = new EMeccanico(
            null, '', '', '', '', '', null, null,
            $idM, $datiAttuali['specializzazione'], $datiAttuali['foto_profilo'], 'approvato'
        );

        if (!$pm->update($meccanicoApprovato)) {
            throw new Exception("Impossibile approvare il meccanico.");
        }

        header('Location: /MechanicOne/meccanico/lista?msg=meccanico_approvato');
        exit();
    }

    public static function eliminaMeccanico($idM) {
        if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EMeccanico', 'idM', $idM)) {
            throw new Exception("Impossibile eliminare il meccanico.");
        }

        header('Location: /MechanicOne/meccanico/lista?msg=meccanico_eliminato');
        exit();
    }
}
?>
