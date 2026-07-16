<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EMeccanico.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VMeccanico.php';

class CGestiscimeccanici {

    public function lista($params = []) {
        $view = new VMeccanico();
        $errore = '';
        try {
            $meccanici = array_map([$this, 'arricchisciConNome'], $this->richiediLista());
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $meccanici = [];
        }
        $view->mostraLista($meccanici, $errore);
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EMeccanico') ?: [];
    }

    // meccanici table non ha nome/cognome (stanno su utenti), quindi li recuperiamo qui per i template
    public function arricchisciConNome($meccanicoEntity) {
        $m = $meccanicoEntity->toArray();
        $pm = PersistentManager::getInstance();
        $u = $pm->load('EUtente', 'idU', $m['idM']);
        $m['nome'] = $u ? $u->getNome() : '';
        $m['cognome'] = $u ? $u->getCognome() : '';
        $m['email'] = $u ? $u->getEmail() : '';
        return $m;
    }

    public function approvaMeccanico($idM) {
        $pm = PersistentManager::getInstance();
        $datiAttuali = $pm->load('EMeccanico', 'idM', $idM);
        if (!$datiAttuali) throw new Exception("Meccanico non trovato.");

        $meccanicoApprovato = new EMeccanico(
            null, '', '', '', '', '', null, null,
            $idM, $datiAttuali->getSpecializzazione(), $datiAttuali->getFotoProfilo(), 'approvato'
        );

        if (!$pm->update($meccanicoApprovato)) {
            throw new Exception("Impossibile approvare il meccanico.");
        }

        header('Location: /MechanicOne/gestiscimeccanici/lista?msg=meccanico_approvato');
        exit();
    }

    public function eliminaMeccanico($idM) {
        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EMeccanico', 'idM', $idM)) {
            throw new Exception("Impossibile eliminare il meccanico.");
        }

        header('Location: /MechanicOne/gestiscimeccanici/lista?msg=meccanico_eliminato');
        exit();
    }
}
?>
