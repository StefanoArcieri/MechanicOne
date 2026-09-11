<?php
/* Smarty version 5.8.0, created on 2026-09-09 20:08:24
  from 'file:utente/aggiungiveicolo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa1a098273106_91549382',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a966daaa28b6ffb0bc620c528010fd8aad0e06c' => 
    array (
      0 => 'utente/aggiungiveicolo.tpl',
      1 => 1788977247,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa1a098273106_91549382 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20854731096aa1a09826aee3_94417726', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_465984496aa1a09826f165_98514340', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_20854731096aa1a09826aee3_94417726 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Aggiungi veicolo - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_465984496aa1a09826f165_98514340 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="form-panel">
    <div class="form-header">
        <h1 class="form-title">Aggiungi un veicolo</h1>
        <p class="form-subtitle">Inserisci i dati del veicolo da collegare al tuo garage.</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

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
<?php
}
}
/* {/block 'content'} */
}
