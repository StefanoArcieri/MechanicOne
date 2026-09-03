<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/EServizio.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';
require_once __DIR__ . '/../View/VServizio.php';

class CGestisciservizi {

    public function lista($params = []) {
        $view = new VServizio();
        $errore = '';
        try {
            $servizi = $this->richiediLista();
        } catch (Exception $e) {
            $errore = $e->getMessage();
            $servizi = [];
        }
        $view->mostraLista($servizi, $errore);
    }

    public function aggiungiServizio() {
        $titolo = trim(Request::post('titolo', ''));
        $descrizione = trim(Request::post('descrizione', ''));

        try {
            if ($titolo === '') {
                throw new Exception("Il titolo del servizio è obbligatorio.");
            }

            $pm = PersistentManager::getInstance();

            if ($pm->load('EServizio', 'titolo', $titolo)) {
                throw new Exception("Un servizio chiamato '$titolo' esiste già nel catalogo.");
            }

            $nuovoServizio = new EServizio(null, $titolo, $descrizione);

            if (!$pm->store($nuovoServizio)) {
                throw new Exception("Impossibile salvare il servizio.");
            }
        } catch (Exception $e) {
            (new VServizio())->mostraLista($this->richiediLista(), $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/gestisciservizi/lista?msg=servizio_aggiunto');
        exit();
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('EServizio') ?: [];
    }

    public function modificaServizio($idS) {
        $titolo = trim(Request::post('titolo', ''));
        $descrizione = trim(Request::post('descrizione', ''));

        try {
            if ($titolo === '') {
                throw new Exception("Il titolo del servizio è obbligatorio.");
            }

            $pm = PersistentManager::getInstance();

            // il titolo resta univoco: va bene se coincide con se stesso, non con un altro servizio
            $omonimo = $pm->load('EServizio', 'titolo', $titolo);
            if ($omonimo && (int) $omonimo->getIdServizio() !== (int) $idS) {
                throw new Exception("Un servizio chiamato '$titolo' esiste già nel catalogo.");
            }

            $servizioAggiornato = new EServizio($idS, $titolo, $descrizione);

            if (!$pm->update($servizioAggiornato)) {
                throw new Exception("Impossibile salvare le modifiche.");
            }
        } catch (Exception $e) {
            (new VServizio())->mostraLista($this->richiediLista(), $e->getMessage());
            return;
        }

        header('Location: /MechanicOne/gestisciservizi/lista?msg=servizio_modificato');
        exit();
    }

    public function eliminaServizio($idS) {
        $pm = PersistentManager::getInstance();
        if (!$pm->delete('EServizio', 'idS', $idS)) {
            throw new Exception("Impossibile eliminare il servizio.");
        }

        header('Location: /MechanicOne/gestisciservizi/lista?msg=servizio_eliminato');
        exit();
    }
}
?>
