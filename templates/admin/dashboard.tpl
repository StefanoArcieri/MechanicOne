{extends file='layouts/base.tpl'}

{block name='title'}Dashboard Admin - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--admin">
    <h2 class="auth-title auth-title--small">Pannello di Controllo, {$nome}!</h2>
    <p class="auth-text">Hai effettuato l'accesso come <strong>Amministratore Generale</strong>. Qui puoi gestire gli aspetti principali dell'officina.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Gestione meccanici</h3>
            <p>Crea nuovi account meccanico con credenziali pronte da consegnare e gestisci le specializzazioni del team.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/gestiscimeccanici/lista">Apri elenco meccanici</a>
        </div>
        <div class="home-card">
            <h3>Servizi</h3>
            <p>Gestisci il catalogo dei servizi offerti dall'officina.</p>
            <a class="home-link home-link--purple" href="/MechanicOne/gestisciservizi/lista">Apri catalogo servizi</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Valuta le richieste e fissa i prezzi: risultano svolti in automatico quando un meccanico prende in carico l'intervento.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/gestiscipreventivi/lista">Apri preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Controlla gli appuntamenti in programma, organizzati per mese e settimana.</p>
            <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Apri prenotazioni</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
</div>
{/block}
