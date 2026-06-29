{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Servizi'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Servizi'}</h1>
    <p class="auth-text">Questa vista è dedicata al controller servizio.</p>
    {if isset($servizi)}
        <div class="home-grid">
            {foreach $servizi as $item}
                <div class="home-card">
                    <h3>{$item}</h3>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}