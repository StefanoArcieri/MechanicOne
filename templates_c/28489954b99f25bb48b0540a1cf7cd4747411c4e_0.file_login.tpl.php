<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:49:38
  from 'file:login.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9997126f33a2_61018826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '28489954b99f25bb48b0540a1cf7cd4747411c4e' => 
    array (
      0 => 'login.tpl',
      1 => 1788449079,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9997126f33a2_61018826 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5099391416a9997126d3e09_05561533', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3845534976a9997126dae71_15182563', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_5099391416a9997126d3e09_05561533 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Login - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_3845534976a9997126dae71_15182563 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="form-panel form-panel--login">
    <div class="form-header">
        <h2 class="form-title">🔧 Officina MechanicOne</h2>
        <p class="form-subtitle">Inserisci le tue credenziali per accedere al sistema</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert">
            <strong>❌ Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>

        </div>
    <?php }?>

    <form action="/MechanicOne/utente/login" method="POST" class="form">
        <div class="form-field">
            <label for="email" class="form-label">Indirizzo Email</label>
            <input type="email" id="email" name="email" required placeholder="esempio@meccanico.it" class="form-input" value="<?php echo (($tmp = $_smarty_tpl->getValue('emailRicordata') ?? null)===null||$tmp==='' ? '' ?? null : $tmp);?>
">
        </div>

        <div class="form-field form-field--last">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" required placeholder="••••••••" class="form-input">
        </div>

        <div class="form-field form-field--checkbox">
            <label for="ricordami" class="form-label form-label--inline">
                <input type="checkbox" id="ricordami" name="ricordami" value="1"<?php if ($_smarty_tpl->getValue('emailRicordata')) {?> checked<?php }?>>
                Ricordami l'email su questo dispositivo
            </label>
        </div>

        <button type="submit" name="login" class="form-submit">
            Entra in Officina
        </button>
    </form>

    <div class="form-footer">
        <p class="form-help">
            Non sei registrato? Contatta l'amministratore di MechanicOne.
        </p>
    </div>

    <p class="form-link-text">Non hai un account?</p>
    <a href="/MechanicOne/utente/registrazione" class="btn btn--secondary">Registrati qui</a>
</div>
<?php
}
}
/* {/block 'content'} */
}
