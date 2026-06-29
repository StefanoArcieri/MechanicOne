<?php
/* Smarty version 5.8.0, created on 2026-06-28 16:17:25
  from 'file:preventivo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a412cf56e4209_16039560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f9902ee246b8c318389ab809b25e14fa961a8467' => 
    array (
      0 => 'preventivo.tpl',
      1 => 1782654050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a412cf56e4209_16039560 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10340852486a412cf56b40a1_84349523', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19376892926a412cf56c7b00_24963903', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_10340852486a412cf56b40a1_84349523 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Preventivo' ?? null : $tmp);
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19376892926a412cf56c7b00_24963903 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel">
    <h1 class="auth-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Preventivo' ?? null : $tmp);?>
</h1>
    <p class="auth-text">Questa vista è dedicata al controller preventivo.</p>
    <?php if ((true && ($_smarty_tpl->hasVariable('preventivo') && null !== ($_smarty_tpl->getValue('preventivo') ?? null)))) {?>
        <div class="home-card">
            <h3>Dettaglio</h3>
            <p><?php echo $_smarty_tpl->getValue('preventivo');?>
</p>
        </div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('preventivi') && null !== ($_smarty_tpl->getValue('preventivi') ?? null)))) {?>
        <div class="home-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventivi'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                <div class="home-card">
                    <h3><?php echo $_smarty_tpl->getValue('item');?>
</h3>
                </div>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
