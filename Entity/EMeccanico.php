<?php

    class EMeccanico extends EUtente {
        private $idM;
        private $specializzazione;
        private $foto_profilo;
        private $status; 

        public function __construct($id, $nome, $cognome, $email, $password, $ruolo, $ultimo_accesso, $data_registrazione, $idM, $specializzazione, $foto_profilo, $status) {
            parent::__construct($id, $nome, $cognome, $email, $password, $ruolo, $ultimo_accesso, $data_registrazione);
            $this->idM = $idM;
            $this->specializzazione = $specializzazione;
            $this->foto_profilo = $foto_profilo;
            $this->status = $status;
        }   

        // Getters
        public function getIdMeccanico() { return $this->idM; }
        public function getSpecializzazione() { return $this->specializzazione; }
        public function getFotoProfilo() { return $this->foto_profilo; }
        public function getStatus() { return $this->status; }   

        // Setters
        public function setSpecializzazione($specializzazione) { $this->specializzazione = $specializzazione; }
        public function setFotoProfilo($foto_profilo) { $this->foto_profilo = $foto_profilo; }
        public function setStatus($status) { $this->status = $status; }     
    }
?>