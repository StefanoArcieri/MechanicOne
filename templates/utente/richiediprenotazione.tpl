{extends file='layouts/base.tpl'}

{block name='title'}Richiedi una prenotazione - MechanicOne{/block}

{block name='content'}
<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">{$titolo|default:'Richiedi una prenotazione'}</h1>
        <p class="form-subtitle">Segui i passaggi per prenotare un intervento.</p>
    </div>

    {if $errore}
        <div class="form-alert"><strong>Errore:</strong> {$errore}</div>
    {/if}

    {if $veicoli|@count == 0}
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/garage/lista">garage</a>.</p>
    {else}
        <div class="step-indicator">
            <span class="step-dot step-dot--active" data-step-dot="1">1. Veicolo</span>
            <span class="step-dot" data-step-dot="2">2. Preventivo</span>
            <span class="step-dot" data-step-dot="3">3. Data e ora</span>
        </div>

        <form class="form" id="form-prenotazione" action="/MechanicOne/richiediprenotazione/prenota" method="post">
            <fieldset class="form-step" data-step="1">
                <div class="form-field form-field--last">
                    <label class="form-label" for="idV">Scegli il veicolo</label>
                    <select class="form-input" id="idV" name="idV" required>
                        <option value="" disabled selected>Seleziona un veicolo</option>
                        {foreach $veicoli as $v}
                            <option value="{$v.idV}">{$v.marca} {$v.modello} ({$v.targa})</option>
                        {/foreach}
                    </select>
                </div>
                <button class="form-submit form-submit--primary" type="button" data-next>Avanti</button>
            </fieldset>

            <fieldset class="form-step" data-step="2" hidden>
                <div class="form-field form-field--last">
                    <label class="form-label" for="idPrev">Preventivo accettato collegato (opzionale)</label>
                    <select class="form-input" id="idPrev" name="idPrev">
                        <option value="">Nessuno, prenota senza preventivo</option>
                        {foreach $preventiviAccettati as $p}
                            <option value="{$p.idPrev}" data-idv="{$p.idV}">#{$p.idPrev} - {$p.descrizione} ({$p.costo} &euro;)</option>
                        {/foreach}
                    </select>
                    <p class="form-help">Se non trovi il preventivo, cambia veicolo al passo precedente: la lista si aggiorna in base al veicolo scelto.</p>
                </div>
                <button class="form-submit" type="button" data-prev>Indietro</button>
                <button class="form-submit form-submit--primary" type="button" data-next>Avanti</button>
            </fieldset>

            <fieldset class="form-step" data-step="3" hidden>
                <div class="form-field">
                    <label class="form-label" for="data">Data</label>
                    <input class="form-input" type="date" id="data" name="data" min="{$oggi}" required>
                </div>
                <div class="form-field form-field--last">
                    <label class="form-label" for="ora">Ora</label>
                    <input class="form-input" type="time" id="ora" name="ora" required>
                </div>
                <button class="form-submit" type="button" data-prev>Indietro</button>
                <button class="form-submit form-submit--primary" type="submit">Conferma prenotazione</button>
            </fieldset>
        </form>
    {/if}

    <div class="form-footer">
        <a class="form-link" href="/MechanicOne/visualizzaprenotazioni/lista">&larr; Le tue prenotazioni</a>
    </div>
</div>

<script>
(function () {
    var form = document.getElementById('form-prenotazione');
    if (!form) return;

    var steps = Array.prototype.slice.call(form.querySelectorAll('[data-step]'));
    var dots = Array.prototype.slice.call(document.querySelectorAll('[data-step-dot]'));
    var idVSelect = document.getElementById('idV');
    var idPrevSelect = document.getElementById('idPrev');

    function showStep(n) {
        steps.forEach(function (el) {
            el.hidden = el.getAttribute('data-step') !== String(n);
        });
        dots.forEach(function (el) {
            el.classList.toggle('step-dot--active', el.getAttribute('data-step-dot') === String(n));
        });
    }

    function filtraPreventivi() {
        var idV = idVSelect.value;
        Array.prototype.forEach.call(idPrevSelect.options, function (opt) {
            if (!opt.value) return;
            opt.hidden = opt.getAttribute('data-idv') !== idV;
        });
        idPrevSelect.value = '';
    }

    form.querySelectorAll('[data-next]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var current = Number(btn.closest('[data-step]').getAttribute('data-step'));
            if (current === 1 && !idVSelect.value) {
                idVSelect.reportValidity();
                return;
            }
            if (current === 1) filtraPreventivi();
            showStep(current + 1);
        });
    });

    form.querySelectorAll('[data-prev]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var current = Number(btn.closest('[data-step]').getAttribute('data-step'));
            showStep(current - 1);
        });
    });

    showStep(1);
})();
</script>
{/block}
