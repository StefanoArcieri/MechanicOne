{extends file='layouts/base.tpl'}

{block name='title'}Le tue prenotazioni - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Prenotazioni</p>
            <h1>Le tue prenotazioni</h1>
            <p>Controlla i tuoi appuntamenti e modificali finché non vengono confermati.</p>
        </div>
        <a class="button" href="/MechanicOne/richiediprenotazione/nuovo">+ Richiedi prenotazione</a>
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
                            <h3>Prenotazione #{$p.idPren}</h3>
                            <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                            {if $sezione.modificabile}
                                <details class="edit-toggle">
                                    <summary>Modifica data/ora</summary>
                                    <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/{$p.idPren}" method="post">
                                        <div class="form-field">
                                            <input class="form-input" type="date" name="nuovaData" value="{$p.data}" min="{$oggi}" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <input class="form-input" type="time" name="nuovaOra" value="{$p.ora}" required>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Modifica</button>
                                    </form>
                                </details>
                            {/if}
                            {if $sezione.cancellabile}
                                <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/{$p.idPren}" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                                </form>
                            {/if}
                        </article>
                    {/foreach}
                </div>
            {/if}
        </section>
    {/foreach}
</div>
{/block}
