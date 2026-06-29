{extends file='layouts/base.tpl'}

{block name='title'}Area Cliente - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--user">
    <h1 class="auth-title auth-title--small">Benvenuto a bordo, {$nome}! 🚗</h1>
    <p class="auth-text">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi motori.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Garage Personale 🛠️</h3>
            <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/veicolo/lista">Gestisci Veicoli &rarr;</a>
        </div>
        <div class="home-card">
            <h3>Preventivi e Prenotazioni 📝</h3>
            <p>Controlla lo stato dei tuoi preventivi o prenota un appuntamento sul ponte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Vedi Richieste &rarr;</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>
</div>
{/block}