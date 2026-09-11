-- Popolamento di prova per MechanicOne
-- Cancella tutti i dati esistenti e ricrea una situazione con copertura completa di ogni stato.
--
-- Password per TUTTI gli account creati qui: 00000000
-- (nel DB è salvato l'hash bcrypt di "00000000", perché il login confronta con password_verify();
--  se ci mettessi "00000000" in chiaro nessuno riuscirebbe più a loggarsi)

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
-- UTENTI (idU: 1-3 clienti, 4-6 meccanici — stessi 3 nomi, email diversa tra cliente e
-- meccanico dello stesso nome — 7 admin)
-- =========================================================
INSERT INTO utenti (nome, cognome, email, password, ruolo, ultimo_accesso, data_registrazione) VALUES
('Stefano', 'Arcieri', 'stefano.arcieri@example.com', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'cliente', '2026-09-08 09:12:00', '2026-03-10 10:00:00'),
('Anya', 'Nucci', 'anya.nucci@example.com', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'cliente', '2026-09-07 18:40:00', '2026-04-02 11:30:00'),
('Elisa', 'Perinetti', 'elisa.perinetti@example.com', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'cliente', '2026-09-08 21:05:00', '2026-05-15 09:15:00'),
('Stefano', 'Arcieri', 'stefano.arcieri@mechanicone.it', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'meccanico', '2026-09-09 08:00:00', '2026-01-20 08:00:00'),
('Anya', 'Nucci', 'anya.nucci@mechanicone.it', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'meccanico', '2026-09-09 07:50:00', '2026-02-11 08:00:00'),
('Elisa', 'Perinetti', 'elisa.perinetti@mechanicone.it', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'meccanico', '2026-09-09 12:00:00', '2026-06-01 08:00:00'),
('Marco', 'Bellini', 'admin@mechanicone.it', '$2y$10$5X2KhZ8HXgCz8v4DK7oEROzEiqfYEBCFJs4AMYe4U8HotCrgtOAZ2', 'admin', '2026-09-09 08:30:00', '2026-01-01 08:00:00');

-- =========================================================
-- MECCANICI (idM = idU del meccanico corrispondente: 4 Stefano, 5 Anya, 6 Elisa)
-- =========================================================
INSERT INTO meccanici (idM, specializzazione, foto_profilo) VALUES
(4, 'Motore e meccanica generale', NULL),
(5, 'Elettronica e diagnosi', NULL),
(6, 'Carrozzeria e freni', NULL);

-- =========================================================
-- SERVIZI (10, catalogo più ampio)
-- =========================================================
INSERT INTO servizi (titolo, descrizione) VALUES
('Cambio Olio', 'Sostituzione olio motore e filtro.'),
('Tagliando Completo', 'Controllo generale e sostituzione dei filtri principali.'),
('Revisione', 'Controllo obbligatorio periodico per sicurezza ed emissioni.'),
('Sostituzione Freni', 'Cambio pastiglie e dischi freno.'),
('Diagnosi Elettronica', 'Controllo centraline e sensori con strumentazione dedicata.'),
('Cambio Pneumatici', 'Sostituzione e bilanciatura gomme, stagionali o usurate.'),
('Climatizzazione', 'Ricarica gas e controllo tenuta impianto A/C.'),
('Sostituzione Batteria', 'Controllo carica e sostituzione batteria di avviamento.'),
('Allineamento e Convergenza', 'Regolazione angoli ruote per usura uniforme e guida stabile.'),
('Carrozzeria e Verniciatura', 'Riparazione ammaccature, graffi e verniciatura a richiesta.');

-- =========================================================
-- VEICOLI (idV: 1-3 Stefano, 4-5 Anya, 6-8 Elisa)
-- =========================================================
INSERT INTO veicoli (idU, targa, marca, modello) VALUES
(1, 'AB222CD', 'Volkswagen', 'Golf'),
(1, 'CF310GH', 'Fiat', 'Panda'),
(1, 'EL884KM', 'Audi', 'A3'),
(2, 'GT552NP', 'Toyota', 'Yaris'),
(2, 'HQ093RS', 'Ford', 'Fiesta'),
(3, 'JN671TV', 'BMW', 'Serie 1'),
(3, 'KP248WX', 'Renault', 'Clio'),
(3, 'LR935YZ', 'Peugeot', '208');

