{extends file='layouts/base.tpl'}

{block name='title'}Prenotazioni da gestire - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Prenotazioni da gestire'}</h1>
            <p>Conferma gli appuntamenti in attesa; sarà il meccanico a segnare quelli conclusi.</p>
        </div>
        {if $anno}
            <a class="btn btn--ghost" href="/MechanicOne/gestisciprenotazioni/lista/{$anno}/{$mese}">← Tutte le settimane</a>
        {/if}
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
                            <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                            <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                            {if $p.data_proposta}
                                <p class="status-note">Modifica proposta dal cliente: <em>{$p.data_proposta|date_format:"%d/%m/%Y"} alle {$p.ora_proposta}</em></p>
                            {/if}
                            {if $p.meccanicoLabel}
                                <p class="status-note">Meccanico assegnato: {$p.meccanicoLabel}</p>
                            {/if}

                            {if $userRole == 'admin' && ($sezione.classe == 'in-attesa' || $sezione.classe == 'accettata')}
                                <details class="inline-edit">
                                    <summary class="btn btn--secondary">Modifica</summary>
                                    <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/modifica/{$p.idPren}" method="post">
                                        <div class="form-field">
                                            <label class="form-label" for="data-{$p.idPren}">Data</label>
                                            <input class="form-input" type="date" id="data-{$p.idPren}" name="data" value="{$p.data|date_format:"%Y-%m-%d"}" required>
                                        </div>
                                        <div class="form-field">
                                            <label class="form-label" for="ora-{$p.idPren}">Ora</label>
                                            <input class="form-input" type="time" id="ora-{$p.idPren}" name="ora" value="{$p.ora|date_format:"%H:%M"}" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <label class="form-label" for="idM-{$p.idPren}">Meccanico assegnato</label>
                                            <select class="form-input" id="idM-{$p.idPren}" name="idM">
                                                <option value=""{if !$p.idM} selected{/if}>— Nessuno —</option>
                                                {foreach $meccanici as $m}
                                                    <option value="{$m.idM}"{if $p.idM == $m.idM} selected{/if}>{$m.nome} {$m.cognome}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
                                    </form>
                                </details>
                            {/if}

                            {if $sezione.classe == 'in-attesa'}
                                <form action="/MechanicOne/gestisciprenotazioni/accetta/{$p.idPren}" method="post">
                                    {if $anno}
                                        <input type="hidden" name="anno" value="{$anno}">
                                        <input type="hidden" name="mese" value="{$mese}">
                                        <input type="hidden" name="settimanaInizio" value="{$settimanaInizio}">
                                    {/if}
                                    <button class="btn btn--success" type="submit">Conferma</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    {if $anno}
                                        <input type="hidden" name="anno" value="{$anno}">
                                        <input type="hidden" name="mese" value="{$mese}">
                                        <input type="hidden" name="settimanaInizio" value="{$settimanaInizio}">
                                    {/if}
                                    <button class="btn btn--danger" type="submit">Cancella</button>
                                </form>
                            {elseif $sezione.classe == 'accettata'}
                                {if $userRole == 'meccanico'}
                                    <form action="/MechanicOne/gestisciprenotazioni/concludi/{$p.idPren}" method="post">
                                        {if $anno}
                                            <input type="hidden" name="anno" value="{$anno}">
                                            <input type="hidden" name="mese" value="{$mese}">
                                            <input type="hidden" name="settimanaInizio" value="{$settimanaInizio}">
                                        {/if}
                                        <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                    </form>
                                {else}
                                    <p class="status-note">In lavorazione: sarà il meccanico a segnarla come conclusa a fine intervento.</p>
                                {/if}
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    {if $anno}
                                        <input type="hidden" name="anno" value="{$anno}">
                                        <input type="hidden" name="mese" value="{$mese}">
                                        <input type="hidden" name="settimanaInizio" value="{$settimanaInizio}">
                                    {/if}
                                    <button class="btn btn--danger" type="submit">Cancella</button>
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
