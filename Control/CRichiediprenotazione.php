<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EPrenotazione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../View/VPrenotazione.php';
require_once __DIR__ . '/CGarage.php';
require_once __DIR__ . '/CVisualizzapreventivi.php';

class CRichiediprenotazione {

    // per il form ci servono veicoli e preventivi accettati, che vivono in altri due controller: li richiamiamo diretti
    public function nuovo($params = []) {
        $view = new VPrenotazione();
        $veicoli = (new CGarage())->getVeicoliPersonali();
        $preventiviAccettati = $this->getPreventiviAccettati();
        $view->mostraForm($veicoli, $preventiviAccettati);
    }

    private function getPreventiviAccettati() {
        return array_values(array_filter(
            (new CVisualizzapreventivi())->getPreventiviUtente(),
            function ($p) { return $p->getStato() === 'accettato'; }
        ));
    }

    public function prenota() {
        $idU = Session::get('idU');
        $idV = $_POST['idV'] ?? '';
        $idPrev = ($_POST['idPrev'] ?? '') !== '' ? $_POST['idPrev'] : null;
        $data = $_POST['data'] ?? '';
        $ora = $_POST['ora'] ?? '';

        try {
            $pm = PersistentManager::getInstance();

            $veicolo = $pm->load('EVeicolo', 'idV', $idV);
            if (!$veicolo || $veicolo->getIdUtente() != $idU) {
                throw new Exception("Il veicolo selezionato non appartiene al tuo garage.");
            }

            if ($idPrev !== null) {
                $preventivo = $pm->load('EPreventivo', 'idPrev', $idPrev);
                if (!$preventivo || $preventivo->getIdUtente() != $idU || $preventivo->getIdVeicolo() != $idV) {
                    throw new Exception("Il preventivo selezionato non è valido per questo veicolo.");
                }
                if ($preventivo->getStato() !== 'accettato') {
                    throw new Exception("Puoi prenotare solo a partire da un preventivo accettato.");
                }
            }

            $nuovaPrenotazione = new EPrenotazione(null, $idPrev, null, $idU, $idV, $data, 'in attesa', $ora);

            if (!$pm->store($nuovaPrenotazione)) {
                throw new Exception("Errore durante il salvataggio della prenotazione.");
            }
        } catch (Exception $e) {
            $veicoli = (new CGarage())->getVeicoliPersonali();
            $preventiviAccettati = $this->getPreventiviAccettati();
            (new VPrenotazione())->mostraForm($veicoli, $preventiviAccettati, $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/visualizzaprenotazioni/lista?msg=prenotazione_effettuata');
        exit();
    }
}
?>
