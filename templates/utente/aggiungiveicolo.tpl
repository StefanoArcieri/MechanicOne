{extends file='layouts/base.tpl'}

{block name='title'}Aggiungi veicolo - MechanicOne{/block}

{block name='content'}
<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">Aggiungi un veicolo</h1>
        <p class="form-subtitle">Inserisci i dati del veicolo da collegare al tuo garage.</p>
    </div>

    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}

    <form class="form" action="/MechanicOne/veicolo/aggiungiVeicolo" method="post">
        <div class="form-field">
            <label class="form-label" for="targa">Targa</label>
            <input class="form-input" type="text" id="targa" name="targa" maxlength="7" placeholder="AB123CD" required>
        </div>
        <div class="form-field">
            <label class="form-label" for="marca">Marca</label>
            <input class="form-input" type="text" id="marca" name="marca" required>
        </div>
        <div class="form-field form-field--last">
            <label class="form-label" for="modello">Modello</label>
            <input class="form-input" type="text" id="modello" name="modello" required>
        </div>
        <button class="form-submit form-submit--primary" type="submit">Aggiungi veicolo</button>
    </form>

    <div class="form-footer">
        <a class="form-link" href="/MechanicOne/veicolo/lista">&larr; Torna al garage</a>
    </div>
</div>
{/block}
