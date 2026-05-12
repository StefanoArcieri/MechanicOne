<?

    class EServizio{
        private $titolo;
        private $descrizione;

        public function __construct($titolo, $descrizione) {
            $this->titolo = $titolo;
            $this->descrizione = $descrizione;
        }
        
        // Getters
        public function getTitolo() { return $this->titolo; }
        public function getDescrizione() { return $this->descrizione; } 

        // Setters
        public function setTitolo($titolo) { $this->titolo = $titolo; }
        public function setDescrizione($descrizione) { $this->descrizione = $descrizione; } 
    
    }
?>