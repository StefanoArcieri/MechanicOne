{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Prenotazioni'} - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo}</h1>
            <p>Scegli una settimana per vedere le prenotazioni.</p>
        </div>
        <a class="btn btn--ghost" href="/MechanicOne/gestisciprenotazioni/lista">← Tutti i mesi</a>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $settimane|@count == 0}
        <p class="auth-text">Nessuna prenotazione in questo mese.</p>
    {else}
        <div class="cards">
            {foreach $settimane as $i => $s}
                <a class="card card--link" href="/MechanicOne/gestisciprenotazioni/lista/{$anno}/{$mese}/{$s.inizio}">
                    <h3>Settimana {$i + 1}</h3>
                    <p class="status-note">{$s.label}</p>
                    <p class="status-note">{$s.count} prenotazion{if $s.count == 1}e{else}i{/if}</p>
                </a>
            {/foreach}
        </div>
    {/if}
</div>
{/block}
