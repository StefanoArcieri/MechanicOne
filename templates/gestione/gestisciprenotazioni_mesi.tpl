{extends file='layouts/base.tpl'}

{block name='title'}Prenotazioni da gestire - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Prenotazioni da gestire'}</h1>
            <p>Scegli un mese per vedere le prenotazioni organizzate per settimana.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $mesi|@count == 0}
        <p class="auth-text">Nessuna prenotazione registrata.</p>
    {else}
        <div class="cards">
            {foreach $mesi as $m}
                <a class="card card--link" href="/MechanicOne/gestisciprenotazioni/lista/{$m.anno}/{$m.mese}">
                    <h3>{$m.label}</h3>
                    <p class="status-note">{$m.count} prenotazion{if $m.count == 1}e{else}i{/if}</p>
                </a>
            {/foreach}
        </div>
    {/if}
</div>
{/block}
