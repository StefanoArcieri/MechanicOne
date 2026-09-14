<?php
/* Smarty version 5.8.0, created on 2026-09-14 11:34:29
  from 'file:controlla-email.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa7bfa524ac54_72899008',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5a5d05ce833061399e4b7123aef75e2c516fa3d0' => 
    array (
      0 => 'controlla-email.tpl',
      1 => 1789377882,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa7bfa524ac54_72899008 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14634594516aa7bfa5219cb2_73837122', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9775255066aa7bfa522edc4_84282049', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_14634594516aa7bfa5219cb2_73837122 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Controlla la tua email - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_9775255066aa7bfa522edc4_84282049 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="form-panel">
    <div class="form-header">
        <h2 class="form-title">📬 Controlla la tua email</h2>
        <p class="form-subtitle">
            Ti abbiamo inviato un link di conferma<?php if ($_smarty_tpl->getValue('email')) {?> a <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('email')), ENT_QUOTES, 'UTF-8');?>
</strong><?php }?>.
            Clicca il link per attivare il tuo account e accedere a MechanicOne.
        </p>
    </div>

    <div class="form-footer">
        <p class="form-help">
            Non hai ricevuto nulla? Controlla anche nello spam, oppure
            <a href="/MechanicOne/utente/registrazione" class="form-link">riprova la registrazione</a>.
        </p>
        <p class="form-help">
            Hai già confermato? <a href="/MechanicOne/utente/login" class="form-link">Accedi</a>
        </p>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
