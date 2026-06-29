<?php

    class EVeicolo{
        private $idV;
        private $targa;
        private $marca;
        private $modello;   
        private $idU;

        public function __construct($idV, $targa, $marca, $modello, $idU) {
            $this->idV = $idV;
            $this->targa = $targa;
            $this->marca = $marca;
            $this->modello = $modello;
            $this->idU = $idU;
        }   

        // Getters
        public function getIdVeicolo() { return $this->idV; }
        public function getTarga() { return $this->targa; }
        public function getMarca() { return $this->marca; }     
        public function getModello() { return $this->modello; }
        public function getIdUtente() { return $this->idU; }

        // Setters
        public function setMarca($marca) { $this->marca = $marca; }
        public function setModello($modello) { $this->modello = $modello; }
        public function setIdUtente($idU) { $this->idU = $idU; }
        public function setTarga($targa) {$this->targa = $targa; }

    }
?>