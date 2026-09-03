{extends file='layouts/base.tpl'}

{block name='title'}Meccanici - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>{$titolo|default:'Meccanici'}</h1>
            <p>Il team di MechanicOne.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $meccanici|@count == 0}
        <p class="auth-text">Nessun meccanico registrato.</p>
    {else}
        <div class="cards">
            {foreach $meccanici as $m}
                <article class="card">
                    <h3>{$m.nome} {$m.cognome}</h3>
                    <p>{$m.specializzazione|default:'Nessuna specializzazione indicata'}</p>
                    <p class="status-note">Stato: <strong>{$m.status}</strong></p>
                    {if $userRole == 'admin'}
                        <div class="auth-actions">
                            {if $m.status != 'approvato'}
                                <form action="/MechanicOne/gestiscimeccanici/approvaMeccanico/{$m.idM}" method="post">
                                    <button class="btn btn--success" type="submit">Approva</button>
                                </form>
                            {/if}
                            <form action="/MechanicOne/gestiscimeccanici/eliminaMeccanico/{$m.idM}" method="post" onsubmit="return confirm('Eliminare questo meccanico?');">
                                <button class="btn btn--danger" type="submit">Elimina</button>
                            </form>
                        </div>
                    {/if}
                </article>
            {/foreach}
        </div>
    {/if}
</div>
{/block}
