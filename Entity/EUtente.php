<?php

    class EUtente{
        private $idU;
        private $nome;
        private $cognome;
        private $email;
        private $password;
        private $ruolo;
        private $ultimo_accesso;
        private $data_registrazione;

        public function __construct($idU, $nome, $cognome, $email, $password, $ruolo, $ultimo_accesso, $data_registrazione) {
            $this->idU = $idU;
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->email = $email;
            $this->password = $password;
            $this->ruolo = $ruolo;
            $this->ultimo_accesso = $ultimo_accesso;
            $this->data_registrazione = $data_registrazione;
        }

        // Getters
        public function getId() { return $this->idU;}
        public function getNome() { return $this->nome; }
        public function getCognome() { return $this->cognome; }
        public function getEmail() { return $this->email; }
        public function getPassword() { return $this->password; }
        public function getRuolo() { return $this->ruolo; }
        public function getUltimoAccesso() { return $this->ultimo_accesso; }
        public function getDataRegistrazione() { return $this->data_registrazione; }

        // Setters
        public function setNome($nome) { $this->nome = $nome; }
        public function setCognome($cognome) { $this->cognome = $cognome; }
        public function setEmail($email) { $this->email = $email; }
        public function setRuolo($ruolo) { $this->ruolo = $ruolo; }
        public function setUltimoAccesso($ultimo_accesso) { $this->ultimo_accesso = $ultimo_accesso; }
        public function setDataRegistrazione($data_registrazione) { $this->data_registrazione = $data_registrazione; }
    }
?>