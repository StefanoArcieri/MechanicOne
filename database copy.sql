-- Elimina le tabelle se esistono già per evitare errori (nell'ordine corretto per via delle FK)
DROP TABLE IF EXISTS `prenotazioni`;
DROP TABLE IF EXISTS `preventivi`;
DROP TABLE IF EXISTS `meccanici`;
DROP TABLE IF EXISTS `veicoli`;
DROP TABLE IF EXISTS `utenti`;
DROP TABLE IF EXISTS `servizi`;

-- 1. Creazione Tabelle Indipendenti
CREATE TABLE `servizi` (
   `titolo` varchar(50) NOT NULL,
   `descrizione` varchar(300) DEFAULT NULL,
   PRIMARY KEY (`titolo`)
);

-- Spostata qui: deve esistere PRIMA dei veicoli!
CREATE TABLE `utenti` (
   `idU` int(11) NOT NULL AUTO_INCREMENT,
   `nome` varchar(50) NOT NULL,
   `cognome` varchar(70) NOT NULL,
   `email` varchar(100) NOT NULL,
   `password` varchar(255) NOT NULL,
   `ruolo` enum('cliente','meccanico','admin') NOT NULL DEFAULT 'cliente',
   `ultimo_accesso` timestamp NULL DEFAULT NULL, 
   `data_registrazione` timestamp DEFAULT CURRENT_TIMESTAMP, 
   PRIMARY KEY (`idU`),
   UNIQUE KEY `email` (`email`)
);

-- 2. Creazione Tabelle Dipendenti
CREATE TABLE `veicoli` (
   `targa` varchar(7) NOT NULL,
   `idU` int(11) NOT NULL, -- AGGIUNTO: L'ID del proprietario
   `marca` varchar(30) NOT NULL,
   `modello` varchar(50) NOT NULL,
   PRIMARY KEY (`targa`),
   CONSTRAINT `fk_veicoli_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE -- AGGIUNTO: Il collegamento
);

CREATE TABLE `meccanici` (
   `idM` int(11) NOT NULL,
   `specializzazione` varchar(200) DEFAULT NULL,
   `status` enum('in attesa','approvato', 'licenziato') DEFAULT 'in attesa',
   PRIMARY KEY (`idM`),
   CONSTRAINT `fk_meccanico_utente` FOREIGN KEY (`idM`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
);

CREATE TABLE `preventivi` (
   `idP` int(11) NOT NULL AUTO_INCREMENT,
   `idU` int(11) NOT NULL,
   `targa` varchar(7) DEFAULT NULL, -- AGGIUNTO: La targa a cui si riferisce
   `servizio` varchar(50) NOT NULL,
   `descrizione` varchar(200) NOT NULL,
   `costo` int(11) DEFAULT NULL,
   `stato` enum('inviato','accettato') DEFAULT 'inviato',
   `pdf` varchar(50) DEFAULT NULL,
   `data_richiesta` timestamp DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`idP`),
   CONSTRAINT `fk_preventivo_targa` FOREIGN KEY (`targa`) REFERENCES `veicoli` (`targa`) ON DELETE CASCADE, -- AGGIUNTO: Collegamento con l'auto
   CONSTRAINT `fk_preventivo_servizio` FOREIGN KEY (`servizio`) REFERENCES `servizi` (`titolo`) ON DELETE CASCADE,
   CONSTRAINT `fk_preventivo_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
);

CREATE TABLE `prenotazioni` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `idP` int(11) DEFAULT NULL,
   `idM` int(11) DEFAULT NULL,
   `targa` varchar(7) NOT NULL,
   `data` date NOT NULL,
   `ora` time NOT NULL,
   `stato` enum('in attesa','accettata', 'cancellata') DEFAULT 'in attesa',
   PRIMARY KEY (`id`),
   UNIQUE KEY `no_sovrapposizioni` (`idM`, `data`, `ora`),
   CONSTRAINT `fk_prenotazioni_preventivi` FOREIGN KEY (`idP`) REFERENCES `preventivi` (`idP`) ON DELETE CASCADE,
   CONSTRAINT `fk_prenotazioni_meccanico` FOREIGN KEY (`idM`) REFERENCES `meccanici` (`idM`) ON DELETE SET NULL,
   CONSTRAINT `fk_prenotazioni_veicolo` FOREIGN KEY (`targa`) REFERENCES `veicoli` (`targa`) ON DELETE CASCADE
);