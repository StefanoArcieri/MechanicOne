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
        private $email_verificata;
        private $token;

        public function __construct($idU, $nome, $cognome, $email, $password, $ruolo, $ultimo_accesso, $data_registrazione, $email_verificata = null, $token = null) {
            $this->idU = $idU;
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->email = $email;
            $this->password = $password;
            $this->ruolo = $ruolo;
            $this->ultimo_accesso = $ultimo_accesso;
            $this->data_registrazione = $data_registrazione;
            $this->email_verificata = $email_verificata;
            $this->token = $token;
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
        public function getEmailVerificata() { return $this->email_verificata; }
        public function getToken() { return $this->token; }

        // Setters
        public function setNome($nome) { $this->nome = $nome; }
        public function setCognome($cognome) { $this->cognome = $cognome; }
        public function setEmail($email) { $this->email = $email; }
        public function setRuolo($ruolo) { $this->ruolo = $ruolo; }
        public function setUltimoAccesso($ultimo_accesso) { $this->ultimo_accesso = $ultimo_accesso; }
        public function setDataRegistrazione($data_registrazione) { $this->data_registrazione = $data_registrazione; }
        public function setEmailVerificata($email_verificata) { $this->email_verificata = $email_verificata; }
        public function setToken($token) { $this->token = $token; }
        public function toArray() {
            return [
                'idU' => $this->idU,
                'nome' => $this->nome,
                'cognome' => $this->cognome,
                'email' => $this->email,
                'password' => $this->password,
                'ruolo' => $this->ruolo,
                'ultimo_accesso' => $this->ultimo_accesso,
                'data_registrazione' => $this->data_registrazione,
                'email_verificata' => $this->email_verificata,
                'token' => $this->token,
            ];
        }
    }
?>