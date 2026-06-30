{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Prenotazione'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Prenotazione'}</h1>
    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}
    <p class="auth-text">Questa vista è dedicata al controller prenotazione.</p>
    {if isset($prenotazione)}
        <div class="home-card">
            <h3>Dettaglio</h3>
            <p>{$prenotazione}</p>
        </div>
    {/if}
    {if isset($prenotazioni)}
        <div class="home-grid">
            {foreach $prenotazioni as $item}
                <div class="home-card">
                    <h3>{$item}</h3>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}