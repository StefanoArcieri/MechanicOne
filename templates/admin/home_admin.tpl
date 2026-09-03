{extends file='layouts/base.tpl'}

{block name='title'}Pannello Admin - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--admin">
    <h2 class="auth-title auth-title--small">Pannello di Controllo, {$nome}!</h2>
    <p class="auth-text">Hai effettuato l'accesso come <strong>Amministratore Generale</strong>. Qui puoi gestire gli aspetti principali dell'officina.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Gestione meccanici</h3>
            <p>Approva i meccanici e controlla le loro specializzazioni.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/gestiscimeccanici/lista">Apri elenco meccanici</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza le richieste e i preventivi da gestire.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/gestiscipreventivi/lista">Apri preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Controlla gli appuntamenti in programma e lo stato delle prenotazioni.</p>
            <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Apri prenotazioni</a>
        </div>
        <div class="home-card">
            <h3>Servizi</h3>
            <p>Gestisci il catalogo dei servizi offerti dall'officina.</p>
            <a class="home-link home-link--purple" href="/MechanicOne/gestisciservizi/lista">Apri catalogo servizi</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
</div>
{/block}