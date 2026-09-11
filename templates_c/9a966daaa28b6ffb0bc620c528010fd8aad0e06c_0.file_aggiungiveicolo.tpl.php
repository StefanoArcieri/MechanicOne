<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:51:15
  from 'file:utente/aggiungiveicolo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a999773439d44_98161800',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a966daaa28b6ffb0bc620c528010fd8aad0e06c' => 
    array (
      0 => 'utente/aggiungiveicolo.tpl',
      1 => 1788449079,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a999773439d44_98161800 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15641156326a99977342a512_55599297', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15572698046a99977342f6b7_71949307', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_15641156326a99977342a512_55599297 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Aggiungi veicolo - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_15572698046a99977342f6b7_71949307 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Aggiungi un veicolo' ?? null : $tmp);?>
</h1>
        <p class="form-subtitle">Inserisci i dati del veicolo da collegare al tuo garage.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <form class="form" action="/MechanicOne/aggiungiveicolo/aggiungiVeicolo" method="post">
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
        <a class="form-link" href="/MechanicOne/garage/lista">&larr; Torna al garage</a>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
