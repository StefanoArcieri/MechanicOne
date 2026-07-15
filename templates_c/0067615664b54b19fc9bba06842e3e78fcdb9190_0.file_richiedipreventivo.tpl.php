<?php
/* Smarty version 5.8.0, created on 2026-07-14 13:59:30
  from 'file:richiedipreventivo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a5624a2233527_72989256',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0067615664b54b19fc9bba06842e3e78fcdb9190' => 
    array (
      0 => 'richiedipreventivo.tpl',
      1 => 1784023734,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a5624a2233527_72989256 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2760532166a5624a21dc224_45374117', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11841521826a5624a21e5f12_50783606', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_2760532166a5624a21dc224_45374117 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Richiedi un preventivo - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_11841521826a5624a21e5f12_50783606 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Richiedi un preventivo' ?? null : $tmp);?>
</h1>
        <p class="form-subtitle">Scegli il veicolo e il servizio, poi descrivi il problema.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('veicoli')) == 0) {?>
        <p class="auth-text">Devi prima aggiungere un veicolo al tuo <a class="form-link" href="/MechanicOne/veicolo/lista">garage</a>.</p>
    <?php } elseif ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi')) == 0) {?>
        <p class="auth-text">Al momento non ci sono servizi disponibili a catalogo.</p>
    <?php } else { ?>
        <form class="form" action="/MechanicOne/preventivo/richiedi" method="post">
            <div class="form-field">
                <label class="form-label" for="idV">Veicolo</label>
                <select class="form-input" id="idV" name="idV" required>
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
            <div class="form-field">
                <label class="form-label" for="idS">Servizio</label>
                <select class="form-input" id="idS" name="idS" required>
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('servizi'), 's');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach1DoElse = false;
?>
                        <option value="<?php echo $_smarty_tpl->getValue('s')['idS'];?>
"><?php echo $_smarty_tpl->getValue('s')['titolo'];?>
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
        <a class="form-link" href="/MechanicOne/preventivo/lista">&larr; I tuoi preventivi</a>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
