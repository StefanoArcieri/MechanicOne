<?php

    class ERecensione{
        private $idR;
        private $idM;
        private $idU;
        private $valutazione;
        private $commento;  
        private $data_recensione;       

        public function __construct($idR, $idM, $idU, $valutazione, $commento, $data_recensione) {
            $this->idR = $idR;
            $this->idM = $idM;
            $this->idU = $idU;
            $this->valutazione = $valutazione;
            $this->commento = $commento;
            $this->data_recensione = $data_recensione;
        }   

        // Getters
        public function getIdRecensione() { return $this->idR; }
        public function getIdMeccanico() { return $this->idM; }             
        public function getIdUtente() { return $this->idU; }
        public function getValutazione() { return $this->valutazione; }
        public function getCommento() { return $this->commento; }
        public function getDataRecensione() { return $this->data_recensione; }

        // Setters
        public function setIdMeccanico($idM) { $this->idM = $idM; }
        public function setIdUtente($idU) { $this->idU = $idU; }
        public function setValutazione($valutazione) { $this->valutazione = $valutazione; }
        public function setCommento($commento) { $this->commento = $commento; }
        public function setDataRecensione($data_recensione) { $this->data_recensione = $data_recensione; }  
    }
?>
