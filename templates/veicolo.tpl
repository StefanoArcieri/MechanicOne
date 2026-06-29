{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Veicoli'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Veicoli'}</h1>
    <p class="auth-text">Questa vista è dedicata al controller veicolo.</p>
    {if isset($veicoli)}
        <div class="home-grid">
            {foreach $veicoli as $item}
                <div class="home-card">
                    <h3>{$item}</h3>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}