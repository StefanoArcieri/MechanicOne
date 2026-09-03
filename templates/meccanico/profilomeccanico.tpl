{extends file='layouts/base.tpl'}

{block name='title'}{$titolo|default:'Profilo meccanico'} - MechanicOne{/block}

{block name='content'}
<div class="auth-panel auth-panel--mechanic">
    <h1 class="auth-title">{$titolo|default:'Profilo meccanico'}</h1>

    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}

    {if $profilo}
        <div class="home-grid">
            <div class="home-card">
                <h3>{$profilo.nome} {$profilo.cognome}</h3>
                <p>{$profilo.email}</p>
                <p class="status-note">Stato account: <strong>{$profilo.status}</strong></p>
                <p>{$profilo.specializzazione|default:'Nessuna specializzazione indicata'}</p>
            </div>
        </div>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Modifica profilo</h2>
        <form class="form" action="/MechanicOne/profilomeccanico/aggiornaProfilo" method="post">
            <div class="form-field">
                <label class="form-label" for="specializzazione">Specializzazione</label>
                <input class="form-input" type="text" id="specializzazione" name="specializzazione" value="{$profilo.specializzazione}">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="foto">Link foto profilo</label>
                <input class="form-input" type="text" id="foto" name="foto" value="{$profilo.foto_profilo}" placeholder="https://...">
            </div>
            <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
        </form>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Cambia password</h2>
        <p class="auth-text">Hai fatto accesso con la password provvisoria consegnata dall'admin? Impostane una tua qui sotto.</p>
        <form class="form" action="/MechanicOne/profilomeccanico/cambiaPassword" method="post">
            <div class="form-field">
                <label class="form-label" for="password_attuale">Password attuale</label>
                <input class="form-input" type="password" id="password_attuale" name="password_attuale" required>
            </div>
            <div class="form-field">
                <label class="form-label" for="nuova_password">Nuova password</label>
                <input class="form-input" type="password" id="nuova_password" name="nuova_password" required minlength="8" placeholder="Almeno 8 caratteri">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="conferma_password">Conferma nuova password</label>
                <input class="form-input" type="password" id="conferma_password" name="conferma_password" required minlength="8">
            </div>
            <button class="form-submit form-submit--primary" type="submit">Aggiorna password</button>
        </form>
    {else}
        <p class="auth-text">Profilo non disponibile.</p>
    {/if}
</div>
{/block}
