<?php
/* Smarty version 5.8.0, created on 2026-09-10 13:43:56
  from 'file:utente/richiedipreventivo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa297fce848b1_61964434',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cbf5a4d5a48072703284a6e45303f74168078dc' => 
    array (
      0 => 'utente/richiedipreventivo.tpl',
      1 => 1789040623,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa297fce848b1_61964434 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11769895996aa297fce59e13_90484593', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5432722736aa297fce62a39_94214050', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_11769895996aa297fce59e13_90484593 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Richiedi un preventivo - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_5432722736aa297fce62a39_94214050 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">Richiedi un preventivo</h1>
        <p class="form-subtitle">Scegli il veicolo e il servizio, poi descrivi il problema.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('veicoli')) == 0) {?>
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/veicolo/lista">garage</a>.</p>
    <?php } elseif ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi')) == 0) {?>
        <p class="auth-text">Al momento non ci sono servizi disponibili a catalogo.</p>
    <?php } else { ?>
        <form class="form" action="/MechanicOne/richiedipreventivo/richiedi" method="post">
            <div class="form-field">
                <label class="form-label" for="idV">Veicolo</label>
                <select class="form-input" id="idV" name="idV" required>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('veicoli'), 'v');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('v')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['idV']), ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->getValue('v')['idV'] == $_smarty_tpl->getValue('idVPreselezionato')) {?>selected<?php }?>><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['marca']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['modello']), ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['targa']), ENT_QUOTES, 'UTF-8');?>
)</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="form-field">
                <label class="form-label" for="idS">Servizio</label>
                <select class="form-input" id="idS" name="idS" required>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('servizi'), 's');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['titolo']), ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </select>
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="descrizione">Descrizione</label>
                <textarea class="form-input" id="descrizione" name="descrizione" rows="4" required placeholder="Descrivi il problema o l'intervento richiesto"></textarea>
            </div>
            <button class="form-submit form-submit--primary" type="submit">Invia richiesta</button>
        </form>
    <?php }?>

    <div class="form-footer">
        <a class="form-link" href="/MechanicOne/visualizzapreventivi/lista">&larr; I tuoi preventivi</a>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
