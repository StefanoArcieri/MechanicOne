{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Preventivo'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Preventivo'}</h1>
    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}
    <p class="auth-text">Questa vista è dedicata al controller preventivo.</p>
    {if isset($preventivo)}
        <div class="home-card">
            <h3>Dettaglio</h3>
            <p>{$preventivo}</p>
        </div>
    {/if}
    {if isset($preventivi)}
        <div class="home-grid">
            {foreach $preventivi as $item}
                <div class="home-card">
                    <h3>{$item}</h3>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}