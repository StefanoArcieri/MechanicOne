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
                {if $profilo.foto_profilo}
                    <img class="profile-photo" src="/MechanicOne/uploads/meccanici/{$profilo.foto_profilo}" alt="Foto profilo di {$profilo.nome} {$profilo.cognome}">
                {/if}
                <h3>{$profilo.nome} {$profilo.cognome}</h3>
                <p>{$profilo.email}</p>
                <p class="status-note">Stato account: <strong>{$profilo.status}</strong></p>
                <p>{$profilo.specializzazione|default:'Nessuna specializzazione indicata'}</p>
            </div>
        </div>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Modifica profilo</h2>
        <form class="form" action="/MechanicOne/profilomeccanico/aggiornaProfilo" method="post" enctype="multipart/form-data">
            <div class="form-field">
                <label class="form-label" for="specializzazione">Specializzazione</label>
                <input class="form-input" type="text" id="specializzazione" name="specializzazione" value="{$profilo.specializzazione}">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="foto">Foto profilo</label>
                <input class="form-input" type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp,image/gif">
                <p class="form-hint">JPG, PNG, WEBP o GIF, max 3&nbsp;MB. Lascia vuoto per non cambiarla.</p>
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
