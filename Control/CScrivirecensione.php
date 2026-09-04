<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';

class CScrivirecensione {

    public function scrivi() {
        $idU = Session::get('idU');
        $idM = Request::post('idM', '');
        $testo = trim(Request::post('testo', ''));
        $voto = (int) Request::post('voto', 0);

        if ($voto < 1 || $voto > 5) throw new Exception("Il voto deve essere compreso tra 1 e 5.");
        if ($testo === '') throw new Exception("Scrivi un commento per la recensione.");

        $pm = PersistentManager::getInstance();

        $meccanico = $pm->load('EMeccanico', 'idM', $idM);
        if (!$meccanico || $meccanico->getStatus() !== 'approvato') {
            throw new Exception("Il meccanico che vuoi recensire non è disponibile.");
        }

        // una recensione a testa per meccanico: senza questo controllo si potevano pubblicare
        // recensioni illimitate sullo stesso meccanico, alterando la media voti mostrata in home
        $recensioniUtente = $pm->search('ERecensione', 'idU', $idU) ?: [];
        foreach ($recensioniUtente as $r) {
            if ((int) $r->getIdMeccanico() === (int) $idM) {
                throw new Exception("Hai già recensito questo meccanico.");
            }
        }

        $nuovaRecensione = new ERecensione(null, $idM, $idU, $voto, $testo, date('Y-m-d'));

        if (!$pm->store($nuovaRecensione)) {
            throw new Exception("Impossibile pubblicare la recensione.");
        }

        header('Location: /MechanicOne/utente/home?msg=recensione_pubblicata#recensioni');
        exit();
    }
}
?>
