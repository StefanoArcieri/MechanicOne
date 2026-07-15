{extends file='layouts/base.tpl'}

{block name='title'}Il tuo garage - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Garage</p>
            <h1>{$titolo|default:'Il tuo garage'}</h1>
            <p>I veicoli collegati al tuo account.</p>
        </div>
        <a class="button" href="/MechanicOne/aggiungiveicolo/nuovo">+ Aggiungi veicolo</a>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $veicoli|@count > 0}
        <section class="cards">
            {foreach $veicoli as $v}
                <article class="card">
                    <h2>{$v.marca} {$v.modello}</h2>
                    <p>Targa: <strong>{$v.targa}</strong></p>
                    <div class="auth-actions">
                        <a class="home-link home-link--blue" href="/MechanicOne/richiedipreventivo/nuovo">Richiedi preventivo</a>
                        <form action="/MechanicOne/garage/eliminaVeicolo/{$v.idV}" method="post" onsubmit="return confirm('Eliminare questo veicolo?');">
                            <button class="btn btn--danger" type="submit">Elimina</button>
                        </form>
                    </div>
                </article>
            {/foreach}
        </section>
    {else}
        <p class="auth-text">Non hai ancora nessun veicolo. Aggiungine uno per iniziare a richiedere preventivi e prenotazioni.</p>
    {/if}
</div>
{/block}
