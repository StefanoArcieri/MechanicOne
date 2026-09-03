{extends file='layouts/base.tpl'}

{block name='title'}Richiedi un preventivo - MechanicOne{/block}

{block name='content'}
<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">{$titolo|default:'Richiedi un preventivo'}</h1>
        <p class="form-subtitle">Scegli il veicolo e il servizio, poi descrivi il problema.</p>
    </div>

    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}

    {if $veicoli|@count == 0}
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/garage/lista">garage</a>.</p>
    {elseif $servizi|@count == 0}
        <p class="auth-text">Al momento non ci sono servizi disponibili a catalogo.</p>
    {else}
        <form class="form" action="/MechanicOne/richiedipreventivo/richiedi" method="post">
            <div class="form-field">
                <label class="form-label" for="idV">Veicolo</label>
                <select class="form-input" id="idV" name="idV" required>
                    {foreach $veicoli as $v}
                        <option value="{$v.idV}">{$v.marca} {$v.modello} ({$v.targa})</option>
                    {/foreach}
                </select>
            </div>
            <div class="form-field">
                <label class="form-label" for="idS">Servizio</label>
                <select class="form-input" id="idS" name="idS" required>
                    {foreach $servizi as $s}
                        <option value="{$s.idS}">{$s.titolo}</option>
                    {/foreach}
                </select>
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="descrizione">Descrizione</label>
                <textarea class="form-input" id="descrizione" name="descrizione" rows="4" required placeholder="Descrivi il problema o l'intervento richiesto"></textarea>
            </div>
            <button class="form-submit form-submit--primary" type="submit">Invia richiesta</button>
        </form>
    {/if}

    <div class="form-footer">
        <a class="form-link" href="/MechanicOne/visualizzapreventivi/lista">&larr; I tuoi preventivi</a>
    </div>
</div>
{/block}
