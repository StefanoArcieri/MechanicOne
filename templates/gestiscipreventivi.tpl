{extends file='layouts/base.tpl'}

{block name='title'}Preventivi da gestire - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Preventivi da gestire'}</h1>
            <p>Valuta le richieste dei clienti, fissa il prezzo o segna il lavoro come concluso.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {foreach $sezioni as $sezione}
        <section class="status-section">
            <h2 class="status-section__title">{$sezione.label} <span class="status-count">{$sezione.items|@count}</span></h2>
            {if $sezione.items|@count == 0}
                <p class="auth-text">{$sezione.vuoto}</p>
            {else}
                <div class="cards">
                    {foreach $sezione.items as $p}
                        <article class="card status-card status-card--{$sezione.classe}">
                            <h3>Preventivo #{$p.idPrev}</h3>
                            <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                            <p class="status-note">Servizio: {$p.servizioLabel}</p>
                            <p>{$p.descrizione}</p>
                            {if $p.descrizione_proposta}
                                <p class="status-note">Modifica proposta dal cliente: <em>{$p.descrizione_proposta}</em></p>
                            {/if}

                            {if $sezione.classe == 'inviato'}
                                <form class="form" action="/MechanicOne/gestiscipreventivi/updateCosto/{$p.idPrev}" method="post">
                                    <div class="form-field">
                                        <label class="form-label" for="costo-{$p.idPrev}">Prezzo (&euro;)</label>
                                        <input class="form-input" type="number" min="0" step="1" id="costo-{$p.idPrev}" name="costo" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Accetta e fissa il prezzo</button>
                                </form>
                                <form action="/MechanicOne/gestiscipreventivi/rifiuta/{$p.idPrev}" method="post" onsubmit="return confirm('Rifiutare questa richiesta?');">
                                    <button class="btn btn--danger" type="submit">Rifiuta</button>
                                </form>
                            {elseif $sezione.classe == 'accettato'}
                                <p class="status-note">Prezzo: <strong>{$p.costo} &euro;</strong></p>
                                <form action="/MechanicOne/gestiscipreventivi/segnaSvolto/{$p.idPrev}" method="post">
                                    <button class="btn btn--success" type="submit">Segna come svolto</button>
                                </form>
                            {elseif $sezione.classe == 'svolto'}
                                <p class="status-note">Prezzo: <strong>{$p.costo} &euro;</strong></p>
                            {/if}
                        </article>
                    {/foreach}
                </div>
            {/if}
        </section>
    {/foreach}
</div>
{/block}
