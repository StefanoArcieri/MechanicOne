-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mechanicone
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `meccanici`
--

DROP TABLE IF EXISTS `meccanici`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meccanici` (
  `idM` int(11) NOT NULL,
  `specializzazione` varchar(200) DEFAULT NULL,
  `status` enum('in attesa','approvato','licenziato') DEFAULT 'in attesa',
  PRIMARY KEY (`idM`),
  CONSTRAINT `fk_meccanico_utente` FOREIGN KEY (`idM`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meccanici`
--

LOCK TABLES `meccanici` WRITE;
/*!40000 ALTER TABLE `meccanici` DISABLE KEYS */;
INSERT INTO `meccanici` VALUES (3,'Specialista in trasmissioni e sistemi elettronici avanzati','approvato');
/*!40000 ALTER TABLE `meccanici` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prenotazioni`
--

DROP TABLE IF EXISTS `prenotazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prenotazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idP` int(11) DEFAULT NULL,
  `idM` int(11) DEFAULT NULL,
  `targa` varchar(7) NOT NULL,
  `data` date NOT NULL,
  `data_proposta` date DEFAULT NULL,
  `ora` time NOT NULL,
  `ora_proposta` time DEFAULT NULL,
  `stato` enum('in attesa','accettata','conclusa','cancellata') DEFAULT 'in attesa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_sovrapposizioni` (`idM`,`data`,`ora`),
  KEY `fk_prenotazioni_preventivi` (`idP`),
  KEY `fk_prenotazioni_veicolo` (`targa`),
  CONSTRAINT `fk_prenotazioni_meccanico` FOREIGN KEY (`idM`) REFERENCES `meccanici` (`idM`) ON DELETE SET NULL,
  CONSTRAINT `fk_prenotazioni_preventivi` FOREIGN KEY (`idP`) REFERENCES `preventivi` (`idP`) ON DELETE CASCADE,
  CONSTRAINT `fk_prenotazioni_veicolo` FOREIGN KEY (`targa`) REFERENCES `veicoli` (`targa`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prenotazioni`
--

LOCK TABLES `prenotazioni` WRITE;
/*!40000 ALTER TABLE `prenotazioni` DISABLE KEYS */;
INSERT INTO `prenotazioni` VALUES (3,1,3,'AA123BB','2024-06-15',NULL,'09:00:00',NULL,'accettata'),(4,11,3,'EE789FF','2027-11-11',NULL,'18:25:00',NULL,'accettata');
/*!40000 ALTER TABLE `prenotazioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `preventivi`
--

DROP TABLE IF EXISTS `preventivi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preventivi` (
  `idP` int(11) NOT NULL AUTO_INCREMENT,
  `idU` int(11) NOT NULL,
  `targa` varchar(7) DEFAULT NULL,
  `servizio` varchar(50) NOT NULL,
  `descrizione` varchar(200) NOT NULL,
  `descrizione_proposta` varchar(200) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL,
  `stato` enum('inviato','accettato','rifiutato','svolto') DEFAULT 'inviato',
  `pdf` varchar(50) DEFAULT NULL,
  `data_richiesta` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idP`),
  KEY `fk_preventivo_targa` (`targa`),
  KEY `fk_preventivo_servizio` (`servizio`),
  KEY `fk_preventivo_utente` (`idU`),
  CONSTRAINT `fk_preventivo_servizio` FOREIGN KEY (`servizio`) REFERENCES `servizi` (`titolo`) ON DELETE CASCADE,
  CONSTRAINT `fk_preventivo_targa` FOREIGN KEY (`targa`) REFERENCES `veicoli` (`targa`) ON DELETE CASCADE,
  CONSTRAINT `fk_preventivo_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preventivi`
--

LOCK TABLES `preventivi` WRITE;
/*!40000 ALTER TABLE `preventivi` DISABLE KEYS */;
INSERT INTO `preventivi` VALUES (1,2,'AA123BB','Cambio Olio','Tagliando annuale e controllo generale.',NULL,80,'accettato',NULL,'2026-04-13 10:23:32'),(2,2,'CC456DD','Check-up Estivo','Preparazione per viaggio lungo in Sicilia.',NULL,NULL,'inviato',NULL,'2026-04-13 10:23:32'),(3,3,'EE789FF','Sostituzione Freni','Fischio metallico durante la frenata.',NULL,150,'accettato',NULL,'2026-04-13 10:23:32'),(7,2,'AA123BB','Cambio Olio','Tagliando annuale e controllo generale.',NULL,80,'accettato',NULL,'2026-04-13 10:26:03'),(8,2,'CC456DD','Check-up Estivo','Preparazione per viaggio lungo in Sicilia.',NULL,NULL,'inviato',NULL,'2026-04-13 10:26:03'),(9,3,'EE789FF','Sostituzione Freni','Fischio metallico durante la frenata.',NULL,150,'accettato',NULL,'2026-04-13 10:26:03'),(10,2,'EE789FF','Check-up Estivo','no problema, checkup estivo!!',NULL,NULL,'inviato',NULL,'2026-04-13 10:26:50'),(11,2,'EE789FF','Check-up Estivo','porcodio',NULL,3000,'accettato',NULL,'2026-04-18 13:17:19');
/*!40000 ALTER TABLE `preventivi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servizi`
--

DROP TABLE IF EXISTS `servizi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servizi` (
  `titolo` varchar(50) NOT NULL,
  `descrizione` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`titolo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servizi`
--

LOCK TABLES `servizi` WRITE;
/*!40000 ALTER TABLE `servizi` DISABLE KEYS */;
INSERT INTO `servizi` VALUES ('Cambio Olio','Sostituzione olio motore e filtro per mantenere il motore efficiente.'),('Check-up Estivo','Controllo livelli, pressione gomme e ricarica clima per i lunghi viaggi.'),('Revisione','Controllo obbligatorio per la sicurezza e le emissioni del veicolo.'),('Sostituzione Freni','Cambio pastiglie e dischi per una frenata sempre sicura.');
/*!40000 ALTER TABLE `servizi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utenti` (
  `idU` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ruolo` enum('cliente','meccanico','admin') NOT NULL DEFAULT 'cliente',
  `ultimo_accesso` timestamp NULL DEFAULT NULL,
  `data_registrazione` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idU`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (1,'Sfesann','The King','sfesann@gmail.com','$2y$10$YPoRrV3LH/nppYbXaprfWObBNtT4XD6dy/dmguD7CvxwdaZ8FwSY6','admin',NULL,'2026-04-13 09:54:52'),(2,'Elisa','Maria Perinetti','elis@gmail.com','$2y$10$pj1ycZmA2ARL/6yGH90B9eDEYRY.fXe7DB5zHps0NX3PxP4m3QoDG','cliente',NULL,'2026-04-13 09:55:24'),(3,'Anna','Nucci','anna@gmail.com','$2y$10$5zzS5cSZc4b4D/NdrfYPf.afKxsiVaR/NZSmdn5IrSzuFPfnrZ1uq','meccanico',NULL,'2026-04-13 09:55:40');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `veicoli`
--

DROP TABLE IF EXISTS `veicoli`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `veicoli` (
  `targa` varchar(7) NOT NULL,
  `idU` int(11) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modello` varchar(50) NOT NULL,
  PRIMARY KEY (`targa`),
  KEY `fk_veicoli_utente` (`idU`),
  CONSTRAINT `fk_veicoli_utente` FOREIGN KEY (`idU`) REFERENCES `utenti` (`idU`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `veicoli`
--

LOCK TABLES `veicoli` WRITE;
/*!40000 ALTER TABLE `veicoli` DISABLE KEYS */;
INSERT INTO `veicoli` VALUES ('AA123BB',3,'Fiat','500X'),('CC456DD',2,'Lancia','Ypsilon'),('EE789FF',2,'Mercedes','Classe A');
/*!40000 ALTER TABLE `veicoli` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-14 11:48:34
