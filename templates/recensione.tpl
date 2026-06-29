{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Recensioni'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Recensioni'}</h1>
    <p class="auth-text">Questa vista è dedicata al controller recensione.</p>
    {if isset($recensioni)}
        <div class="home-grid">
            {foreach $recensioni as $item}
                <div class="home-card">
                    <h3>{$item}</h3>
                </div>
            {/foreach}
        </div>
    {/if}
</div>
{/block}