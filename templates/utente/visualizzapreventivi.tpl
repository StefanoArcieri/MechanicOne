{extends file='layouts/base.tpl'}

{block name='title'}I tuoi preventivi - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Preventivi</p>
            <h1>I tuoi preventivi</h1>
            <p>Segui lo stato delle tue richieste.</p>
        </div>
        <a class="button" href="/MechanicOne/richiedipreventivo/nuovo">+ Richiedi preventivo</a>
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
                        <article class="card status-card status-card--{$sezione.classe}" id="preventivo-{$p.idPrev}">
                            <h3>Preventivo #{$p.idPrev}</h3>
                            <p>{$p.descrizione}</p>
                            {if $p.pdf && ($p.stato == 'accettato' || $p.stato == 'svolto')}
                                <p><a class="form-link" href="/MechanicOne/visualizzapreventivi/scaricaPdf/{$p.idPrev}">📄 Scarica PDF</a></p>
                            {/if}
                            {if $sezione.mostraCosto}
                                <p class="status-note">Costo: <strong>{if $p.costo}{$p.costo} &euro;{else}da definire{/if}</strong></p>
                            {/if}
                            {if $sezione.modificabile}
                                <details class="edit-toggle">
                                    <summary>Modifica</summary>
                                    <form class="form" action="/MechanicOne/visualizzapreventivi/modifica/{$p.idPrev}" method="post">
                                        <div class="form-field form-field--last">
                                            <textarea class="form-input" name="nuovaDescrizione" rows="3" required>{$p.descrizione}</textarea>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Modifica</button>
                                    </form>
                                </details>
                            {/if}
                            {if $sezione.mostraPrenotaLink}
                                <p><a class="home-link home-link--blue" href="/MechanicOne/richiediprenotazione/nuovo">Prenota un intervento &rarr;</a></p>
                            {/if}
                        </article>
                    {/foreach}
                </div>
            {/if}
        </section>
    {/foreach}
</div>
{/block}
