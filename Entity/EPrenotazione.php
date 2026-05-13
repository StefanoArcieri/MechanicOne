<?php

    class EPrenotazione {
        private $idPren;
        private $idPrev;
        private $idM;
        private $idV;
        private $data;
        private $stato;
        private $ora;

        public function __construct($idPren, $idPrev, $idM, $idV, $data, $stato, $ora) {
            $this->idPren = $idPren;
            $this->idPrev = $idPrev;
            $this->idM = $idM;
            $this->idV = $idV;
            $this->data = $data;
            $this->stato = $stato;
            $this->ora = $ora;
        }

        // Getters
        public function getIdPrenotazione() { return $this->idPren; }
        public function getIdPreventivo() { return $this->idPrev; }
        public function getIdMeccanico() { return $this->idM; }
        public function getIdVeicolo() { return $this->idV; }
        public function getDataPrenotazione() { return $this->data; }
        public function getStato() { return $this->stato; }
        public function getOra() { return $this->ora; }

        // Setters
        public function setIdPrenotazione($idPren) { $this->idPren = $idPren; }
        public function setIdPreventivo($idPrev) { $this->idPrev = $idPrev; }
        public function setIdMeccanico($idM) { $this->idM = $idM; }
        public function setIdVeicolo($idV) { $this->idV = $idV; }
        public function setDataPrenotazione($data) { $this->data = $data; }
        public function setStato($stato) { $this->stato = $stato; }
        public function setOra($ora) { $this->ora = $ora; }
    }
?>  


