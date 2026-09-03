# Modello concettuale (ER)

Schema derivato da `database.sql`. Chiave: `PK` = chiave primaria, `FK` = chiave esterna.

```mermaid
erDiagram
    UTENTI ||--o{ VEICOLI : possiede
    UTENTI ||--o| MECCANICI : "è (se ruolo=meccanico)"
    UTENTI ||--o{ PREVENTIVI : richiede
    UTENTI ||--o{ PRENOTAZIONI : richiede
    UTENTI ||--o{ RECENSIONI : scrive
    MECCANICI ||--o{ RECENSIONI : riceve
    MECCANICI ||--o{ PRENOTAZIONI : "è assegnato a"
    VEICOLI ||--o{ PREVENTIVI : "oggetto di"
    VEICOLI ||--o{ PRENOTAZIONI : "oggetto di"
    SERVIZI ||--o{ PREVENTIVI : riguarda
    PREVENTIVI ||--o| PRENOTAZIONI : genera

    UTENTI {
        int idU PK
        varchar nome
        varchar cognome
        varchar email UK
        varchar password "hash bcrypt"
        enum ruolo "cliente | meccanico | admin"
        timestamp ultimo_accesso
        timestamp data_registrazione
    }

    VEICOLI {
        int idV PK
        int idU FK
        varchar targa UK
        varchar marca
        varchar modello
    }

    MECCANICI {
        int idM PK "FK verso utenti.idU"
        varchar specializzazione
        varchar foto_profilo
        enum status "in attesa | approvato | licenziato"
    }

    SERVIZI {
        int idS PK
        varchar titolo UK
        varchar descrizione
    }

    PREVENTIVI {
        int idPrev PK
        int idU FK
        int idV FK
        int idS FK
        varchar descrizione
        varchar descrizione_proposta
        int costo
        enum stato "inviato | accettato | rifiutato | svolto"
        varchar pdf
        timestamp data_richiesta
    }

    PRENOTAZIONI {
        int idPren PK
        int idPrev FK "nullable"
        int idM FK "nullable"
        int idU FK
        int idV FK
        date data
        date data_proposta
        time ora
        time ora_proposta
        enum stato "in attesa | accettata | conclusa | cancellata"
    }

    RECENSIONI {
        int idR PK
        int idM FK
        int idU FK
        tinyint valutazione "1-5"
        varchar commento
        timestamp data_recensione
    }
```

## Note sul modello

- `meccanici` è in relazione 1:1 con `utenti` (condivide la PK come FK, pattern "sottoclasse
  tabella separata"): un meccanico *è* un utente con dati aggiuntivi, non un'entità indipendente.
- Tutte le FK sono `ON DELETE CASCADE`, eccetto `prenotazioni.idM` (`ON DELETE SET NULL`, per non
  perdere lo storico prenotazioni se un meccanico viene rimosso).
- `preventivi` e `prenotazioni` sono disaccoppiati ma collegabili: una prenotazione può nascere da
  un preventivo accettato (`prenotazioni.idPrev`) oppure essere richiesta direttamente, senza
  preventivo (campo nullable).
- Vincoli di unicità: `utenti.email`, `veicoli.targa`, `servizi.titolo`.
- Non è presente un vincolo di unicità `(idM, idU)` su `recensioni` per imporre "una sola
  recensione per meccanico per utente": la regola è attualmente enforced solo a livello applicativo
  (nessun controller la applica in scrittura, il che è un possibile miglioramento — vedi
  `CScrivirecensione::scrivi`, che oggi permette anche recensioni multiple dallo stesso utente
  verso lo stesso meccanico).
