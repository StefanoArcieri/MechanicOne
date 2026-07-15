{extends file='layouts/base.tpl'}

{block name='title'}Le tue prenotazioni - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Prenotazioni</p>
            <h1>{$titolo|default:'Le tue prenotazioni'}</h1>
            <p>Controlla i tuoi appuntamenti e proponi modifiche finché non vengono confermati.</p>
        </div>
        <a class="button" href="/MechanicOne/richiediprenotazione/nuovo">+ Richiedi prenotazione</a>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    <section class="status-section">
        <h2 class="status-section__title">In attesa <span class="status-count">{$prenotazioniInAttesa|@count}</span></h2>
        {if $prenotazioniInAttesa|@count == 0}
            <p class="auth-text">Nessuna prenotazione in attesa di conferma.</p>
        {else}
            <div class="cards">
                {foreach $prenotazioniInAttesa as $p}
                    <article class="card status-card status-card--in-attesa">
                        <h3>Prenotazione #{$p.idPren}</h3>
                        <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                        {if $p.data_proposta}
                            <p class="status-note">Modifica proposta in attesa: <em>{$p.data_proposta|date_format:"%d/%m/%Y"} alle {$p.ora_proposta}</em></p>
                            <form action="/MechanicOne/visualizzaprenotazioni/annullaModifica/{$p.idPren}" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        {else}
                            <details class="edit-toggle">
                                <summary>Modifica data/ora</summary>
                                <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/{$p.idPren}" method="post">
                                    <div class="form-field">
                                        <input class="form-input" type="date" name="nuovaData" value="{$p.data}" required>
                                    </div>
                                    <div class="form-field form-field--last">
                                        <input class="form-input" type="time" name="nuovaOra" value="{$p.ora}" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        {/if}
                        <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/{$p.idPren}" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                            <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                        </form>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Confermate <span class="status-count">{$prenotazioniConfermate|@count}</span></h2>
        {if $prenotazioniConfermate|@count == 0}
            <p class="auth-text">Nessuna prenotazione confermata al momento.</p>
        {else}
            <div class="cards">
                {foreach $prenotazioniConfermate as $p}
                    <article class="card status-card status-card--accettata">
                        <h3>Prenotazione #{$p.idPren}</h3>
                        <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                        {if $p.data_proposta}
                            <p class="status-note">Modifica proposta in attesa: <em>{$p.data_proposta|date_format:"%d/%m/%Y"} alle {$p.ora_proposta}</em></p>
                            <form action="/MechanicOne/visualizzaprenotazioni/annullaModifica/{$p.idPren}" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        {else}
                            <details class="edit-toggle">
                                <summary>Modifica data/ora</summary>
                                <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/{$p.idPren}" method="post">
                                    <div class="form-field">
                                        <input class="form-input" type="date" name="nuovaData" value="{$p.data}" required>
                                    </div>
                                    <div class="form-field form-field--last">
                                        <input class="form-input" type="time" name="nuovaOra" value="{$p.ora}" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        {/if}
                        <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/{$p.idPren}" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                            <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                        </form>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Concluse <span class="status-count">{$prenotazioniConcluse|@count}</span></h2>
        {if $prenotazioniConcluse|@count == 0}
            <p class="auth-text">Nessun intervento concluso.</p>
        {else}
            <div class="cards">
                {foreach $prenotazioniConcluse as $p}
                    <article class="card status-card status-card--conclusa">
                        <h3>Prenotazione #{$p.idPren}</h3>
                        <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Cancellate <span class="status-count">{$prenotazioniCancellate|@count}</span></h2>
        {if $prenotazioniCancellate|@count == 0}
            <p class="auth-text">Nessuna prenotazione cancellata.</p>
        {else}
            <div class="cards">
                {foreach $prenotazioniCancellate as $p}
                    <article class="card status-card status-card--cancellata">
                        <h3>Prenotazione #{$p.idPren}</h3>
                        <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>
</div>
{/block}
