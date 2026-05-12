<?

    class EVeicolo{
        private $targa;
        private $marca;
        private $modello;   
        private $idU;

        public function __construct($targa, $marca, $modello, $idU) {
            $this->targa = $targa;
            $this->marca = $marca;
            $this->modello = $modello;
            $this->idU = $idU;
        }   

        // Getters
        public function getTarga() { return $this->targa; }
        public function getMarca() { return $this->marca; }     
        public function getModello() { return $this->modello; }
        public function getIdUtente() { return $this->idU; }

        // Setters
        public function setMarca($marca) { $this->marca = $marca; }
        public function setModello($modello) { $this->modello = $modello; }
        public function setIdUtente($idU) { $this->idU = $idU; }

    }
?>