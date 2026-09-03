<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VMeccanico.php';
require_once __DIR__ . '/CGestiscimeccanici.php';

class CProfilomeccanico {

    public function getProfilo() {
        $idM = Session::get('idU');

        $pm = PersistentManager::getInstance();
        $profilo = $pm->load('EMeccanico', 'idM', $idM);
        if (!$profilo) throw new Exception("Profilo meccanico non trovato.");

        return $profilo;
    }

    // punto d'ingresso unico che mostra cose diverse a seconda di chi lo apre: il meccanico vede il suo profilo,
    // l'admin la lista da gestire, chiunque altro una vetrina generica
    public function area($params = []) {
        $view = new VMeccanico();
        $ruolo = strtolower((string) Session::get('ruolo'));
        $errore = '';

        if ($ruolo === 'meccanico') {
            try {
                $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
            } catch (Exception $e) {
                $errore = $e->getMessage();
                $profilo = null;
            }
            $view->mostraProfilo($profilo, $errore);
            return;
        }

        if ($ruolo === 'admin') {
            try {
                $meccanici = array_map(
                    [new CGestiscimeccanici(), 'arricchisciConNome'],
                    (new CGestiscimeccanici())->richiediLista()
                );
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
            $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $profilo = null;
        }
        $view->mostraProfilo($profilo, $errore);
    }

    public function aggiornaProfilo() {
        $idM = Session::get('idU');
        $pm = PersistentManager::getInstance();

        $nuovaSpecializzazione = trim(Request::post('specializzazione', ''));
        $nuovaFoto = Request::post('foto');

        try {
            $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
            if (!$datiAttuali) throw new Exception("Profilo meccanico non trovato.");

            $meccanicoAggiornato = new EMeccanico(
                null, '', '', '', '', '', null, null,
                $idM, $nuovaSpecializzazione, $nuovaFoto, $datiAttuali->getStatus()
            );

            if (!$pm->update($meccanicoAggiornato)) {
                throw new Exception("Impossibile aggiornare il profilo.");
            }
        } catch (Exception $e) {
            $profilo = (new CGestiscimeccanici())->arricchisciConNome($this->getProfilo());
            (new VMeccanico())->mostraProfilo($profilo, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/profilomeccanico/profilo?msg=profilo_aggiornato');
        exit();
    }
}
?>
