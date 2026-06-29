{extends file='layouts/base.tpl'}

{block name='title'}Dashboard Meccanico - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--mechanic">
    <h2 class="auth-title auth-title--small">Benvenuto, {$nome}!</h2>
    <p class="auth-text">Questa è la tua area di lavoro come <strong>Meccanico</strong>. Qui puoi gestire preventivi, appuntamenti e il tuo profilo.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Il mio profilo</h3>
            <p>Verifica i tuoi dati e lo stato del tuo account.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/meccanico/profilo">Vedi profilo</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza i preventivi assegnati e le richieste aperte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Vedi preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Gestisci gli appuntamenti e l'agenda del tuo lavoro.</p>
            <a class="home-link home-link--green" href="/MechanicOne/prenotazione/lista">Vedi prenotazioni</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
</div>
{/block}