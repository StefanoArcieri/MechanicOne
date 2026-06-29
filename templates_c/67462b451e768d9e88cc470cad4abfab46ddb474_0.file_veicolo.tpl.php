<?php
/* Smarty version 5.8.0, created on 2026-06-28 16:17:07
  from 'file:veicolo.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a412ce36810c7_58587561',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67462b451e768d9e88cc470cad4abfab46ddb474' => 
    array (
      0 => 'veicolo.tpl',
      1 => 1782654050,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a412ce36810c7_58587561 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10807676436a412ce363d522_73868605', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1713909386a412ce3654c95_71033357', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_10807676436a412ce363d522_73868605 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Veicoli' ?? null : $tmp);
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_1713909386a412ce3654c95_71033357 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel">
    <h1 class="auth-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Veicoli' ?? null : $tmp);?>
</h1>
    <p class="auth-text">Questa vista è dedicata al controller veicolo.</p>
    <?php if ((true && ($_smarty_tpl->hasVariable('veicoli') && null !== ($_smarty_tpl->getValue('veicoli') ?? null)))) {?>
        <div class="home-grid">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('veicoli'), 'item');
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