-- =========================================================
-- PREVENTIVI (16, distribuiti sui 4 stati possibili)
-- =========================================================
INSERT INTO preventivi (idU, idV, idS, descrizione, costo, stato, pdf, data_richiesta) VALUES
(1, 1, 1,  'Rumore leggero dal motore dopo 8000km, penso serva il cambio olio.', 45,   'svolto',    NULL, '2026-05-12 09:15:00'),
(1, 1, 3,  'Scade la revisione questo mese, vorrei prenotarla.',                 90,   'accettato', NULL, '2026-08-20 10:30:00'),
(1, 2, 4,  'Freni che stridono in frenata, da controllare con urgenza.',         NULL, 'inviato',   NULL, '2026-09-08 08:45:00'),
(1, 3, 9,  'Volante che vibra in autostrada oltre i 100km/h.',                   NULL, 'rifiutato', NULL, '2026-07-02 16:00:00'),
(1, 1, 7,  'Aria condizionata non raffredda più come prima.',                    70,   'svolto',    NULL, '2026-06-15 11:00:00'),
(2, 4, 2,  'Tagliando dei 40000km, filtri e controllo generale.',                150,  'accettato', NULL, '2026-08-28 14:20:00'),
(2, 4, 6,  'Gomme usurate, vorrei sostituirle prima dell''inverno.',             320,  'svolto',    NULL, '2026-07-10 09:00:00'),
(2, 5, 5,  'Spia motore accesa da qualche giorno.',                             NULL, 'inviato',   NULL, '2026-09-09 12:10:00'),
(2, 5, 8,  'La macchina fatica ad avviarsi al mattino.',                        NULL, 'rifiutato', NULL, '2026-06-01 07:50:00'),
(3, 6, 1,  'Cambio olio periodico.',                                            55,   'svolto',    NULL, '2026-05-25 10:00:00'),
(3, 6, 3,  'Revisione in scadenza a fine mese.',                                95,   'accettato', NULL, '2026-09-01 09:30:00'),
(3, 7, 10, 'Piccola ammaccatura sulla portiera posteriore.',                     NULL, 'inviato',   NULL, '2026-09-10 15:45:00'),
(3, 7, 4,  'Pastiglie freno consumate, sento un rumore metallico.',              180,  'svolto',    NULL, '2026-06-20 13:15:00'),
(3, 8, 9,  'Assetto da controllare dopo una buca presa forte.',                  60,   'accettato', NULL, '2026-08-15 08:30:00'),
(1, 2, 5,  'Controllo spia airbag accesa.',                                      40,   'svolto',    NULL, '2026-07-22 10:45:00'),
(2, 4, 3,  'Revisione da programmare.',                                        NULL, 'inviato',   NULL, '2026-09-11 09:00:00');

-- =========================================================
-- PRENOTAZIONI (20, distribuite sui 4 stati possibili — accettata/conclusa collegate al
-- preventivo accettato dello stesso cliente/veicolo dove ha senso)
-- =========================================================
INSERT INTO prenotazioni (idPrev, idM, idU, idV, data, ora, stato) VALUES
(2,    4,    1, 1, '2026-08-25', '09:00:00', 'conclusa'),
(NULL, NULL, 1, 2, '2026-09-15', '10:30:00', 'in attesa'),
(NULL, 5,    1, 3, '2026-07-05', '14:00:00', 'conclusa'),
(NULL, NULL, 1, 1, '2026-09-20', '11:00:00', 'in attesa'),
(NULL, 6,    1, 2, '2026-06-10', '09:30:00', 'cancellata'),
(6,    5,    2, 4, '2026-09-02', '15:00:00', 'accettata'),
(NULL, NULL, 2, 5, '2026-09-18', '10:00:00', 'in attesa'),
(NULL, 4,    2, 4, '2026-07-15', '08:30:00', 'conclusa'),
(NULL, NULL, 2, 5, '2026-06-05', '09:00:00', 'cancellata'),
(NULL, 6,    2, 4, '2026-08-10', '16:00:00', 'conclusa'),
(11,   6,    3, 6, '2026-09-12', '09:00:00', 'accettata'),
(NULL, NULL, 3, 7, '2026-09-14', '10:00:00', 'in attesa'),
(14,   5,    3, 8, '2026-08-20', '11:30:00', 'conclusa'),
(NULL, NULL, 3, 6, '2026-09-22', '09:00:00', 'in attesa'),
(NULL, 4,    3, 7, '2026-07-01', '15:30:00', 'cancellata'),
(NULL, NULL, 1, 3, '2026-09-25', '13:00:00', 'in attesa'),
(NULL, 6,    2, 5, '2026-08-05', '09:00:00', 'conclusa'),
(NULL, NULL, 3, 8, '2026-09-16', '14:30:00', 'in attesa'),
(NULL, 5,    1, 2, '2026-09-05', '10:00:00', 'accettata'),
(NULL, NULL, 2, 4, '2026-06-18', '08:00:00', 'cancellata');

-- =========================================================
-- RECENSIONI (12, distribuite sui 3 meccanici e i 3 clienti)
-- =========================================================
INSERT INTO recensioni (idM, idU, valutazione, commento, data_recensione) VALUES
(4, 1, 5, 'Lavoro fatto benissimo, tempi rapidi e prezzo onesto.', '2026-06-02 10:00:00'),
(4, 2, 4, 'Molto disponibile, spiega bene cosa fa e perché.', '2026-06-20 11:30:00'),
(4, 3, 5, 'Il migliore, ci torno sicuramente.', '2026-07-05 09:15:00'),
(5, 1, 4, 'Diagnosi precisa, ha risolto un problema che altri non trovavano.', '2026-07-18 14:00:00'),
(5, 2, 5, 'Gentile e competente, consigliato.', '2026-08-01 16:45:00'),
(5, 3, 3, 'Lavoro ok ma tempi un po'' lunghi.', '2026-08-10 10:20:00'),
(6, 1, 5, 'Ottima carrozzeria, macchina come nuova.', '2026-08-22 09:00:00'),
(6, 2, 4, 'Buon lavoro sui freni, prezzo giusto.', '2026-08-30 13:10:00'),
(6, 3, 5, 'Molto professionale e puntuale.', '2026-09-03 11:00:00'),
(4, 1, 3, 'Nella media, niente di eccezionale.', '2026-09-04 12:00:00'),
(5, 3, 5, 'Fantastico, risolto subito il problema elettrico.', '2026-09-06 15:30:00'),
(6, 1, 4, 'Consigliato per lavori di carrozzeria.', '2026-09-07 08:40:00');
