<?php
/* Smarty version 5.8.0, created on 2026-07-16 13:42:52
  from 'file:aggiungiveicolo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58c3bc7c4a97_35406484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cc4d1a299202d5fa40e0fe7bd3bad5384216237' => 
    array (
      0 => 'aggiungiveicolo.tpl',
      1 => 1784063556,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58c3bc7c4a97_35406484 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6821061216a58c3bc5dae27_22238873', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_544684806a58c3bc5e53d0_59790899', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_6821061216a58c3bc5dae27_22238873 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Aggiungi veicolo - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_544684806a58c3bc5e53d0_59790899 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
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
