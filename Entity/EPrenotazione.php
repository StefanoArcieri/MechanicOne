<?php

    class EPrenotazione {
        private $idPren;
        private $idPrev;
        private $idM;
        private $idU;
        private $idV;
        private $data;
        private $dataProposta;
        private $stato;
        private $ora;
        private $oraProposta;

        public function __construct($idPren, $idPrev, $idM, $idU, $idV, $data, $stato, $ora, $dataProposta = null, $oraProposta = null) {
            $this->idPren = $idPren;
            $this->idPrev = $idPrev;
            $this->idM = $idM;
            $this->idU = $idU;
            $this->idV = $idV;
            $this->data = $data;
            $this->stato = $stato;
            $this->ora = $ora;
            $this->dataProposta = $dataProposta;
            $this->oraProposta = $oraProposta;
        }

        // Getters
        public function getIdPrenotazione() { return $this->idPren; }
        public function getIdPreventivo() { return $this->idPrev; }
        public function getIdMeccanico() { return $this->idM; }
        public function getIdUtente() { return $this->idU; }
        public function getIdVeicolo() { return $this->idV; }
        public function getDataPrenotazione() { return $this->data; }
        public function getDataProposta() { return $this->dataProposta; }
        public function getStato() { return $this->stato; }
        public function getOra() { return $this->ora; }
        public function getOraProposta() { return $this->oraProposta; }

        // Setters
        public function setIdPreventivo($idPrev) { $this->idPrev = $idPrev; }
        public function setIdMeccanico($idM) { $this->idM = $idM; }
        public function setIdUtente($idU) { $this->idU = $idU; }
        public function setIdVeicolo($idV) { $this->idV = $idV; }
        public function setDataPrenotazione($data) { $this->data = $data; }
        public function setDataProposta($dataProposta) { $this->dataProposta = $dataProposta; }
        public function setStato($stato) { $this->stato = $stato; }
        public function setOra($ora) { $this->ora = $ora; }
        public function setOraProposta($oraProposta) { $this->oraProposta = $oraProposta; }

        public function toArray() {
            return [
                'idPren' => $this->idPren,
                'idPrev' => $this->idPrev,
                'idM' => $this->idM,
                'idU' => $this->idU,
                'idV' => $this->idV,
                'data' => $this->data,
                'data_proposta' => $this->dataProposta,
                'stato' => $this->stato,
                'ora' => $this->ora,
                'ora_proposta' => $this->oraProposta,
            ];
        }
    }
?>
