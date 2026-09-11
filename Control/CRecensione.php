<?php

require_once __DIR__ . '/../Foundation/PersistentManager.php';
require_once __DIR__ . '/../Entity/ERecensione.php';
require_once __DIR__ . '/../Foundation/Session.php';
require_once __DIR__ . '/../Foundation/Request.php';

class CRecensione {

    public function scrivi() {
        $idU = Session::get('idU');
        $idM = Request::post('idM', '');
        $commento = trim(Request::post('commento', ''));
        $voto = (int) Request::post('voto', '');

        //controllo anche se è inutile perche ci sono i required
        if ($voto < 1 || $voto > 5) throw new Exception("Il voto deve essere compreso tra 1 e 5.");
        if ($commento === '') throw new Exception("Scrivi un commento per la recensione.");

        $nuovaRecensione = new ERecensione(null, $idM, $idU, $voto, $commento, date('Y-m-d'));

        $pm = PersistentManager::getInstance();

        if (!$pm->store($nuovaRecensione)) {
            throw new Exception("Impossibile pubblicare la recensione.");
        }

        $idR=$pm->load('ERecensione', 'commento', $commento);
        header('Location: /MechanicOne/utente/home?msg=published#recensione-'. $idR->getIdRecensione());
        exit();
    }

    public function richiediLista() {
        $pm = PersistentManager::getInstance();
        return $pm->getAll('ERecensione') ?: [];
    }

    public function mostraRecensioni(){
        $pm = PersistentManager::getInstance();
        $recensioniEntities = $this->richiediLista();

        $recensioni = [];
        foreach ($recensioniEntities as $rEntity){
            $recensioni[] = $rEntity -> toArray();

        }

        //logica per idM, idU, ecc

        //non utilizzabile perche non abbiamo bisogno di una view per le recensioni
        //visto che non vanno mai visualizzate per conto proprio, quindi è una funzione
        //in stand-by per ora, ma potrebbe essere utile in futuro per una pagina dedicata alle recensioni
        $view = new VRecensioni();
        $view->mostraRecensioni($recensioni);
    }
}
?>