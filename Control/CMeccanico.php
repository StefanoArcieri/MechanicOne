<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VMeccanico.php';

class CMeccanico {

    public static function getProfilo() {
        try {
            $idM = Session::get('idU');
            $ruolo = strtolower((string) Session::get('ruolo'));
            if (!$idM || !in_array($ruolo, ['meccanico', 'admin'], true)) {
                throw new Exception("Accesso negato.");
            }

            $pm = PersistentManager::getInstance();
            $profilo = $pm->load('EMeccanico', 'idM', $idM);
            if (!$profilo) throw new Exception("Profilo meccanico non trovato.");

            return $profilo;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function area($params = []) {
        $view = new VMeccanico();
        $ruolo = strtolower((string) Session::get('ruolo'));

        if ($ruolo === 'meccanico') {
            $profilo = self::getProfilo();
            $view->mostraProfilo($profilo);
            return;
        }

        if ($ruolo === 'admin') {
            $meccanici = self::richiediLista();
            $view->mostraLista($meccanici);
            return;
        }

        $view->mostraAreaTeam();
    }

    public function profilo($params = []) {
        $view = new VMeccanico();
        $profilo = self::getProfilo();
        $view->mostraProfilo($profilo);
    }

    public function lista($params = []) {
        $view = new VMeccanico();
        $meccanici = self::richiediLista();
        $view->mostraLista($meccanici);
    }

    public static function aggiornaProfilo($nuovaSpecializzazione, $nuovaFoto) {
        try {
            $idM = Session::get('idU');
            if (Session::get('ruolo') !== 'meccanico') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Errore caricamento profilo.");

            $meccanicoAggiornato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM, $nuovaSpecializzazione, $nuovaFoto, $datiAttuali['status']
            );

            if (!$pm->update($meccanicoAggiornato)) {
                throw new Exception("Impossibile aggiornare il profilo.");
            }

            header('Location: /MechanicOne/meccanico/profilo?msg=profilo_aggiornato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function richiediLista() {
        try {
            $ruolo = strtolower((string) Session::get('ruolo'));
            if (!in_array($ruolo, ['admin', 'meccanico', 'cliente'], true)) {
                throw new Exception("Accesso negato.");
            }

            $pm = PersistentManager::getInstance();
            $lista = $pm->getAll('EMeccanico');
            return $lista ?: [];
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function approvaMeccanico($idM) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Meccanico non trovato.");

            $meccanicoApprovato = new EMeccanico(
                null, '', '', '', '', '', null, null, 
                $idM, $datiAttuali['specializzazione'], $datiAttuali['foto_profilo'] ?? $datiAttuali['fotoprofilo'], 'approvato'
            );

            if (!$pm->update($meccanicoApprovato)) {
                throw new Exception("Impossibile approvare il meccanico.");
            }

            header('Location: /MechanicOne/meccanico/lista?msg=meccanico_approvato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function eliminaMeccanico($idM) {
        try {
            if (Session::get('ruolo') !== 'admin') throw new Exception("Accesso negato.");

            $pm = PersistentManager::getInstance();
            if (!$pm->delete('EMeccanico', 'idM', $idM)) {
                throw new Exception("Impossibile eliminare il meccanico.");
            }

            header('Location: /MechanicOne/meccanico/lista?msg=meccanico_eliminato');
            exit();
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>