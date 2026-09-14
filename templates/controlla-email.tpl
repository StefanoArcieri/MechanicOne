{extends file='layouts/base.tpl'}

{block name='title'}Controlla la tua email - MechanicOne{/block}

{block name='content'}
<div class="form-panel">
    <div class="form-header">
        <h2 class="form-title">📬 Controlla la tua email</h2>
        <p class="form-subtitle">
            Ti abbiamo inviato un link di conferma{if $email} a <strong>{$email}</strong>{/if}.
            Clicca il link per attivare il tuo account e accedere a MechanicOne.
        </p>
    </div>

    <div class="form-footer">
        <p class="form-help">
            Non hai ricevuto nulla? Controlla anche nello spam, oppure
            <a href="/MechanicOne/utente/registrazione" class="form-link">riprova la registrazione</a>.
        </p>
        <p class="form-help">
            Hai già confermato? <a href="/MechanicOne/utente/login" class="form-link">Accedi</a>
        </p>
    </div>
</div>
{/block}
