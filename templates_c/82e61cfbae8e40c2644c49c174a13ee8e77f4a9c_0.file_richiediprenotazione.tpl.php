<?php
/* Smarty version 5.8.0, created on 2026-07-14 23:15:31
  from 'file:richiediprenotazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a56a6f3105f18_58048688',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82e61cfbae8e40c2644c49c174a13ee8e77f4a9c' => 
    array (
      0 => 'richiediprenotazione.tpl',
      1 => 1784063557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a56a6f3105f18_58048688 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19444974276a56a6f3079434_54705894', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_691424086a56a6f308d383_25468681', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_19444974276a56a6f3079434_54705894 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Richiedi una prenotazione - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_691424086a56a6f308d383_25468681 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Richiedi una prenotazione' ?? null : $tmp);?>
</h1>
        <p class="form-subtitle">Segui i passaggi per prenotare un intervento.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('veicoli')) == 0) {?>
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/garage/lista">garage</a>.</p>
    <?php } else { ?>
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
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('veicoli'), 'v');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('v')->value) {
$foreach0DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('v')['idV'];?>
"><?php echo $_smarty_tpl->getValue('v')['marca'];?>
 <?php echo $_smarty_tpl->getValue('v')['modello'];?>
 (<?php echo $_smarty_tpl->getValue('v')['targa'];?>
)</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <button class="form-submit form-submit--primary" type="button" data-next>Avanti</button>
            </fieldset>

            <fieldset class="form-step" data-step="2" hidden>
                <div class="form-field form-field--last">
                    <label class="form-label" for="idPrev">Preventivo accettato collegato (opzionale)</label>
                    <select class="form-input" id="idPrev" name="idPrev">
                        <option value="">Nessuno, prenota senza preventivo</option>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventiviAccettati'), 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" data-idv="<?php echo $_smarty_tpl->getValue('p')['idV'];?>
">#<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
 - <?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
 (<?php echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;)</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                    <p class="form-help">Se non trovi il preventivo, cambia veicolo al passo precedente: la lista si aggiorna in base al veicolo scelto.</p>
                </div>
                <button class="form-submit" type="button" data-prev>Indietro</button>
                <button class="form-submit form-submit--primary" type="button" data-next>Avanti</button>
            </fieldset>

            <fieldset class="form-step" data-step="3" hidden>
                <div class="form-field">
                    <label class="form-label" for="data">Data</label>
                    <input class="form-input" type="date" id="data" name="data" required>
                </div>
                <div class="form-field form-field--last">
                    <label class="form-label" for="ora">Ora</label>
                    <input class="form-input" type="time" id="ora" name="ora" required>
                </div>
                <button class="form-submit" type="button" data-prev>Indietro</button>
                <button class="form-submit form-submit--primary" type="submit">Conferma prenotazione</button>
            </fieldset>
        </form>
    <?php }?>

    <div class="form-footer">
        <a class="form-link" href="/MechanicOne/visualizzaprenotazioni/lista">&larr; Le tue prenotazioni</a>
    </div>
</div>

<?php echo '<script'; ?>
>
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
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
