{extends file='layouts/base.tpl'}

{block name='title'}Area Cliente - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--user">
    <div class="client-hero">
        <img class="client-hero__img" src="/MechanicOne/templates/img/officina-banner.jpg" alt="Officina MechanicOne, meccanici al lavoro su più auto sollevate sui ponti">
        <div class="client-hero__overlay">
            <p class="hero-eyebrow hero-eyebrow--light">Area cliente</p>
            <h1 class="client-hero__title">Benvenuto a bordo, {$nome}! 🚗</h1>
            <p class="hero-text hero-text--light">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi veicoli, i preventivi e le prenotazioni.</p>
        </div>
    </div>

    <div class="home-grid">
        <div class="home-card">
            <span class="feature-item__icon">🚗</span>
            <h3>Garage Personale</h3>
            <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/garage/lista">Gestisci Veicoli &rarr;</a>
        </div>
        <div class="home-card">
            <span class="feature-item__icon">📝</span>
            <h3>Preventivi e Prenotazioni</h3>
            <p>Controlla lo stato dei tuoi preventivi o prenota un appuntamento sul ponte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/visualizzapreventivi/lista">Vedi Richieste &rarr;</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>

    {include file='utente/scrivirecensione.tpl'}
    {include file='utente/visualizzarecensioni.tpl'}
</div>
{/block}
