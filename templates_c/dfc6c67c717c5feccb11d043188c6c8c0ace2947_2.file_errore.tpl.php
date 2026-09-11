<?php
/* Smarty version 5.8.0, created on 2026-09-06 17:33:04
  from 'file:errore.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9d87b0b25316_36729219',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfc6c67c717c5feccb11d043188c6c8c0ace2947' => 
    array (
      0 => 'errore.tpl',
      1 => 1784020376,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9d87b0b25316_36729219 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16507950886a9d87b0b23262_60851170', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21360126186a9d87b0b24507_88150613', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_16507950886a9d87b0b23262_60851170 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Errore <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('codice')), ENT_QUOTES, 'UTF-8');?>
 - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_21360126186a9d87b0b24507_88150613 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="error-panel">
    <h2 class="error-title">🔧 Ops! Problema ai motori di MechanicOne 🔧</h2>
    <h1 class="error-code">Errore <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('codice')), ENT_QUOTES, 'UTF-8');?>
</h1>
    <p class="error-message"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('messaggio')), ENT_QUOTES, 'UTF-8');?>
</p>
    <hr class="error-divider">
    <p><a class="error-link" href="/MechanicOne/">Torna alla Homepage</a></p>
</div>
<?php
}
}
/* {/block 'content'} */
}
