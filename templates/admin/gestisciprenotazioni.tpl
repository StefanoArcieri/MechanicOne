{extends file='layouts/base.tpl'}

{block name='title'}Area Prenotazioni - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Area Prenotazioni</h1>
            <p>Visualizza e gestisci le tue prenotazioni. </p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $mesi|@count == 0}
        <p class="auth-text">Nessuna prenotazione registrata.</p>
    {else}
        {foreach $mesi as $mese}
            <section class="status-section">
                <h2 class="status-section__title">{$mese.label} <span class="status-count">{$mese.attive|@count}</span></h2>

                {if $mese.attive|@count == 0}
                    <p class="auth-text">Nessuna prenotazione in attesa o confermata in questo mese.</p>
                {else}
                    <div class="cards">
                        {foreach $mese.attive as $p}
                            <article class="card status-card status-card--{$p.stato|replace:' ':'-'}" id="prenotazione-{$p.idPren}">
                                <h3>Prenotazione #{$p.idPren}</h3>
                                <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                                <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>

                                {if $p.stato == 'in attesa'}
                                    <details class="inline-edit">
                                        <summary class="btn btn--success">Conferma</summary>
                                        <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/accetta/{$p.idPren}" method="post">
                                            <div class="form-field form-field--last">
                                                <label class="form-label" for="idM-accetta-{$p.idPren}">Assegna meccanico</label>
                                                <select class="form-input" id="idM-accetta-{$p.idPren}" name="idM" required>
                                                    <option value="" disabled selected>— Scegli un meccanico —</option>
                                                    {foreach $meccanici as $m}
                                                        <option value="{$m.idM}">{$m.nome} {$m.cognome}</option>
                                                    {/foreach}
                                                </select>
                                            </div>
                                            <button class="form-submit form-submit--primary" type="submit">Conferma</button>
                                        </form>
                                    </details>
                                {/if}
                                    <details class="inline-edit">
                                        <summary class="btn btn--secondary">Modifica</summary>
                                        <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/modifica/{$p.idPren}" method="post">
                                            <div class="form-field">
                                                <label class="form-label" for="data-{$p.idPren}">Data</label>
                                                <input class="form-input" type="date" id="data-{$p.idPren}" name="data" value="{$p.data|date_format:"%Y-%m-%d"}">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-label" for="ora-{$p.idPren}">Ora</label>
                                                <input class="form-input" type="time" id="ora-{$p.idPren}" name="ora" value="{$p.ora|date_format:"%H:%M"}">
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
                                    <form action="/MechanicOne/gestisciprenotazioni/cancella/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                        <button class="btn btn--danger" type="submit">Cancella</button>
                                    </form>
                            </article>
                        {/foreach}
                    </div>
                {/if}

                {if $mese.archiviate|@count > 0}
                    <details class="inline-edit">
                        <summary class="btn btn--secondary">Concluse e cancellate ({$mese.archiviate|@count})</summary>
                        <div class="cards">
                            {foreach $mese.archiviate as $p}
                                <article class="card status-card status-card--{$p.stato|replace:' ':'-'}">
                                    <h3>Prenotazione #{$p.idPren}</h3>
                                    <p class="status-note">{$p.clienteLabel} — {$p.veicoloLabel}</p>
                                    <p>{$p.data|date_format:"%d/%m/%Y"} alle {$p.ora}</p>
                                    {if $p.meccanicoLabel}
                                        <p class="status-note">Meccanico assegnato: {$p.meccanicoLabel}</p>
                                    {/if}
                                    <form action="/MechanicOne/gestisciprenotazioni/elimina/{$p.idPren}" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                        <button class="btn btn--danger" type="submit">Elimina</button>
                                    </form>
                                </article>
                            {/foreach}
                        </div>
                    </details>
                {/if}
            </section>
        {/foreach}
    {/if}
</div>
{/block}
