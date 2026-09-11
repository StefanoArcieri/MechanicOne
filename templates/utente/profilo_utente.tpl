{extends file='layouts/base.tpl'}

{block name='title'}Area Cliente - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--user">
    <div class="client-hero">
        <img class="client-hero__img" src="/MechanicOne/templates/img/officina-banner.jpg" alt="Officina MechanicOne, meccanici al lavoro su più auto sollevate sui ponti">
        <div class="client-hero__overlay">
            <p class="hero-eyebrow hero-eyebrow--light">Area cliente</p>
            <h1 class="client-hero__title">Benvenuto nella tua area personale, {$nome}! 🚗</h1>
            <p class="hero-text hero-text--light">Questa è la tua area privata in MechanicOne. Da qui puoi avere un anteprima su i tuoi veicoli, preventivi e prenotazioni.</p>
        </div>
    </div>

    <h2 class="section-title">Il tuo garage</h2>
    <div class="info-panel"><strong>{$countVeicoliTotali}</strong> veicoli registrati.</div>
    {if $countVeicoliTotali > 0}
        <ul class="hero-steps">
            {foreach $veicoli as $v}
                <li>{$v.marca} {$v.modello} ({$v.targa})</li>
            {/foreach}
        </ul>
    {/if}

    <h2 class="section-title">I tuoi preventivi</h2>
    <div class="info-panel">Totali: <strong>{$countPreventiviTotali}</strong> — Inviati: {$countPreventiviInviati}, Accettati: {$countPreventiviAccettati}, Rifiutati: {$countPreventiviRifiutati}, Svolti: {$countPreventiviSvolti}.</div>

    <h2 class="section-title">Le tue prenotazioni</h2>
    <div class="info-panel">Totali: <strong>{$countPrenotazioniTotali}</strong> — In attesa: {$countPrenotazioniInAttesa}, Accettate: {$countPrenotazioniAccettate}, Concluse: {$countPrenotazioniConcluse}, Cancellate: {$countPrenotazioniCancellate}.</div>

    <hr class="auth-divider">
    <div class="cta-panel">👤 Per visualizzare il tuo garage, aggiungere veicoli, richiedere un preventivo o una prenotazione, clicca sulla tua icona utente!</div>
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>
</div>
{/block}
