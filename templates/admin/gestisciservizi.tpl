{extends file='layouts/base.tpl'}

{block name='title'}Catalogo servizi - MechanicOne{/block}

{block name='content'}
<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Catalogo servizi</h1>
            <p>I servizi che l'officina offre ai clienti.</p>
        </div>
    </header>

    {if $errore}
        <div class="form-alert">{$errore}</div>
    {/if}

    {if $userRole == 'admin'}
        <section class="status-section">
            <h2 class="status-section__title">Aggiungi servizio</h2>
            <div class="form-panel" style="width:auto; box-shadow:none; padding:0;">
                <form class="form" action="/MechanicOne/gestisciservizi/aggiungiServizio" method="post">
                    <div class="form-field">
                        <label class="form-label" for="titolo">Titolo</label>
                        <input class="form-input" type="text" id="titolo" name="titolo" required>
                    </div>
                    <div class="form-field form-field--last">
                        <label class="form-label" for="descrizione">Descrizione</label>
                        <textarea class="form-input" id="descrizione" name="descrizione" rows="2"></textarea>
                    </div>
                    <button class="form-submit form-submit--primary" type="submit">Aggiungi al catalogo</button>
                </form>
            </div>
        </section>
    {/if}

    <section class="status-section">
        <h2 class="status-section__title">Servizi <span class="status-count">{$servizi|@count}</span></h2>
        {if $servizi|@count == 0}
            <p class="auth-text">Nessun servizio a catalogo.</p>
        {else}
            <div class="cards">
                {foreach $servizi as $s}
                    <article class="card" id="servizio-{$s.idS}">
                        <h3>{$s.titolo}</h3>
                        <p>{$s.descrizione}</p>
                        {if $userRole == 'admin'}
                            <div class="auth-actions">
                                <details class="inline-edit">
                                    <summary class="btn btn--secondary">Modifica</summary>
                                    <form class="form inline-edit__form" action="/MechanicOne/gestisciservizi/modificaServizio/{$s.idS}" method="post">
                                        <div class="form-field">
                                            <label class="form-label" for="titolo-{$s.idS}">Titolo</label>
                                            <input class="form-input" type="text" id="titolo-{$s.idS}" name="titolo" value="{$s.titolo}" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <label class="form-label" for="descrizione-{$s.idS}">Descrizione</label>
                                            <textarea class="form-input" id="descrizione-{$s.idS}" name="descrizione" rows="2">{$s.descrizione}</textarea>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
                                    </form>
                                </details>
                                <form action="/MechanicOne/gestisciservizi/eliminaServizio/{$s.idS}" method="post" onsubmit="return confirm('Eliminare questo servizio?');">
                                    <button class="btn btn--danger" type="submit">Elimina</button>
                                </form>
                            </div>
                        {/if}
                    </article>
                {/foreach}
            </div>
        {/if}
    </section>
</div>
{/block}
