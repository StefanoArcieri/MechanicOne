# Casi d'uso

Ogni caso d'uso è annotato con il controller e il metodo che lo implementano
(`Controller::metodo`), utile per la verifica sul codice.

## Attore: Visitatore (utente non registrato)

| # | Caso d'uso | Implementazione | Note |
|---|------------|------------------|------|
| V1 | Consultare la home pubblica con le recensioni dei meccanici e la valutazione media | `CUtente::home` → `mostraHomePubblica` | Nessun login richiesto (`AccessControl`: `utente/home` = `public`) |
| V2 | Registrarsi come cliente o come meccanico | `CUtente::registrazione` | Sceglie il ruolo nel form; se `meccanico`, viene creato anche un record `EMeccanico` con `status = 'in attesa'` |
| V3 | Accedere (login) | `CUtente::login` | Con opzione "ricordami" (cookie sull'email) |

## Attore: Cliente

*(precondizione comune: utente autenticato, `ruolo = cliente` — ma vedi nota in README sulle rotte
condivise con il meccanico)*

| # | Caso d'uso | Implementazione | Note |
|---|------------|------------------|------|
| C1 | Vedere la propria dashboard | `CUtente::home` → `mostraDashboardUtente` | Include riepilogo recensioni |
| C2 | Aggiungere un veicolo al garage | `CAggiungiveicolo::nuovo` (form) / `CAggiungiveicolo::aggiungiVeicolo` (submit) | |
| C3 | Consultare/eliminare i propri veicoli | `CGarage::lista`, `CGarage::getVeicoliPersonali`, `CGarage::eliminaVeicolo` | |
| C4 | Richiedere un preventivo per un veicolo + servizio | `CRichiedipreventivo::nuovo` / `CRichiedipreventivo::richiedi` | Stato iniziale `inviato` |
| C5 | Consultare lo stato dei propri preventivi, modificare la richiesta | `CVisualizzapreventivi::lista/getPreventiviUtente/modifica/annullaModifica` | |
| C6 | Richiedere una prenotazione (anche a partire da un preventivo accettato) | `CRichiediprenotazione::nuovo` / `CRichiediprenotazione::prenota` | |
| C7 | Consultare/modificare/annullare le proprie prenotazioni | `CVisualizzaprenotazioni::lista`, `getPrenotazioniUtente`, `modifica`, `annullaModifica`, `annullaPrenotazione` | |
| C8 | Scrivere una recensione a un meccanico approvato | `CScrivirecensione::scrivi` | Rifiutata se il meccanico non è `approvato` |
| C9 | Uscire (logout) | `CUtente::logout` | Distrugge la sessione |

## Attore: Meccanico

*(precondizione: utente autenticato, `ruolo = meccanico`; per operare deve inoltre risultare
`approvato` da un admin)*

| # | Caso d'uso | Implementazione | Note |
|---|------------|------------------|------|
| M1 | Vedere la propria dashboard | `CUtente::home` → `mostraDashboardMeccanico` | |
| M2 | Creare/consultare il proprio profilo (specializzazione, foto) | `CProfilomeccanico::area`, `getProfilo`, `profilo` | |
| M3 | Aggiornare il proprio profilo | `CProfilomeccanico::aggiornaProfilo` | Riservato al ruolo `meccanico` |
| M4 | Consultare i preventivi a lui assegnati | `CGestiscipreventivi::lista/richiediLista` | Accesso condiviso con `admin` |
| M5 | Proporre un costo, segnare un preventivo come svolto | `CGestiscipreventivi::updateCosto` *(solo admin)*, `segnaSvolto` | `updateCosto`/`rifiuta` riservati all'admin; `segnaSvolto` condiviso |
| M6 | Consultare/accettare/concludere le prenotazioni a lui assegnate | `CGestisciprenotazioni::lista/richiediLista/accetta/concludi` | Accesso condiviso con `admin`; `cancella` riservato all'admin |

## Attore: Amministratore

*(precondizione: utente autenticato, `ruolo = admin`)*

| # | Caso d'uso | Implementazione | Note |
|---|------------|------------------|------|
| A1 | Approvare la registrazione di un meccanico | `CGestiscimeccanici::approvaMeccanico` | Cambia `status` da `in attesa` ad `approvato` |
| A2 | Rimuovere un meccanico | `CGestiscimeccanici::eliminaMeccanico` | |
| A3 | Consultare l'elenco dei meccanici (con stato) | `CGestiscimeccanici::lista/richiediLista/arricchisciConNome` | |
| A4 | Aggiungere un servizio al catalogo | `CGestisciservizi::aggiungiServizio` | |
| A5 | Rimuovere un servizio dal catalogo | `CGestisciservizi::eliminaServizio` | |
| A6 | Consultare il catalogo servizi | `CGestisciservizi::lista/richiediLista` | |
| A7 | Assegnare un costo a un preventivo, rifiutarlo | `CGestiscipreventivi::updateCosto`, `rifiuta` | |
| A8 | Cancellare una prenotazione | `CGestisciprenotazioni::cancella` | |
| A9 | Vedere la propria dashboard | `CUtente::home` → `mostraDashboardAdmin` | |

## Trasversali (tutti gli attori autenticati)

| # | Caso d'uso | Implementazione | Note |
|---|------------|------------------|------|
| T1 | Accesso negato a rotte non permesse | `FrontController::run` → `AccessControl::verifica` | Redirect al login (utente non autenticato) o pagina 403 (ruolo non autorizzato) |
| T2 | Pagina non trovata / metodo inesistente | `FrontController::run` → `CErrori::mostraErrore` | HTTP 404 / 405 |
| T3 | Errore applicativo generico | `FrontController::run` (catch `Throwable`) → `CErrori::mostraErrore` | HTTP 500 |
