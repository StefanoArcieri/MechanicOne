<?php

    class EPrenotazione {
        private $id;
        private $idP;
        private $idM;
        private $targa;
        private $data;
        private $stato;
        private $ora;

        public function __construct($id, $idP, $idM, $targa, $data, $stato, $ora) {
            $this->id = $id;
            $this->idP = $idP;
            $this->idM = $idM;
            $this->targa = $targa;
            $this->data = $data;
            $this->stato = $stato;
        }

        // Getters
        public function getIdUtente() { return $this->id; }
        public function getIdPreventivo() { return $this->idP; }
        public function getIdMeccanico() { return $this->idM; }
        public function getTarga() { return $this->targa; }
        public function getDataPrenotazione() { return $this->data; }
        public function getStato() { return $this->stato; }
        public function getOra() { return $this->ora; }

        // Setters
        public function setIdPreventivo($idP) { $this->idP = $idP; }
        public function setIdMeccanico($idM) { $this->idM = $idM; }
        public function setTarga($targa) { $this->targa = $targa; }
        public function setDataPrenotazione($data) { $this->data = $data; }
        public function setStato($stato) { $this->stato = $stato; }
        public function setOra($ora) { $this->ora = $ora; }
    }
?>  


