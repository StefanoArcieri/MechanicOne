<?php

require_once __DIR__ . '/../foundation/config.php';
require_once __DIR__ . '/../foundation/FVeicolo.php';
require_once __DIR__ . '/../entity/EVeicolo.php';
require_once __DIR__ . '/../foundation/Session.php';

class CVeicolo {

    public static function registra($targa, $marca, $modello) {
        global $pdo;

        try {
            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Accesso negato: effettua il login per registrare un'auto.");
            }

            $fVeicolo = new FVeicolo();
            $targa = strtoupper(trim($targa));
            
            if ($fVeicolo->load('targa', $targa, $pdo)) {
                throw new Exception("Attenzione: Questa targa è già registrata nell'officina.");
            }

            $nuovoVeicolo = new EVeicolo(null, $idU, $targa, $marca, $modello);

            if (!$fVeicolo->store($nuovoVeicolo, $pdo)) {
                throw new Exception("Errore tecnico durante il salvataggio del veicolo. Riprova.");
            }

            header('Location: ../index.php');
            exit();

        } catch (Exception $e) {
            throw $e;
        }
    }

    public static function getVeicoliPersonali() {
        global $pdo;

        try {

            $idU = Session::get('idU');
            if (!$idU) {
                throw new Exception("Devi effettuare l'accesso per visualizzare i tuoi veicoli.");
            }

            $fVeicolo = new FVeicolo();
            $veicoli = $fVeicolo->search('idU', $idU, $pdo);
            
            if ($veicoli === false) {
                return [];
            }
            
            return $veicoli;

        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>