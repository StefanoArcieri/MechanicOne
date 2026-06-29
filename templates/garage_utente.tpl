{extends file='layouts/base.tpl'}

{block name='title'}Garage Utente - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Area privata</p>
            <h1>Ciao, {$nome|default:'utente'}!</h1>
            <p>Gestisci il tuo garage, le prenotazioni e i preventivi in un unico posto.</p>
        </div>
        <a class="button button--danger" href="/MechanicOne/utente/logout">Esci</a>
    </header>

    <section class="cards">
        <article class="card">
            <h2>Veicoli</h2>
            <p>Visualizza i veicoli registrati, aggiungine uno nuovo o aggiorna i dati.</p>
            <a class="button" href="/MechanicOne/veicolo/lista">Gestisci veicoli</a>
        </article>

        <article class="card">
            <h2>Prenotazioni</h2>
            <p>Controlla gli appuntamenti programmati e lo stato delle tue richieste.</p>
            <a class="button" href="/MechanicOne/prenotazione/lista">Vedi prenotazioni</a>
        </article>

        <article class="card">
            <h2>Preventivi</h2>
            <p>Monitora i preventivi richiesti e le risposte ricevute dall'officina.</p>
            <a class="button" href="/MechanicOne/preventivo/lista">Apri preventivi</a>
        </article>
    </section>
</div>
{/block}