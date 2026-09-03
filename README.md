# MechanicOne

Applicazione web per la gestione di un'officina meccanica: i clienti registrano i propri veicoli,
richiedono preventivi e prenotazioni per gli interventi, e lasciano recensioni ai meccanici che li
hanno seguiti. I meccanici gestiscono le richieste che ricevono, l'amministratore governa l'intero
sistema (utenti, meccanici, servizi offerti).

Progetto d'esame del corso di Sviluppo di Applicazioni Web — sviluppato in PHP + MySQL, senza
framework, con Smarty come template engine.

Repository: https://github.com/StefanoArcieri/MechanicOne

## Indice

- [Stack tecnologico](#stack-tecnologico)
- [Attori e ruoli](#attori-e-ruoli)
- [Funzionalità](#funzionalità)
- [Architettura](#architettura)
- [Struttura del progetto](#struttura-del-progetto)
- [Installazione](#installazione)
- [Dati di prova](#dati-di-prova)
- [Scelte progettuali](#scelte-progettuali)
- [Documentazione aggiuntiva](#documentazione-aggiuntiva)
- [Team e contributi](#team-e-contributi)

## Stack tecnologico

| Livello       | Tecnologia                                   |
|---------------|-----------------------------------------------|
| Server        | Apache (XAMPP), PHP 8.2                       |
| Persistenza   | MySQL/MariaDB, accesso via PDO (prepared statement) |
| Template      | Smarty (incluso in `/smarty`, non via Composer) |
| Frontend      | HTML/CSS puro (nessun framework JS)           |
| Versionamento | Git / GitHub                                  |

Non è usato alcun framework PHP: il routing, il livello di persistenza e il pattern MVC sono
implementati "a mano" per lo scopo dell'esame (vedi [Architettura](#architettura)).

## Attori e ruoli

| Ruolo               | Descrizione                                                                 |
|----------------------|------------------------------------------------------------------------------|
| Visitatore (non registrato) | Vede la home pubblica, le recensioni e la media voti dei meccanici; può registrarsi |
| Cliente (`cliente`) | Aggiunge veicoli al proprio garage, richiede preventivi e prenotazioni, scrive recensioni |
| Meccanico (`meccanico`) | Gestisce il proprio profilo, i preventivi/prenotazioni a lui assegnati (deve essere approvato da un admin dopo la registrazione) |
| Amministratore (`admin`) | Approva/rimuove meccanici, gestisce il catalogo servizi, gestisce tutti i preventivi e le prenotazioni |

Il ruolo è scelto in fase di registrazione (cliente o meccanico); l'account admin non è
auto-registrabile e va creato direttamente a DB (vedi [Dati di prova](#dati-di-prova)).

## Funzionalità

### Visitatore non registrato
- Consultare home pubblica con recensioni e valutazione media dei meccanici
- Registrarsi come cliente o come meccanico

### Cliente
- Login / logout, con opzione "ricordami" (cookie sull'email, mai sulla password)
- Aggiungere/eliminare veicoli nel proprio garage
- Richiedere un preventivo per un veicolo e un servizio; consultare lo stato dei propri preventivi
- Richiedere una prenotazione (anche a partire da un preventivo accettato); modificarla o annullarla
- Scrivere una recensione a un meccanico approvato (voto 1-5 + commento)

### Meccanico
- Login / logout (in comune con il cliente)
- Creare/aggiornare il proprio profilo (specializzazione, foto)
- Consultare e gestire i preventivi e le prenotazioni a lui assegnati (accettare, proporre costo,
  segnare come svolto, concludere)

> Nota: attualmente `AccessControl` autorizza le rotte "lato cliente" (garage, preventivi,
> prenotazioni, recensioni) a chiunque sia autenticato, indipendentemente dal ruolo — quindi un
> meccanico può tecnicamente usare anche le funzioni cliente, anche se la sua dashboard
> (`home_meccanico.tpl`) non espone questi link. È un comportamento consapevole ma da discutere
> come possibile estensione (restringere per ruolo o, al contrario, dichiararlo esplicitamente
> come funzionalità: "un meccanico è anche un cliente dell'officina").

### Amministratore
- Approvare o eliminare le registrazioni dei meccanici
- Gestire il catalogo dei servizi offerti (aggiungere, eliminare)
- Gestire tutti i preventivi (assegnare costo, rifiutare, segnare svolti)
- Gestire tutte le prenotazioni (accettare, concludere, cancellare)

## Architettura

Front Controller + MVC "custom", senza framework:

```
Browser
   │  GET/POST /MechanicOne/<controller>/<metodo>/<param...>
   ▼
FrontController::run()
   │  1. Parsing dell'URL (Request::get('url'))
   │  2. AccessControl::verifica(controller, metodo) → ok / login / forbidden
   │  3. Istanzia il Controller e invoca il metodo
   ▼
Control/C<Nome>.php  (logica applicativa)
   │  usa PersistentManager per leggere/scrivere dati
   │  usa Session, Request, Cookie per stato/superglobali
   ▼
Foundation/PersistentManager  (facciata sul livello dati)
   │  smista verso la classe F<Nome> giusta in base al tipo di Entity
   ▼
Foundation/F<Nome>.php  (mini-ORM: una classe per entità, query PDO preparate)
   ▼
Entity/E<Nome>.php  (oggetti dato puri: getter/setter, nessuna logica SQL)

Control/C<Nome>.php
   ▼
View/V<Nome>.php → Smarty → templates/*.tpl  (presentazione)
```

Punti chiave:

- **Nessun accesso diretto alle superglobali nei controller.** `$_SESSION` passa da
  `Foundation/Session.php`, `$_POST`/`$_GET`/`$_SERVER` da `Foundation/Request.php`,
  `$_COOKIE` da `Foundation/Cookie.php`. Ogni controller include queste classi invece di toccare
  le superglobali direttamente.
- **Permessi centralizzati e dichiarativi** in `Foundation/AccessControl.php`: una mappa
  `controller → metodo → requisito` (`public`, `auth`, oppure un elenco di ruoli ammessi),
  verificata dal `FrontController` prima di istanziare qualunque controller.
- **Persistenza tramite PDO con prepared statement reali** (`PDO::ATTR_EMULATE_PREPARES => false`
  in `Foundation/config.php`), per prevenire SQL injection su tutte le query.
- **Mini-ORM custom** invece di un ORM di terze parti (es. Doctrine): vedi
  [Scelte progettuali](#scelte-progettuali).

## Struttura del progetto

```
MechanicOne/
├── index.php                 # entry point, istanzia il FrontController
├── database.sql              # DDL: creazione schema
├── seed.sql                  # dati di prova
├── Control/                  # controller applicativi (uno o più per macro-funzionalità)
├── Foundation/                # infrastruttura: Session, Request, Cookie, AccessControl,
│                              #   PersistentManager, config.php, F<Nome>.php (mini-ORM)
├── Entity/                   # oggetti dato (E<Nome>.php)
├── View/                     # wrapper Smarty per la presentazione (V<Nome>.php)
├── templates/                # template Smarty (.tpl), css, layouts/
├── templates_c/              # cache di compilazione Smarty (generata, non versionare)
├── smarty/                   # libreria Smarty vendorizzata (non tramite Composer)
└── docs/                     # documentazione di progetto (casi d'uso, ER, diagramma classi)
```

## Installazione

Prerequisiti: PHP 8.x, MySQL/MariaDB, Apache (consigliato XAMPP su Windows/Linux/Mac).

1. **Copia il progetto** nella cartella servita da Apache (es. `htdocs/MechanicOne` su XAMPP).
2. **Crea il database**: apri phpMyAdmin (o la CLI di MySQL) ed esegui, in ordine:
   - `database.sql` → crea lo schema (tabelle `utenti`, `veicoli`, `meccanici`, `servizi`,
     `preventivi`, `prenotazioni`, `recensioni`)
   - `seed.sql` → popola il database con dati di prova (utenti, veicoli, preventivi,
     prenotazioni, recensioni)
3. **Configura la connessione** in `Foundation/config.php` se il tuo MySQL non usa le impostazioni
   di default di XAMPP (`host=localhost`, utente `root`, password vuota, database `mechanicone`).
4. **Avvia Apache e MySQL** (dal pannello di controllo XAMPP).
5. Visita `http://localhost/MechanicOne/`.

Non è richiesto Composer: Smarty è incluso staticamente in `/smarty` e il resto del codice usa
`require_once` con path relativi.

## Dati di prova

`seed.sql` crea 7 utenti (3 clienti, 3 meccanici — di cui uno ancora "in attesa" di approvazione —
1 admin), veicoli, servizi, preventivi, prenotazioni e recensioni con uno storico plausibile.

Password di **tutti** gli utenti creati dal seed: `1234`
(nel database è salvato l'hash bcrypt, non la password in chiaro).

| Email                          | Ruolo     | Note                         |
|---------------------------------|-----------|------------------------------|
| matteo.gao@example.com          | cliente   |                               |
| piz.chiols@example.com          | cliente   |                               |
| thomas.turbato@example.com      | cliente   |                               |
| anya.nuccia@example.com         | meccanico | approvato                     |
| elisa.perinetti@example.com     | meccanico | approvato                     |
| stefano.arcieri@example.com     | meccanico | **in attesa** di approvazione |
| antonio.nucci@example.com       | admin     |                               |

## Scelte progettuali

- **ORM custom invece di Doctrine.** Il corso presenta Doctrine come ORM di riferimento, ma per
  questo progetto si è scelto di implementare un mini-ORM (`PersistentManager` + una classe
  `F<Nome>` per entità) per avere pieno controllo sul mapping oggetto-relazionale e capire a fondo
  cosa fa un ORM "sotto il cofano". `PersistentManager` funge da facciata: riceve richieste generiche
  (`load`, `store`, `update`, `delete`, `search`, `getAll`) su un'Entity e le smista alla classe
  `F<Nome>` corrispondente, che traduce in query PDO preparate.
- **Architettura REST**: non implementata in questa versione — il progetto usa un front controller
  con routing "tradizionale" (`/controller/metodo/parametri`) e risposte HTML renderizzate lato
  server con Smarty, non endpoint JSON. Valutata come possibile estensione futura (vedi discussione
  a lezione/esame).
- **Cookie**: usati per la funzione "ricordami" al login (`Foundation/Cookie.php` incapsula
  `$_COOKIE`/`setcookie()`) — viene ricordata solo l'email inserita, mai la password, per 30
  giorni, in un cookie `httponly` e `samesite=Lax`.
- **Transazioni SQL**: da introdurre nei flussi multi-tabella più delicati (es. creazione di un
  preventivo + prenotazione collegata, approvazione di un meccanico) per garantire atomicità;
  attualmente ogni operazione di scrittura è una singola query. Vedi `docs/` per il dettaglio.

## Documentazione aggiuntiva

- [`docs/casi-uso.md`](docs/casi-uso.md) — casi d'uso per ciascun attore
- [`docs/modello-concettuale.md`](docs/modello-concettuale.md) — modello concettuale / diagramma ER
- [`docs/diagramma-classi.md`](docs/diagramma-classi.md) — diagramma delle classi (Control, Foundation, Entity, View)

## Team e contributi

Progetto sviluppato da: Stefano Arcieri, annanucci, elisaperinetti.

Il contributo individuale in fase di implementazione è tracciabile dalle statistiche dei commit
della repository GitHub (`git shortlog -sne`).
