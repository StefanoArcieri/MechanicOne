# Ripasso MechanicOne — appunti per l'orale

Note personali di studio, non documentazione per il prof (quella è in `README.md` e `docs/`).
Scritte in stile "appunto da ripasso": la versione distillata di quello che è stato capito,
non il resoconto della chat. Aggiornate sessione per sessione.

---

## Sessione 1 — Il flusso di una richiesta (Front Controller)

**Il problema che risolve.** Senza Front Controller, ogni pagina sarebbe un file `.php`
a sé stante: login.php, garage.php, ecc. Ogni file dovrebbe ripetere da solo i controlli
di permesso, la gestione degli errori, l'inizializzazione. `index.php` + `FrontController`
fanno da imbuto unico: **tutte** le richieste passano di lì, quindi i controlli trasversali
si scrivono una volta sola.

**Cosa succede, in ordine, quando arriva una richiesta** (`FrontController::run()`):
1. Legge `url` da querystring (`Request::get('url')`) e lo spezza in pezzi: primo pezzo =
   controller (es. `garage` → classe `CGarage`), secondo = metodo (es. `lista`), il resto =
   parametri posizionali.
2. Se mancano pezzi, usa i default: `utente` come controller, `home` come metodo — per
   questo `/MechanicOne/` da solo apre la home.
3. **Controlla che la classe e il metodo esistano davvero** prima di fare qualunque altra
   cosa (`class_exists`, `method_exists`) → altrimenti 404/405. Questo evita che un URL
   sbagliato scritto da un utente non loggato finisca redirectato al login invece che a un
   "pagina non trovata" onesto.
4. **Solo dopo**, chiede ad `AccessControl::verifica($controller, $metodo)` se si può
   procedere. Risposta possibile: `ok` (via libera), `login` (serve autenticarsi → redirect),
   `forbidden` (loggato ma ruolo sbagliato → pagina 403).
5. Solo se tutto ok, istanzia il controller e chiama il metodo — dentro un `try/catch`
   generale: qualunque eccezione non gestita altrove diventa una pagina 500 pulita invece
   di un crash bianco.

**Perché il controllo permessi è un passo a parte, prima di tutto il resto.** `AccessControl`
è una mappa dichiarativa (`controller → metodo → chi può`): `'public'` (chiunque),
`'auth'` (basta essere loggati), oppure un array di ruoli (`['admin']`,
`['admin','meccanico']`). Il vantaggio: per sapere chi può fare cosa in tutto il sito basta
guardare **un file solo**, non andare a cercare `if` sparsi dentro ogni controller.

**Attenzione a non confondere due meccanismi diversi, che sembrano simili ma non lo sono:**
- Il controllo permessi è un **return-value check**: `AccessControl::verifica()` ritorna una
  stringa (`'ok' | 'login' | 'forbidden'`), il `FrontController` la legge con uno `switch` e
  se serve chiama subito `CErrori::mostraErrore(403, ...)`. Nessuna eccezione coinvolta, e
  il controller vero **non viene nemmeno istanziato**.
- Il `try/catch` attorno a `$real_controller->$method(...)` è un meccanismo **separato**,
  che scatta solo se il controller (dopo che i permessi hanno già detto "ok") esplode per
  un errore vero durante l'esecuzione (query fallita, dato mancante...) → quello diventa un 500.
- La whitelist dei permessi **non vive dentro `FrontController`**: vive in `AccessControl`,
  una classe a parte. Il FrontController si limita a chiederle il verdetto. È separazione
  delle responsabilità (coesione/accoppiamento): cambi le regole senza toccare il routing.

**Esempio che fissa la distinzione:** un cliente loggato prova ad aprire
`/gestiscimeccanici/lista` (riservata ad `admin`) → `AccessControl` ritorna `'forbidden'` →
`FrontController` mostra subito il 403, **senza mai chiamare il controller** → il `try/catch`
non entra mai in gioco in questo scenario.

**C'è un terzo livello, in `index.php`, ed è l'ultima rete di sicurezza.** Il `try/catch`
dentro `run()` copre solo l'esecuzione del controller (quando i permessi hanno già detto
"ok"). Ma `index.php` avvolge in un altro `try/catch` **tutto quanto**: il caricamento di
`FrontController.php` (che a sua volta carica AccessControl, Request e tutti i Control),
l'istanziazione, e l'intero `run()` — compresi i pezzi di `run()` che stanno *fuori* dal suo
try interno (lo `switch` dei permessi, i rami 404/405/403).

