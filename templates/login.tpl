{extends file='layouts/base.tpl'}

{block name='title'}Login - MechanicOne{/block}

{block name='content'}
<div class="form-panel form-panel--login">
    <div class="form-header">
        <h2 class="form-title">🔧 Officina MechanicOne</h2>
        <p class="form-subtitle">Inserisci le tue credenziali per accedere al sistema</p>
    </div>

    {* Gestione degli errori nativa in Smarty: se la variabile $errore non è vuota, mostra il box *}
    {if $errore}
        <div class="form-alert">
            <strong>❌ Errore:</strong> {$errore}
        </div>
    {/if}

    {* L'azione del form punta direttamente alla rotta del Front Controller *}
    <form action="/MechanicOne/utente/login" method="POST" class="form">
        <div class="form-field">
            <label for="email" class="form-label">Indirizzo Email</label>
            <input type="email" id="email" name="email" required placeholder="esempio@meccanico.it" class="form-input">
        </div>

        <div class="form-field form-field--last">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" required placeholder="••••••••" class="form-input">
        </div>

        <button type="submit" name="login" class="form-submit">
            Entra in Officina
        </button>
    </form>

    <div class="form-footer">
        <p class="form-help">
            Non sei registrato? Contatta l'amministratore di MechanicOne.
        </p>
    </div>

    <p class="form-link-text">Non hai un account?</p>
    <a href="/MechanicOne/utente/registrazione" class="btn btn--secondary">Registrati qui</a>
</div>
{/block}