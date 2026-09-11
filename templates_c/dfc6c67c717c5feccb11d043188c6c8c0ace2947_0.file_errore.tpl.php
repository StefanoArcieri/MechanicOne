<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:48:10
  from 'file:errore.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9996ba543886_85957376',
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
function content_6a9996ba543886_85957376 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15436520606a9996ba531271_41591856', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12413355956a9996ba540bb2_94075142', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_15436520606a9996ba531271_41591856 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Errore <?php echo $_smarty_tpl->getValue('codice');?>
 - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_12413355956a9996ba540bb2_94075142 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="error-panel">
    <h2 class="error-title">🔧 Ops! Problema ai motori di MechanicOne 🔧</h2>
    <h1 class="error-code">Errore <?php echo $_smarty_tpl->getValue('codice');?>
</h1>
    <p class="error-message"><?php echo $_smarty_tpl->getValue('messaggio');?>
</p>
    <hr class="error-divider">
    <p><a class="error-link" href="/MechanicOne/">Torna alla Homepage</a></p>
</div>
<?php
}
}
/* {/block 'content'} */
}
