-- Popolamento di prova per MechanicOne
-- Cancella tutti i dati esistenti e ricrea una situazione plausibile con un po' di storico.
--
-- Password per TUTTI gli utenti creati qui: 1234
-- (nel DB è salvato l'hash bcrypt di "1234", perché il login confronta con password_verify();
--  se ci mettessi "1234" in chiaro nessuno riuscirebbe più a loggarsi)

SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE recensioni;
TRUNCATE TABLE prenotazioni;
TRUNCATE TABLE preventivi;
TRUNCATE TABLE veicoli;
TRUNCATE TABLE meccanici;
TRUNCATE TABLE utenti;
TRUNCATE TABLE servizi;
SET FOREIGN_KEY_CHECKS = 1;

-- =========================================================
-- UTENTI (idU: 1 Matteo, 2 Piz, 3 Thomas, 4 Anya, 5 Elisa, 6 Stefano, 7 Antonio)
-- =========================================================
INSERT INTO utenti (nome, cognome, email, password, ruolo, ultimo_accesso, data_registrazione) VALUES
('Matteo', 'Gao', 'matteo.gao@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'cliente', '2026-07-15 09:12:00', '2026-03-10 10:00:00'),
('Piz', 'Chiols', 'piz.chiols@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'cliente', '2026-07-14 18:40:00', '2026-04-02 11:30:00'),
('Thomas', 'Turbato', 'thomas.turbato@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'cliente', '2026-07-15 21:05:00', '2026-05-15 09:15:00'),
('Anya', 'Nuccia', 'anya.nuccia@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'meccanico', '2026-07-15 08:00:00', '2026-01-20 08:00:00'),
('Elisa', 'Perinetti', 'elisa.perinetti@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'meccanico', '2026-07-14 07:50:00', '2026-02-11 08:00:00'),
('Stefano', 'Arcieri', 'stefano.arcieri@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'meccanico', '2026-07-10 12:00:00', '2026-06-01 08:00:00'),
('Antonio', 'Nucci', 'antonio.nucci@example.com', '$2y$10$CXESTC2PvThzVlD9L4wYpeaD0vBccvZy949pC5diXvxhJTXBAWiaG', 'admin', '2026-07-16 08:30:00', '2026-01-01 08:00:00');

-- =========================================================
-- MECCANICI (idM = idU del meccanico corrispondente)
-- =========================================================
INSERT INTO meccanici (idM, specializzazione, foto_profilo, status) VALUES
(4, 'Motori e cambio', NULL, 'approvato'),
(5, 'Elettronica e diagnosi', NULL, 'approvato'),
(6, 'Carrozzeria e freni', NULL, 'in attesa');

-- =========================================================
-- SERVIZI
-- =========================================================
INSERT INTO servizi (titolo, descrizione) VALUES
('Cambio Olio', 'Sostituzione olio motore e filtro.'),
('Tagliando Completo', 'Controllo generale e sostituzione dei filtri principali.'),
('Revisione', 'Controllo obbligatorio per sicurezza ed emissioni.'),
('Sostituzione Freni', 'Cambio pastiglie e dischi freno.'),
('Diagnosi Elettronica', 'Controllo centraline e sensori con strumentazione dedicata.');

-- =========================================================
-- VEICOLI (idV: 1-2 Matteo, 3 Piz, 4-5 Thomas)
-- =========================================================
INSERT INTO veicoli (targa, idU, marca, modello) VALUES
('AB123CD', 1, 'Fiat', 'Panda'),
('CD456EF', 1, 'Volkswagen', 'Golf'),
('GH789IJ', 2, 'Toyota', 'Yaris'),
('KL012MN', 3, 'Mercedes', 'Classe A'),
('OP345QR', 3, 'Ford', 'Fiesta');

-- =========================================================
-- PREVENTIVI
-- =========================================================
INSERT INTO preventivi (idU, idV, idS, descrizione, descrizione_proposta, costo, stato, pdf, data_richiesta) VALUES
(1, 1, 1, 'Tagliando annuale, cambio olio e filtro.', NULL, 75, 'accettato', NULL, '2026-06-01 09:00:00'),
(1, 2, 4, 'Rumore metallico in frenata.', NULL, NULL, 'inviato', NULL, '2026-07-12 16:20:00'),
(2, 3, 3, 'Scadenza revisione a fine mese.', NULL, 120, 'svolto', NULL, '2026-05-20 10:00:00'),
(3, 4, 5, 'Spia motore accesa da ieri.', 'Spia motore accesa e leggero calo di potenza in accelerazione.', NULL, 'inviato', NULL, '2026-07-14 08:45:00'),
(3, 5, 1, 'Cambio olio prima del viaggio.', NULL, 70, 'accettato', NULL, '2026-07-05 11:10:00'),
(2, 3, 2, 'Tagliando 60000km.', NULL, NULL, 'rifiutato', NULL, '2026-06-10 14:30:00'),
(1, 1, 3, 'Revisione annuale.', NULL, 90, 'svolto', NULL, '2026-06-15 09:30:00');

-- =========================================================
-- PRENOTAZIONI
-- =========================================================
INSERT INTO prenotazioni (idPrev, idM, idV, idU, data, data_proposta, ora, ora_proposta, stato) VALUES
(1, 4, 1, 1, '2026-07-22', NULL, '09:00:00', NULL, 'accettata'),
(5, NULL, 5, 3, '2026-07-24', '2026-07-26', '15:00:00', '10:30:00', 'in attesa'),
(7, 4, 1, 1, '2026-06-20', NULL, '10:00:00', NULL, 'conclusa'),
(NULL, 5, 3, 2, '2026-07-23', NULL, '11:30:00', NULL, 'accettata'),
(NULL, NULL, 3, 2, '2026-06-18', NULL, '09:00:00', NULL, 'cancellata');

-- =========================================================
-- RECENSIONI
-- =========================================================
INSERT INTO recensioni (idM, idU, valutazione, commento, data_recensione) VALUES
(4, 1, 5, 'Servizio rapido e prezzo onesto, tornerò sicuramente.', '2026-06-25'),
(4, 3, 4, 'Molto professionale, un po'' di attesa per l''appuntamento.', '2026-07-01'),
(5, 2, 5, 'Ha risolto un problema elettrico che altri non trovavano.', '2026-05-22'),
(5, 1, 3, 'Lavoro fatto bene ma tempi un po'' lunghi.', '2026-06-12'),
(4, 2, 5, 'Disponibile e preciso, mi ha spiegato tutto il lavoro fatto.', '2026-07-08'),
(5, 3, 4, 'Diagnosi rapida sul problema elettrico, consigliato.', '2026-07-19');
