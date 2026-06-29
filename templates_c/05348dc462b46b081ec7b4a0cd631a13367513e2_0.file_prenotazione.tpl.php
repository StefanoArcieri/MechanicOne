<?php
/* Smarty version 5.8.0, created on 2026-06-28 17:15:46
  from 'file:prenotazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a413aa2366a30_63399802',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05348dc462b46b081ec7b4a0cd631a13367513e2' => 
    array (
      0 => 'prenotazione.tpl',
      1 => 1782654050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a413aa2366a30_63399802 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21160391416a413aa2334599_03107829', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_509652256a413aa234e906_23275536', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_21160391416a413aa2334599_03107829 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazione' ?? null : $tmp);
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_509652256a413aa234e906_23275536 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel">
    <h1 class="auth-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazione' ?? null : $tmp);?>
</h1>
    <p class="auth-text">Questa vista è dedicata al controller prenotazione.</p>
    <?php if ((true && ($_smarty_tpl->hasVariable('prenotazione') && null !== ($_smarty_tpl->getValue('prenotazione') ?? null)))) {?>
        <div class="home-card">
            <h3>Dettaglio</h3>
            <p><?php echo $_smarty_tpl->getValue('prenotazione');?>
</p>
        </div>
    <?php }?>
    <?php if ((true && ($_smarty_tpl->hasVariable('prenotazioni') && null !== ($_smarty_tpl->getValue('prenotazioni') ?? null)))) {?>
        <div class="home-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prenotazioni'), 'item');
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
