-- Elimina le tabelle se esistono già per evitare errori (nell'ordine corretto per via delle FK)
DROP TABLE IF EXISTS `prenotazioni`;
DROP TABLE IF EXISTS `preventivi`;
DROP TABLE IF EXISTS `meccanici`;
DROP TABLE IF EXISTS `veicoli`;
DROP TABLE IF EXISTS `utenti`;
DROP TABLE IF EXISTS `servizi`;

-- 1. Creazione Tabelle Indipendenti
CREATE TABLE `servizi` (
   `idS` int(11) NOT NULL AUTO_INCREMENT,
   `titolo` varchar(50) NOT NULL,
   `descrizione` varchar(300) DEFAULT NULL,
   PRIMARY KEY (`idS`)
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
   `idV` int(11) NOT NULL AUTO_INCREMENT,
   `idU` int(11) NOT NULL,
   `targa` varchar(7) NOT NULL,
   `marca` varchar(30) NOT NULL,
   `modello` varchar(50) NOT NULL,
   PRIMARY KEY (`idV`),
   CONSTRAINT `fk_veicoli_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE -- AGGIUNTO: Il collegamento
);

CREATE TABLE `meccanici` (
   `idM` int(11) NOT NULL,
   `specializzazione` text DEFAULT NULL,
   `foto_profilo` varchar(255) DEFAULT NULL,
   `status` enum('in attesa','approvato', 'licenziato') DEFAULT 'in attesa',
   PRIMARY KEY (`idM`),
   CONSTRAINT `fk_meccanico_utente` FOREIGN KEY (`idM`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
);

CREATE TABLE `recensioni` (
   `idR` int(11) NOT NULL AUTO_INCREMENT,
   `idM` int(11) NOT NULL,
   `idU` int(11) NOT NULL,
   `valutazione` tinyint(1) NOT NULL DEFAULT '5',
   `commento` varchar(400) DEFAULT NULL,
   `data_recensione` timestamp DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`idR`),
   CONSTRAINT `fk_recensioni_meccanico` FOREIGN KEY (`idM`) REFERENCES `meccanici` (`idM`) ON DELETE CASCADE,
   CONSTRAINT `fk_recensioni_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
);

CREATE TABLE `preventivi` (
   `idPrev` int(11) NOT NULL AUTO_INCREMENT,
   `idU` int(11) NOT NULL,
   `idV` int(11) NOT NULL,
   `idS` int(11) NOT NULL,
   `descrizione` varchar(200) NOT NULL,
   `costo` int(11) DEFAULT NULL,
   `stato` enum('inviato','accettato') DEFAULT 'inviato',
   `pdf` varchar(50) DEFAULT NULL,
   `data_richiesta` timestamp DEFAULT CURRENT_TIMESTAMP,
   PRIMARY KEY (`idPrev`),
   CONSTRAINT `fk_preventivo_targa` FOREIGN KEY (`idV`) REFERENCES `veicoli` (`idV`) ON DELETE CASCADE,
   CONSTRAINT `fk_preventivo_servizio` FOREIGN KEY (`idS`) REFERENCES `servizi` (`idS`) ON DELETE CASCADE,
   CONSTRAINT `fk_preventivo_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
);

CREATE TABLE `prenotazioni` (
   `idPren` int(11) NOT NULL AUTO_INCREMENT,
   `idPrev` int(11) DEFAULT NULL,
   `idM` int(11) DEFAULT NULL,
   `idV` int(11) NOT NULL,
   `data` date NOT NULL,
   `ora` time NOT NULL,
   `stato` enum('in attesa','accettata', 'cancellata') DEFAULT 'in attesa',
   PRIMARY KEY (`idPren`),
   CONSTRAINT `fk_prenotazioni_preventivi` FOREIGN KEY (`idPrev`) REFERENCES `preventivi` (`idPrev`) ON DELETE CASCADE,
   CONSTRAINT `fk_prenotazioni_meccanico` FOREIGN KEY (`idM`) REFERENCES `meccanici` (`idM`) ON DELETE SET NULL,
   CONSTRAINT `fk_prenotazioni_veicolo` FOREIGN KEY (`idV`) REFERENCES `veicoli` (`idV`) ON DELETE CASCADE
);