Questo catch in `index.php` è quindi **l'ultimo della fila**: se arriva fin lì qualcosa da
catturare, non è un errore "normale" di logica applicativa (quelli li prende già il catch
interno e restano contenuti), ma un **errore fatale che di fatto blocca l'intero sito** —
tipo il database che non risponde (connessione rifiutata, credenziali sbagliate), o un
errore di sintassi/caricamento stupido in un file che viene incluso prima ancora che il
routing parta. In questi casi non c'è più nulla di "gestibile" pagina per pagina: l'unica
cosa sensata è fermarsi e mostrare un 500 generico, che è esattamente quello che fa.

---

## Sessione 2 — Entity + mini-ORM (Foundation)

**Entity = solo dati, zero logica.** `ERecensione` ha proprietà private, un costruttore che
le riceve tutte, getter/setter, `toArray()`. Nessuna query SQL, nessun `$pdo`. È un
contenitore puro (DTO): se domani cambia come sono salvati i dati, il resto del codice che
*usa* una recensione (controller, view) non cambia — continua a chiamare `getValutazione()`
ecc.

**F&lt;Nome&gt; = il mini-ORM vero.** Sempre le stesse 6 operazioni: `load`, `store`, `update`,
`delete`, `search`, `getAll`. Ognuna: query preparata su PDO, esecuzione, se fallisce
`error_log()` + rilancio di un'`Exception` con messaggio leggibile (mai SQL crudo mostrato
all'utente). Il pezzo chiave è `mapRowToEntity()`: trasforma la riga grezza del DB (array
associativo) in un vero oggetto Entity — è letteralmente l'Object-Relational Mapping.

**Cosa cambia da un F&lt;Nome&gt; all'altro (confrontando `FRecensione` e `FVeicolo`):
solo 4 cose puntuali** — nome tabella nella query, elenco colonne in INSERT/UPDATE,
argomenti passati al costruttore dell'Entity dentro `mapRowToEntity`, messaggi d'errore.
Il resto (le 6 funzioni, la gestione errori) è identico, copia-incolla del pattern.

**PersistentManager = lo smistatore.** Non parla mai direttamente con una tabella. Riceve
`$pm->load('EMeccanico', 'idM', $idM)`, guarda la stringa `'EMeccanico'`, fa
`new FMeccanico()` dentro `getFoundationClass()` e gli passa la richiesta. Per
`store()`/`update()` usa `get_class($obj)` per capire da solo di che entità si tratta.

**Attenzione SQL injection (se il prof chiede):** in `load()`/`delete()`/`search()` il
*valore* è parametrizzato (`:value`, sicuro), ma il **nome del campo** (`$field`) è scritto
diretto nella stringa SQL — PDO non può parametrizzare nomi di colonna. Oggi non è un
problema perché `$field` arriva sempre da una stringa hardcoded nel controller, mai da
input utente diretto — ma è una falla potenziale se qualcuno la collegasse mai a
`Request::post(...)`.

### La mappa delle eccezioni (tutti i layer, in ordine)

- **Livello 0 — Foundation**: cattura `PDOException` (errore tecnico), `error_log()`,
  rilancia `Exception` leggibile. Mai un punto di arrivo.
- **Livello 1 — Control, quando c'è un try/catch locale**: es. `CAggiungiveicolo::aggiungiVeicolo()`
  e `CGarage::lista()` — ricatturano l'`Exception` e **ri-mostrano la stessa pagina/form**
  con l'errore dentro. L'utente resta dov'era, vede cosa ha sbagliato, riprova.
- **Livello 1-bis — Control senza try/catch locale**: es. `CGarage::eliminaVeicolo()` —
  azione-e-redirect senza un "form corrente" a cui tornare, l'eccezione risale senza fermarsi.
- **Livello 2 — `FrontController::run()`**: prende tutto ciò che non si è fermato prima,
  mostra una **pagina 500 generica** (diversa dal livello 1: qui è una pagina nuova, non la
  stessa pagina con un avviso).
