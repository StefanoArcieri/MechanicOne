{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Meccanico'}{/block}

{block name='content'}
<div class="auth-panel">
    <h1 class="auth-title">{$titolo|default:'Meccanico'}</h1>
    <p class="auth-text">Questa vista è dedicata al controller meccanico.</p>

    {if $tipo == 'profilo'}
        <p class="auth-text">Qui trovi il tuo profilo completo e le informazioni principali sull'account meccanico.</p>
        <div class="home-card">
            <h3>Dettagli profilo</h3>
            <p>{$dettaglioProfilo}</p>
        </div>
    {elseif $tipo == 'lista'}
        <p class="auth-text">Lista dei meccanici registrati nel sistema. Da qui puoi tenere traccia di specializzazione e stato.</p>
        {if $meccanici|@count}
            <div class="home-grid">
                {foreach $meccanici as $item}
                    <div class="home-card">
                        <p>{$item}</p>
                    </div>
                {/foreach}
            </div>
        {else}
            <p class="auth-text">Nessun meccanico registrato.</p>
        {/if}
    {elseif $tipo == 'team'}
        <p class="auth-text">{$messaggio|default:'Vuoi far parte del team? Inviaci il curriculum.'}</p>
    {/if}
</div>
{/block}