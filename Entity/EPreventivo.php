<?php

    class EPreventivo {
        private $idPrev;
        private $idU;
        private $idV;
        private $idS;
        private $costo;
        private $stato;
        private $descrizione;
        private $pdf;
        private $data_richiesta;

        public function __construct($idPrev, $idU, $idV, $idS, $costo, $stato, $descrizione, $pdf, $data_richiesta) {
            $this->idPrev = $idPrev;
            $this->idU = $idU;
            $this->idV = $idV;
            $this->idS = $idS;
            $this->costo = $costo;
            $this->stato = $stato;
            $this->descrizione = $descrizione;
            $this->pdf = $pdf;
            $this->data_richiesta = $data_richiesta;
        }

        // Getters
        public function getIdPreventivo() { return $this->idPrev; }
        public function getIdUtente() { return $this->idU; }        
        public function getIdVeicolo() { return $this->idV; }
        public function getIdServizio() { return $this->idS; }
        public function getCosto() { return $this->costo; }
        public function getStato() { return $this->stato; }
        public function getDescrizione() { return $this->descrizione; }
        public function getPdf() { return $this->pdf; }
        public function getDataRichiesta() { return $this->data_richiesta; }

        // Setters
        public function setIdUtente($idU) { $this->idU = $idU; }
        public function setIdVeicolo($idV) { $this->idV = $idV; }
        public function setIdServizio($idS) { $this->idS = $idS; }
        public function setCosto($costo) { $this->costo = $costo; }
        public function setStato($stato) { $this->stato = $stato; }
        public function setDescrizione($descrizione) { $this->descrizione = $descrizione; }
        public function setPdf($pdf) { $this->pdf = $pdf; }
        public function setDataRichiesta($data_richiesta) { $this->data_richiesta = $data_richiesta; }
    }
?>  


