<?php

    class EServizio{
        private $idS;
        private $titolo;
        private $descrizione;

        public function __construct($idS, $titolo, $descrizione) {
            $this->idS = $idS;
            $this->titolo = $titolo;
            $this->descrizione = $descrizione;
        }
        
        // Getters
        public function getIdServizio() { return $this->idS; }
        public function getTitolo() { return $this->titolo; }
        public function getDescrizione() { return $this->descrizione; } 

        // Setters
        public function setTitolo($titolo) { $this->titolo = $titolo; }
        public function setDescrizione($descrizione) { $this->descrizione = $descrizione; } 
    
    }
?>