<?

    class EPreventivo {
        private $idP;
        private $idU;
        private $targa;
        private $servizio;
        private $costo;
        private $stato;
        private $descrizione;
        private $pdf;
        private $data_richiesta;

        public function __construct($idP, $idU, $targa, $servizio, $costo, $stato, $descrizione, $pdf, $data_richiesta) {
            $this->idP = $idP;
            $this->idU = $idU;
            $this->targa = $targa;
            $this->servizio = $servizio;
            $this->costo = $costo;
            $this->stato = $stato;
            $this->descrizione = $descrizione;
            $this->pdf = $pdf;
            $this->data_richiesta = $data_richiesta;
        }

        // Getters
        public function getIdPreventivo() { return $this->idP; }
        public function getIdUtente() { return $this->idU; }        
        public function getTarga() { return $this->targa; }
        public function getServizio() { return $this->servizio; }
        public function getCosto() { return $this->costo; }
        public function getStato() { return $this->stato; }
        public function getDescrizione() { return $this->descrizione; }
        public function getPdf() { return $this->pdf; }
        public function getDataRichiesta() { return $this->data_richiesta; }

        // Setters
        public function setIdUtente($idU) { $this->idU = $idU; }
        public function setTarga($targa) { $this->targa = $targa; }
        public function setServizio($servizio) { $this->servizio = $servizio; }
        public function setCosto($costo) { $this->costo = $costo; }
        public function setStato($stato) { $this->stato = $stato; }
        public function setDescrizione($descrizione) { $this->descrizione = $descrizione; }
        public function setPdf($pdf) { $this->pdf = $pdf; }
        public function setDataRichiesta($data_richiesta) { $this->data_richiesta = $data_richiesta; }
    }
?>  


