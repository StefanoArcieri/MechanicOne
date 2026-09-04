{extends file='layouts/base.tpl'}

{block name='title'}Preventivi da gestire - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Preventivi da gestire'}</h1>
            <p>Valuta le richieste dei clienti e fissa il prezzo: il resto è automatico.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    <div class="kanban">
        {foreach $sezioni as $sezione}
            <div class="kanban-column">
                <div class="kanban-column__header kanban-column__header--{$sezione.classe}">
                    <h2 class="kanban-column__title">{$sezione.label}</h2>
                    <span class="status-count">{$sezione.items|@count}</span>
                </div>

                <div class="kanban-column__body">
                    {if $sezione.items|@count == 0}
                        <p class="auth-text">{$sezione.vuoto}</p>
                    {else}
                        {foreach $sezione.items as $p name=item}
                            {if $smarty.foreach.item.iteration == 4}
                                <details class="kanban-more">
                                    <summary class="kanban-more__toggle">Mostra altri {$sezione.items|@count - 3}</summary>
                                    <div class="kanban-more__body">
                            {/if}
                            <article class="card status-card status-card--{$sezione.classe}">
                                <h3>Preventivo #{$p.idPrev}</h3>
                                <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                                <p class="status-note">Servizio: {$p.servizioLabel}</p>
                                <p>{$p.descrizione}</p>
                                {if $p.pdf && ($p.stato == 'accettato' || $p.stato == 'svolto')}
                                    <p><a class="form-link" href="/MechanicOne/gestiscipreventivi/scaricaPdf/{$p.idPrev}">📄 Scarica PDF</a></p>
                                {/if}
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
                                    <p class="status-note">In attesa che il cliente prenoti e un meccanico prenda in carico l'intervento: a quel punto risulterà svolto in automatico.</p>
                                {elseif $sezione.classe == 'svolto'}
                                    <p class="status-note">Prezzo: <strong>{$p.costo} &euro;</strong></p>
                                {/if}

                                <form action="/MechanicOne/gestiscipreventivi/elimina/{$p.idPrev}" method="post" onsubmit="return confirm('Eliminare definitivamente questo preventivo? Se ha già una prenotazione collegata, verrà eliminata anche quella. L\'azione non è reversibile.');">
                                    <button class="btn btn--danger" type="submit">Elimina</button>
                                </form>
                            </article>
                            {if $smarty.foreach.item.last && $smarty.foreach.item.iteration > 3}
                                    </div>
                                </details>
                            {/if}
                        {/foreach}
                    {/if}
                </div>
            </div>
        {/foreach}
    </div>
</div>
{/block}
