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
                                    <form action="/MechanicOne/gestisciprenotazioni/accetta/{$p.idPren}" method="post">
                                        <button class="btn btn--success" type="submit">Conferma</button>
                                    </form>
                                {elseif $p.stato == 'accettata'}
                                    <p class="status-note">Meccanico assegnato: {$p.meccanicoLabel|default:'nessuno'}</p>
                                    <form action="/MechanicOne/gestisciprenotazioni/concludi/{$p.idPren}" method="post">
                                        <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                    </form>
                                {/if}
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
