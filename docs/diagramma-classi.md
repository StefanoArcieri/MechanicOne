# Diagramma delle classi

Il codice lato server è organizzato in 4 livelli (`Foundation`, `Entity`, `Control`, `View`) più un
front controller. Di seguito il diagramma per livello, invece di un unico grafo (sarebbe
illeggibile con oltre 30 classi).

## 1. Front Controller e infrastruttura trasversale

```mermaid
classDiagram
    class FrontController {
        +run()
    }
    class AccessControl {
        -rules : array
        -default : string
        +verifica(controllerInput, method) string
    }
    class Session {
        +start()
        +set(key, value)
        +get(key)
        +has(key)
        +remove(key)
        +destroy()
    }
    class Request {
        +post(key, default) mixed
        +get(key, default) mixed
        +hasPost(...keys) bool
        +method() string
        +isPost() bool
    }
    class Cookie {
        +get(key, default) mixed
        +has(key) bool
        +set(key, value, days)
        +delete(key)
    }

    FrontController --> AccessControl : verifica permessi
    FrontController --> Request : legge url/metodo HTTP
    FrontController ..> "C*" : istanzia ed invoca

    note for AccessControl "Incapsula $_SESSION indirettamente\ntramite Session per leggere il ruolo corrente"
    note for Request "Incapsula $_POST / $_GET / $_SERVER:\nnessun controller le tocca direttamente"
    note for Cookie "Incapsula $_COOKIE / setcookie():\nusata per il 'ricordami' in login"
```

## 2. Livello dati: Entity + mini-ORM (Foundation)

Tutte le classi `F<Nome>` (una per entità) implementano la stessa interfaccia informale — non è
dichiarata a codice come `interface` PHP, ma il pattern è identico ovunque:

```mermaid
classDiagram
    class PersistentManager {
        -instance : PersistentManager$
        -pdo : PDO
        +getInstance() PersistentManager$
        +store(obj) mixed
        +update(obj) bool
        +load(entityName, field, value) Entity
        +search(entityName, field, value) Entity[]
        +getAll(entityName) Entity[]
        +delete(entityName, field, value) bool
        +verificaLogin(email, password) EUtente
        -getFoundationClass(entityName) F
    }

    class F_Interfaccia {
        <<pattern comune>>
        +load(field, value, pdo) Entity
        +store(entity, pdo) bool
        +update(entity, pdo) bool
        +delete(field, value, pdo) bool
        +search(field, value, pdo) Entity[]
        +getAll(pdo) Entity[]
        -mapRowToEntity(row) Entity
    }

    class FUtente
    class FMeccanico
    class FVeicolo
    class FServizio
    class FPreventivo
    class FPrenotazione
    class FRecensione

    PersistentManager --> F_Interfaccia : delega in base al tipo di Entity
    F_Interfaccia <|.. FUtente
    F_Interfaccia <|.. FMeccanico
    F_Interfaccia <|.. FVeicolo
    F_Interfaccia <|.. FServizio
    F_Interfaccia <|.. FPreventivo
    F_Interfaccia <|.. FPrenotazione
    F_Interfaccia <|.. FRecensione

    class EUtente {
        -idU : int
        -nome : string
        -cognome : string
        -email : string
        -password : string
        -ruolo : string
        -ultimo_accesso : string
        -data_registrazione : string
    }
    class EMeccanico {
        -idM : int
        -specializzazione : string
        -foto_profilo : string
        -status : string
    }
    class EVeicolo {
        -idV : int
        -idU : int
        -targa : string
        -marca : string
        -modello : string
    }
    class EServizio {
        -idS : int
        -titolo : string
        -descrizione : string
    }
    class EPreventivo {
        -idPrev : int
        -idU : int
        -idV : int
        -idS : int
        -costo : int
        -stato : string
        -descrizione : string
        -descrizioneProposta : string
        -pdf : string
        -data_richiesta : string
    }
    class EPrenotazione {
        -idPren : int
        -idPrev : int
        -idM : int
        -idU : int
        -idV : int
        -data : string
        -dataProposta : string
        -ora : string
        -oraProposta : string
        -stato : string
    }
    class ERecensione {
        -idR : int
        -idM : int
        -idU : int
        -valutazione : int
        -commento : string
        -data_recensione : string
    }

    FUtente ..> EUtente : mappa righe SQL ↔ oggetto
    FMeccanico ..> EMeccanico
    FVeicolo ..> EVeicolo
    FServizio ..> EServizio
    FPreventivo ..> EPreventivo
    FPrenotazione ..> EPrenotazione
    FRecensione ..> ERecensione
```

`EMeccanico` estende concettualmente `EUtente` (un meccanico è un utente con dati aggiuntivi),
ma nel codice è un'entità a parte con la stessa PK dell'utente corrispondente (vedi
`docs/modello-concettuale.md`).

## 3. Livello applicativo: Controller

Un controller per macro-funzionalità (non uno per entità): riceve la richiesta dal
`FrontController`, usa `PersistentManager` per i dati e una classe `View/V<Nome>` per la
presentazione. Elenco completo in [`docs/casi-uso.md`](casi-uso.md).

```mermaid
classDiagram
    class CUtente
    class CAggiungiveicolo
    class CGarage
    class CRichiedipreventivo
    class CVisualizzapreventivi
    class CRichiediprenotazione
    class CVisualizzaprenotazioni
    class CScrivirecensione
    class CVisualizzarecensioni
    class CProfilomeccanico
    class CGestiscimeccanici
    class CGestisciservizi
    class CGestiscipreventivi
    class CGestisciprenotazioni
    class CErrori

    CUtente ..> PersistentManager
    CUtente ..> VUtente
    CUtente ..> CVisualizzarecensioni : compone i dati recensioni per la home
    CUtente ..> CGestiscimeccanici : compone l'elenco meccanici approvati
```

## 4. Presentazione: View + Smarty

```mermaid
classDiagram
    class View {
        #smarty : Smarty
        +__construct()
        #initializeCommonData()
        #assignData(data) View
        #renderTemplate(template, data)
    }
    class VUtente
    class VMeccanico
    class VPrenotazione
    class VPreventivo
    class VServizio
    class VVeicolo
    class VErrori

    View <|-- VUtente
    View <|-- VMeccanico
    View <|-- VPrenotazione
    View <|-- VPreventivo
    View <|-- VServizio
    View <|-- VVeicolo
    View <|-- VErrori

    View --> Smarty : delega il rendering dei .tpl
```

`View` centralizza la configurazione di Smarty (cartelle template/compile/cache) e i dati comuni a
ogni pagina (`isLogged`, `userRole`, `nomeUtente`), lette da `Session`.
