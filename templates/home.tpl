{extends file='layouts/base.tpl'}

{block name='title'}Home - MechanicOne{/block}

{block name='content'}
<div class="home-stack">

    {*primo blocco presentazione splittato*}
    <section class="hero-split">
        <div class="hero-split__promo">
            <p class="hero-eyebrow hero-eyebrow--light">Benvenuto</p>
            <h1 class="hero-split__title">🔧 MechanicOne</h1>
            <p class="hero-text hero-text--light">La tua officina online per prenotare interventi, richiedere preventivi e seguire i servizi di assistenza, dalla prima richiesta al collaudo finale.</p>
            <div class="hero-cta">
            {if $isLogged}
                <a class="btn btn--ghost-light" href="/MechanicOne/utente/dashboardUtente"> Visualizza il tuo profilo</a>
            {else}
                <a class="btn btn--accent" href="/MechanicOne/utente/registrazione">Registrati</a>
                <a class="btn btn--ghost-light" href="/MechanicOne/utente/login">Accedi</a>
            {/if}
            </div>
        </div>
        <div class="hero-split__action">
            <h2>Richiedi il tuo preventivo</h2>
            <p class="hero-text">Tre passaggi, prezzo chiaro prima di prenotare.</p>
            <ol class="hero-steps">
                <li>Registrati o accedi al tuo account</li>
                <li>Richiedi un preventivo per il servizio che ti serve</li>
                <li>Prenota l'intervento quando il prezzo è confermato</li>
            </ol>
            <a class="btn btn--primary hero-split__action-btn" href="/MechanicOne/richiedipreventivo/nuovo">Inizia ora</a>
        </div>
    </section>

    {*blocco servizi*}
    <section class="hero-card">
        <h2 class="section-title">I nostri servizi</h2>
        <div class="feature-grid">
            {foreach $servizi as $s}
            <div class="feature-item">
                <span class="feature-item__icon">🔧</span>
                <h3>{$s.titolo}</h3>
                <p>{$s.descrizione}</p>
            </div>
            {/foreach}
        </div>
    </section>

    {*blocco immagini-testo*}
    <section class="showcase-row">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-1.jpg" alt="Meccanica pronta ad accogliere un cliente in officina">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Il nostro approccio</p>
            <h2>Un'accoglienza che fa la differenza</h2>
            <p class="hero-text">Ogni richiesta viene seguita con attenzione: ti spieghiamo con chiarezza cosa serve alla tua auto, senza tecnicismi inutili, e ti accompagniamo dalla prima richiesta fino al ritiro del veicolo.</p>
        </div>
    </section>

    <section class="showcase-row showcase-row--reverse">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-2.jpg" alt="Meccanico al lavoro su un blocco motore">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Competenza tecnica</p>
            <h2>Riparazioni fatte a regola d'arte</h2>
            <p class="hero-text">Dalla manutenzione ordinaria agli interventi più complessi sul motore, lavoriamo con cura e strumentazione professionale, usando solo ricambi di qualità.</p>
        </div>
    </section>

    <section class="showcase-row">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-3.jpg" alt="Meccanica al banco da lavoro con una chiave a cricchetto">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Trasparenza</p>
            <h2>Diagnosi precise, zero sorprese</h2>
            <p class="hero-text">Controlliamo a fondo il problema prima di intervenire: ricevi un preventivo chiaro, con tempi e costi definiti, prima ancora che i lavori comincino.</p>
        </div>
    </section>

    {*blocco pk scegliere noi*}
    <section class="trust-band">
        <p class="hero-eyebrow">Perché scegliere noi</p>
        <h2>Un punto di riferimento per la tua auto</h2>
        <p class="hero-text">Meccanici qualificati, prezzi decisi prima di ogni intervento e uno storico completo di preventivi e prenotazioni sempre a portata di mano dal tuo account.</p>
        <a class="btn btn--primary" href="/MechanicOne/richiedipreventivo/nuovo">Richiedi un preventivo</a>
    </section>

    <section class="hero-card">
        {include file='utente/scrivirecensione.tpl'}
        {include file='utente/visualizzarecensioni.tpl'}
    </section>
</div>
{/block}
