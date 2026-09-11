<?php
/* Smarty version 5.8.0, created on 2026-09-11 09:35:26
  from 'file:utente/richiediprenotazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa3af3eb68816_11464463',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7e35d9a21eb6f9707f5a7798b47e34d566058b3' => 
    array (
      0 => 'utente/richiediprenotazione.tpl',
      1 => 1789056474,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa3af3eb68816_11464463 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12699168146aa3af3eb41d19_08997936', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15117065076aa3af3eb493b3_16155986', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_12699168146aa3af3eb41d19_08997936 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Richiedi una prenotazione - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_15117065076aa3af3eb493b3_16155986 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">Richiedi una prenotazione</h1>
        <p class="form-subtitle">Segui i passaggi per prenotare un intervento.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('veicoli')) == 0) {?>
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/veicolo/lista">garage</a>.</p>
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
                            <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['idV']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['marca']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['modello']), ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['targa']), ENT_QUOTES, 'UTF-8');?>
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
                            <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" data-idv="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idV']), ENT_QUOTES, 'UTF-8');?>
">#<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
 - <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione']), ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['costo']), ENT_QUOTES, 'UTF-8');?>
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
                    <input class="form-input" type="date" id="data" name="data" min="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('oggi')), ENT_QUOTES, 'UTF-8');?>
" required>
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
