{extends file='layouts/base.tpl'}

{block name='title'}Dashboard Cliente - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--client">
    <h2 class="auth-title auth-title--small">Benvenuto, {$nome}!</h2>
    <p class="auth-text">Questa è la tua area riservata come <strong>Cliente</strong>. Da qui puoi gestire i veicoli, i preventivi e le prenotazioni.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Garage personale</h3>
            <p>Visualizza i veicoli che hai registrato e aggiungine di nuovi.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/veicolo/lista">Vedi veicoli</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Controlla lo stato delle richieste inviate all'officina.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Vedi preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Verifica gli appuntamenti fissati e le date disponibili.</p>
            <a class="home-link home-link--green" href="/MechanicOne/prenotazione/lista">Vedi prenotazioni</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
</div>
{/block}