- **Livello 3 — `index.php`**: ultima rete, per tutto ciò che sfugge anche a `run()`
  (caricamento file, crash nel rendering dell'errore stesso).

**In una riga**: Foundation traduce l'errore tecnico → risale al Control → *se* il
controller ha un try/catch locale, l'utente resta sulla stessa pagina con un avviso;
*se no*, risale a FrontController (pagina 500 generica); se anche quello salta,
index.php è l'ultima rete.

---

## Sessione 3 — Il pattern Controller

**Lo scheletro comune**, visto confrontando `CGarage` (proprietario singolo) e
`CGestisciprenotazioni` (condiviso admin/meccanico): un metodo-orchestratore (`lista`),
un metodo-dati riusabile da altri controller (`richiediLista`, `getVeicoliPersonali`), e
azioni di scrittura che ricostruiscono sempre l'**intero** oggetto Entity prima di chiamare
`update()` — perché `F<Nome>::update()` fa una `UPDATE` con tutte le colonne insieme, niente
aggiornamento parziale (limite consapevole del mini-ORM fatto a mano, un vero ORM come
Doctrine terrebbe traccia dei soli campi cambiati).

**L'arricchimento**: `arricchisci()` prende un'Entity grezza (solo ID: `idV`, `idU`, `idM`)
e la trasforma in dati leggibili (`veicoloLabel`, `clienteLabel`...) prima di passarla alla
View — la View non fa mai query, riceve sempre dati già pronti.

**Ruolo nei permessi ≠ ruolo nella logica**: `AccessControl` decide *se* puoi chiamare
`accetta()`. Dentro `accetta()`, il *comportamento* cambia comunque in base al ruolo di chi
esegue (`$idM = $ruolo === 'meccanico' ? Session::get('idU') : $prenData->getIdMeccanico();`
— un meccanico che accetta si auto-assegna la prenotazione, un admin no). Due decisioni
diverse, nello stesso metodo.

### Tre "finali" per un metodo controller, tre destinatari diversi

- **Finisce con `$view->mostra...()`** → metodo-vista: produce HTML, la richiesta finisce lì.
  (`CGarage::lista()`, `CAggiungiveicolo::nuovo()`)
- **Finisce con `header('Location: ...'); exit();`** → metodo-azione: ha appena scritto sul
  DB, non mostra nulla lui, rimanda il browser altrove. L'`exit()` non è opzionale: senza,
  il PHP continuerebbe a eseguire quel che segue nel metodo.
  (`CGestisciprenotazioni::accetta/concludi/cancella`, `CGarage::eliminaVeicolo`)
- **Finisce con un `return` semplice** → metodo-dati: non pensato per essere chiamato da una
  rotta URL, ma da altro codice PHP (un altro controller) che ne riusa il risultato.
  (`richiediLista()`, `getVeicoliPersonali()`)

### Le eccezioni non sono solo guasti tecnici — sono anche regole di business

Righe come `if ($voto < 1 || $voto > 5) throw new Exception(...)` non segnalano un errore
del server: segnalano che **l'utente ha violato una regola dell'app** (input non valido,
stato incoerente, azione non sua). Si riusa lo stesso meccanismo (`throw`) sia per "il
server ha un problema" sia per "questa richiesta non è ammessa" — ma questo crea un rischio:
se un'eccezione di *business* finisce in un metodo **senza** catch locale, risale fino a una
pagina 500 generica, fuorviante per un errore che in realtà è solo "hai compilato male il
form".

### Il catch locale non è universale — verificato su tutti i controller

- **Sempre presente** in ogni `lista()` di ogni controller (7/7): sono pagine di lettura
  aperte di routine, devono degradare con garbo, non esplodere.
- **Presente nei submit-di-form** (validazione + ri-mostra lo stesso form in caso di errore):
  `CAggiungiveicolo::aggiungiVeicolo`, `CGestisciservizi::aggiungiServizio`,
  `CRichiediprenotazione::prenota`, `CRichiedipreventivo::richiedi`, `CUtente::login`,
  `CUtente::registrazione`, `CProfilomeccanico::aggiornaProfilo`.
- **Assente di proposito** nelle azioni-comando pure (click su un bottone, non un form da
  ricompilare): `accetta/concludi/cancella`, `updateCosto/rifiuta/segnaSvolto`,
  `approvaMeccanico/eliminaMeccanico`, `eliminaVeicolo`, `eliminaServizio` — qui un 500
  generico come fallback è accettabile, non c'è un form a cui tornare.
- **Anomalia trovata**: `CScrivirecensione::scrivi()` è a tutti gli effetti un
  submit-di-form (voto + commento, validazione business) ma **non ha il catch locale** —
  dovrebbe comportarsi come `aggiungiVeicolo`/`richiedi`/`prenota`, invece un voto non
  valido oggi finisce in una pagina 500 invece che come messaggio sul form. Incoerenza
  reale, buona da citare a esame.

### Domanda ancora aperta
`CGestisciprenotazioni::richiediLista()` fa `$pm->getAll('EPrenotazione')` — **nessun
filtro per meccanico**. Un meccanico che apre "prenotazioni da gestire" vede tutte le
prenotazioni di tutti, o solo le sue? Da verificare/discutere come possibile estensione.

---

## Sessione 4 — Sessioni PHP e superglobali incapsulate

**Perché incapsulare, vantaggio per vantaggio:**
- `Session.php`: non devi ricordarti tu di chiamare `session_start()` — lo fa lui
  internamente prima di ogni `get`/`set`. Più un'API leggibile invece di maneggiare
  `$_SESSION` a mano ovunque.
- `Request.php`: un default incorporato una volta sola (niente `$_POST['x'] ?? ''`
  ripetuto in 14 controller), nomi parlanti (`isPost()` invece di confrontare stringhe
  su `$_SERVER`).
- `Cookie.php`: le opzioni di sicurezza (`httponly`, `samesite`, scadenza) scritte
  **una sola volta** dentro `set()`/`delete()` — non rischi di dimenticarle se un domani
  serve un secondo cookie.

Non è un incapsulamento "vero" (che nasconde il dato): sono wrapper, centralizzano il
punto di contatto con la superglobale, non la eliminano. Ma è ciò che il regolamento
chiede (punto 2g.ii).

### GET e POST, in breve

- **GET**: dato nell'URL, per *leggere*, ripetibile senza conseguenze. `Request::get('url')`
  in `FrontController` — l'unico uso GET nel progetto, per il routing.
- **POST**: dato nel corpo della richiesta, per *scrivere/modificare*. Tutti i form
  (`CUtente::login`, `CAggiungiveicolo::aggiungiVeicolo`, `CScrivirecensione::scrivi`...).

### Il form che "si autoinvia" — non è un'attesa, sono due richieste separate

Nel `.tpl` il form ha `method="POST"` e come `action` **lo stesso URL** del metodo che lo
mostra (es. `login.tpl` → `action="/MechanicOne/utente/login"`, stesso URL di
`CUtente::login()`). Questo spiega l'`if (Request::isPost() && ...)`: **non è il
controller che "aspetta"** — PHP non blocca né mette in pausa nulla dentro
un'esecuzione. Sono **due richieste HTTP completamente separate e indipendenti** allo
stesso URL:
1. Prima richiesta (GET, l'utente clicca "Accedi"): `isPost()` è falso → si salta il
   blocco → si mostra il form vuoto.
2. L'utente compila e preme "invia": il browser fa una **nuova** richiesta, stavolta
   POST, allo stesso URL. PHP esegue `login()` **da capo, da zero** — non "riprende" da
   dove aveva lasciato la prima volta. Stavolta `isPost()` è vero → il blocco elabora le
   credenziali.

L'`if` è quindi il modo per far comportare **diversamente lo stesso metodo** a seconda
di quale delle due richieste (mostra il form / processa i dati) lo sta chiamando — non
un'attesa bloccante.

### La regola per capire quando un controller usa Request::

Solo quando deve leggere **input nuovo appena arrivato** (form o URL grezzo). Non serve
quando il dato arriva già come **parametro del metodo** (es. `accetta($idPren)` — il
`FrontController` l'ha già estratto dall'URL e lo passa come argomento PHP), né quando
si legge dalla **sessione** (`Session::get('idU')` — stato già noto, non input nuovo).

### Come funzionano davvero le sessioni PHP (prioritario, a prescindere dal codice)

Punto di partenza: **HTTP è stateless**, ogni richiesta è indipendente. Le sessioni
aggirano il problema così:
1. Alla prima `session_start()`, PHP genera un **ID casuale lunghissimo** e lo manda al
   browser come cookie (`PHPSESSID`), via header `Set-Cookie`.
2. Il browser rimanda **automaticamente** quel cookie ad ogni richiesta successiva verso
   lo stesso sito.
3. Sul **server**, PHP tiene un file (`sess_<ID>`) con dentro tutto quello che hai messo
   in `$_SESSION`, serializzato.
4. Ad ogni richiesta, `session_start()` legge l'ID dal cookie in arrivo, trova il file
   giusto sul server, e lo ricarica in `$_SESSION`.

**Il punto da saper dire chiaro**: nel browser non c'è mai il dato vero (ruolo, nome) —
solo un ID casuale. Il dato reale vive sul server. Opposto del cookie "ricordami", dove
il dato (l'email) sta davvero nel browser.

**Bonus da sessione 1**: la riga `Session::get('idU');` buttata via in `index.php` ha
senso perché forza `session_start()` a girare prestissimo, prima di qualunque output —
necessario perché deve poter mandare l'header `Set-Cookie`.

### Cookie vs Sessione, e altri usi possibili

**Perché cookie e non sessione per "ricordami l'email"**: la sessione (di default) muore
alla chiusura del browser — dura solo la visita corrente. Il cookie ha una scadenza scelta
da te (30 giorni) e sopravvive alla chiusura del browser. "Ricordami" ha senso solo se
resta anche dopo aver chiuso tutto — la sessione non potrebbe mai farlo.

**Altri usi possibili di Cookie, se si volesse espandere** (idee, non implementate): tema
chiaro/scuro persistente, ultimo veicolo selezionato nel garage, banner
cookie/privacy, un vero "resta connesso" con token casuale sicuro (non la password) per
il login automatico anche a sessione scaduta.

---

## Sessione 5 — Login, ruoli, permessi

Molto già toccato nelle sessioni precedenti (specialmente la 4). Qui il pezzo nuovo è
la verifica password, più un consolidamento del resto.

**Password: hash, mai in chiaro.** `FUtente::store()` (registrazione) fa
`password_hash($password, PASSWORD_DEFAULT)` prima di scrivere nel DB — a senso unico,
non si può "ridecifrare". `FUtente::verificaLogin()` (login) non decifra nulla: prende
la password appena scritta e usa `password_verify($password, $row['password'])`, che
ricalcola l'hash e confronta, in modo resistente ai timing attack.

**Bug latente trovato**: `FUtente::update()` (riga 62) scrive `$utente->getPassword()`
**senza** `password_hash()`. Oggi non è un problema — niente nel codice chiama
`PersistentManager::update()` su un `EUtente` — ma se un domani si aggiungesse "cambia
password" usando questo `update()` così com'è, si salverebbe la password in chiaro.
Trappola silenziosa da controllare prima di aggiungere quella funzionalità.

**Login, end-to-end**: `isPost()+hasPost('email','password')` → `verificaLogin()` → se
torna un `EUtente`: `Session::set` di idU/nome/ruolo, poi cookie "ricordami" (set o
delete a seconda della checkbox), poi redirect a `utente/home`. Se torna `null`:
`throw`, catturata localmente (gruppo "submit-di-form", sessione 3), form ricaricato
con l'errore.

**Registrazione, end-to-end**: costruisce `EUtente` → **transazione** (sessione 2: se
ruolo meccanico si scrive anche su `meccanici`) → `store(EUtente)` → se meccanico,
anche `store(EMeccanico)` con `status='in attesa'` → `commit()` → **auto-login**
diretto (niente bisogno di rifare login) → redirect. Fallimento nel mezzo → `rollback()`
→ errore sul form.

**Ruolo nei permessi, la decisione presa**: le rotte lato-cliente (garage, preventivi,
prenotazioni, recensioni) sono riservate a `['cliente']`, non più `'auth'` generico —
un meccanico che vuole essere anche cliente si crea un secondo account. Verificato con
test reali: meccanico su `/garage/lista` → 403.

**Logout**: `Session::destroy()` + redirect al login. Nessuna logica di business.

---

## Sessione 6 — Views e Smarty

**View.php: perché ogni pagina "sa già" chi sei.** Il costruttore configura Smarty, poi
chiama `initializeCommonData()`, che assegna **automaticamente a ogni singola pagina**
tre variabili lette dalla sessione: `isLogged`, `userRole`, `nomeUtente`. Ecco perché
`base.tpl` può fare `{if $isLogged}` e `{if $userRole == 'meccanico'}` senza che nessun
controller gliele passi esplicitamente — sono già lì, iniettate una volta per tutte
nella classe base (collegamento diretto con la sessione 5: è la sessione PHP che
alimenta il menu di navigazione).

**renderTemplate()**: `assignData($dati)` + `display($tpl)` in un colpo solo — il modo
standard con cui ogni View passa i dati al template. `VUtente` inizialmente non lo usava
(faceva `assign()`+`display()` separati) — sistemato, ora usa `renderTemplate()` come
tutte le altre View.

**`extends` — per pagine complete.** `{extends file='layouts/base.tpl'}` vuol dire
"questa è una pagina intera, costruita sopra questo scheletro condiviso" — le serve,
altrimenti non avrebbe `<html>`, menu, CSS. Il figlio riempie i blocchi dichiarati dal
genitore (`title`, `content`) — nomi **scelti da voi** in `base.tpl`, non parole magiche
di Smarty: se il blocco si chiamasse diversamente, il figlio dovrebbe usare quel nome
esatto.

**`include` — per frammenti che non stanno mai in piedi da soli.** `scrivirecensione.tpl`
non ha `extends`, non ha `<html>` — è solo un `<section>` nudo. Non è una "pagina
indipendente che decidiamo di includere": è un pezzo pensato apposta per non reggersi da
solo, che esiste solo per essere incollato (via `{include}`) dentro pagine che lo
scheletro ce l'hanno già — così il form recensione non va duplicato sia in `home.tpl`
che in `home_utente.tpl`.

**Le sottocartelle, in breve**: `utente/`, `meccanico/`, `admin/` per i template
esclusivi di ruolo; `login.tpl`, `registrazione.tpl`, `home.tpl`, `errore.tpl`,
`layouts/`, `css/` restano in root, condivisi da più ruoli o pubblici.

---

## Sessione 7 — La storia scritta nei commit

Non codice questa volta: la cronologia vera del repository, giorno per giorno, con i
dettagli concreti trovati nei diff e le intenzioni che si intuiscono da quei dettagli
(non inventate: sempre ancorate a un fatto verificabile nel commit).

**12 maggio** — `d626c69` "Update config e session", `096c823` "Creazione classi Entity
oggetto", `f070362` (7 min dopo) "Creazione delle Entity". Guardando il diff, `f070362`
non è solo uno spostamento: le 6 Entity vengono spostate in `Entity/` **e** riscritte
per buona parte (il conteggio delle righe cambiate è quasi il doppio della loro
dimensione originale). Probabile intenzione: appena capito che serviva una cartella
dedicata, ne hanno approfittato per sistemare anche il contenuto, non solo la posizione.
→ Sessione 2

**13 maggio** — `f666e9c` "Add files via upload", `b929541` "Correzione: correzione di
alcune query negli FObject e creazione dei campi idV/idS, dato che l'utilizzo della
targa e del titolo come PK non era totalmente funzionale", `7c14efe` merge, `0129bae`
"eliminazione commit errato", `38b32bc` "aggiunta del control utente index registrazione
e login", `c2cc1bc` "correzione delle query nel load, delete e search di tutti gli
FObject". Il ragionamento dietro `b929541` si intuisce dal problema stesso: usare la
targa (una stringa, in teoria modificabile) come chiave da cui altre tabelle dipendono è
scomodo da referenziare — un ID numerico dedicato risolve alla radice. `c2cc1bc`, poche
ore dopo, tocca **tutti** gli FObject con lo stesso tipo di fix: segno che a quel punto
il pattern delle 6 operazioni (load/store/update/delete/search/getAll) era già
stabilizzato, e la correzione andava propagata ovunque in modo uniforme. Nasce anche
`CUtente`. → Sessioni 2, 5

**21 maggio** — `e1fcbf2` "Creazione classi Control", `28d0e8f` merge, `f7e3c02`
"Correzione CUtente". La scelta di un controller per entità qui ricalca esattamente
com'è organizzato Foundation (un `F<Nome>` per tabella) — un'estensione naturale ma
sbagliata: Foundation è giustamente uno-per-tabella perché parla di *dati*, mentre un
controller dovrebbe parlare di *cosa fa l'utente*, non di quale riga tocca. È il
presupposto implicito che verrà smontato il 15 luglio. → Sessione 3

**4 giugno** — `214ac59` "Initialize composer.json file", `14fdaf2` "creazione del
front controller e inizializzazione della view (non funziona!!!!!)". Il secondo
commit, guardato da vicino, importa **l'intera libreria Smarty** in un colpo solo
(centinaia di file, quasi 48.000 righe) e nello stesso momento rinomina
`Presentation/login.php`/`registrazione.php` in `View/`. Hanno preso in mano tutto
Smarty e provato a collegarlo lo stesso giorno — spiega perché "non funziona": troppo
in un colpo solo per digerirlo subito. Piccola ironia su `composer.json`: nasce con
l'intenzione di gestire Smarty via Composer, ma alla fine Smarty resterà vendorizzato a
mano in `/smarty`, mai davvero gestito da Composer. → Sessioni 1, 6

**10 giugno** — `47c5554` "creazione classi view, templates, nuovo login e nuova
registrazione (da sistemare)". Sei giorni dati a leggere/capire la libreria importata
il 4 giugno hanno dato frutto: `login.php`/`registrazione.php` procedurali vengono
cancellati per davvero, sostituiti da `login.tpl`/`registrazione.tpl` e una
`VUtente.php` ampliata. → Sessione 6

**14 giugno** — `fc6c2f5` "correzione login.tpl". Un fix isolato su un solo template —
verosimilmente un problema di rendering notato provando il login appena riscritto
quattro giorni prima.

**19 giugno** — `d6aa8e8` "divisione dashboard per tipologia di utente". Dettaglio nel
diff: nasce prima `home_cliente.tpl`, rinominata `home_utente.tpl` solo più avanti —
segno che anche il vocabolario dei ruoli ("cliente" o "utente"?) era ancora in
assestamento, non solo la struttura tecnica. → Sessione 6

**30 giugno** — `6f8bab7` "Commit generale: ... Foundation ed Entity dovrebbero essere
perfette ora... gestione eccezioni da migliorare fino al FrontController". Non tocca
codice in modo sostanziale: è un punto della situazione scritto a mente lucida, con una
lista precisa di cosa manca — che si rivelerà essere anche la roadmap per il giorno dopo.

**1 luglio** — `b7a11d0` "gestione eccezioni: ... seguendo la logica delle view driven
e delle action driven". Risponde punto per punto a quanto scritto il giorno prima.
Nasce qui, con questo nome esatto, la distinzione che studiamo ancora oggi. → Sessione 3

**15 luglio** — `21b870f` "modifica control layer: abbiamo riadattato tutto il control
layer alla struttura specificata dal prof nelle slide". Il diff tocca 82 file in un
colpo solo (oltre 3300 righe aggiunte) — non un aggiustamento incrementale, una
riscrittura coordinata dell'intero livello Control. `AccessControl.php` nasce nello
stesso commit, non in uno successivo: risolvendo "un controller per funzione", si sono
probabilmente accorti nello stesso momento che serviva anche un posto solo per i
permessi, coerente con la nuova struttura. → Sessioni 1, 3

**16 luglio** — `1e88ed0` "aggiunta di accesscontrol e creazione dei tpl". Il giorno
dopo un pivot da 82 file, restano quasi sempre dei dettagli scoperti solo provando il
sito: qui si rifinisce `AccessControl` e si completano i template rimasti indietro.
→ Sessione 1

**29 agosto** — `364bbcb` "Aggiungi logout al menu a tendina e menu diverso per ruolo".
Un salto di **sei settimane** rispetto al commit precedente — poi l'ultima rifinitura
visibile, il menu che studiamo ancora oggi in `base.tpl`. → Sessioni 1, 6

---

<!-- Le prossime sessioni si aggiungono qui via via. -->
