{extends file='layouts/base.tpl'}

{block name='title'}I tuoi preventivi - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Preventivi</p>
            <h1>{$titolo|default:'I tuoi preventivi'}</h1>
            <p>Segui lo stato delle tue richieste e proponi modifiche finché non vengono accettate.</p>
        </div>
        <a class="button" href="/MechanicOne/richiedipreventivo/nuovo">+ Richiedi preventivo</a>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    <section class="status-section">
        <h2 class="status-section__title">Inviati <span class="status-count">{$preventiviInviati|@count}</span></h2>
        {if $preventiviInviati|@count == 0}
            <p class="auth-text">Nessun preventivo in attesa di risposta.</p>
        {else}
            <div class="cards">
                {foreach $preventiviInviati as $p}
                    <article class="card status-card status-card--inviato">
                        <h3>Preventivo #{$p.idPrev}</h3>
                        <p>{$p.descrizione}</p>
                        {if $p.descrizione_proposta}
                            <p class="status-note">Modifica proposta in attesa: <em>{$p.descrizione_proposta}</em></p>
                            <form action="/MechanicOne/visualizzapreventivi/annullaModifica/{$p.idPrev}" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        {else}
                            <details class="edit-toggle">
                                <summary>Modifica</summary>
                                <form class="form" action="/MechanicOne/visualizzapreventivi/modifica/{$p.idPrev}" method="post">
                                    <div class="form-field form-field--last">
                                        <textarea class="form-input" name="nuovaDescrizione" rows="3" required>{$p.descrizione}</textarea>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        {/if}
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Accettati <span class="status-count">{$preventiviAccettati|@count}</span></h2>
        {if $preventiviAccettati|@count == 0}
            <p class="auth-text">Nessun preventivo accettato al momento.</p>
        {else}
            <div class="cards">
                {foreach $preventiviAccettati as $p}
                    <article class="card status-card status-card--accettato">
                        <h3>Preventivo #{$p.idPrev}</h3>
                        <p>{$p.descrizione}</p>
                        <p class="status-note">Costo: <strong>{if $p.costo}{$p.costo} &euro;{else}da definire{/if}</strong></p>
                        {if $p.descrizione_proposta}
                            <p class="status-note">Modifica proposta in attesa: <em>{$p.descrizione_proposta}</em></p>
                            <form action="/MechanicOne/visualizzapreventivi/annullaModifica/{$p.idPrev}" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        {else}
                            <details class="edit-toggle">
                                <summary>Modifica</summary>
                                <form class="form" action="/MechanicOne/visualizzapreventivi/modifica/{$p.idPrev}" method="post">
                                    <div class="form-field form-field--last">
                                        <textarea class="form-input" name="nuovaDescrizione" rows="3" required>{$p.descrizione}</textarea>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        {/if}
                        <p><a class="home-link home-link--blue" href="/MechanicOne/richiediprenotazione/nuovo">Prenota un intervento &rarr;</a></p>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Svolti <span class="status-count">{$preventiviSvolti|@count}</span></h2>
        {if $preventiviSvolti|@count == 0}
            <p class="auth-text">Nessun intervento concluso.</p>
        {else}
            <div class="cards">
                {foreach $preventiviSvolti as $p}
                    <article class="card status-card status-card--svolto">
                        <h3>Preventivo #{$p.idPrev}</h3>
                        <p>{$p.descrizione}</p>
                        <p class="status-note">Costo: <strong>{$p.costo} &euro;</strong></p>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Rifiutati <span class="status-count">{$preventiviRifiutati|@count}</span></h2>
        {if $preventiviRifiutati|@count == 0}
            <p class="auth-text">Nessun preventivo rifiutato.</p>
        {else}
            <div class="cards">
                {foreach $preventiviRifiutati as $p}
                    <article class="card status-card status-card--rifiutato">
                        <h3>Preventivo #{$p.idPrev}</h3>
                        <p>{$p.descrizione}</p>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>
</div>
{/block}
