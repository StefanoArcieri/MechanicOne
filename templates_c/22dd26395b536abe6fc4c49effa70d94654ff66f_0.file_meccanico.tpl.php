<?php
/* Smarty version 5.8.0, created on 2026-06-28 23:40:26
  from 'file:meccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a4194cac3e833_42517366',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22dd26395b536abe6fc4c49effa70d94654ff66f' => 
    array (
      0 => 'meccanico.tpl',
      1 => 1782682578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a4194cac3e833_42517366 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8623547666a4194cabe00b7_62910324', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8096367606a4194cabfaac9_78782882', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_8623547666a4194cabe00b7_62910324 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Meccanico' ?? null : $tmp);
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_8096367606a4194cabfaac9_78782882 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel">
    <h1 class="auth-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Meccanico' ?? null : $tmp);?>
</h1>
    <p class="auth-text">Questa vista è dedicata al controller meccanico.</p>

    <?php if ($_smarty_tpl->getValue('tipo') == 'profilo') {?>
        <p class="auth-text">Qui trovi il tuo profilo completo e le informazioni principali sull'account meccanico.</p>
        <div class="home-card">
            <h3>Dettagli profilo</h3>
            <p><?php echo $_smarty_tpl->getValue('dettaglioProfilo');?>
</p>
        </div>
    <?php } elseif ($_smarty_tpl->getValue('tipo') == 'lista') {?>
        <p class="auth-text">Lista dei meccanici registrati nel sistema. Da qui puoi tenere traccia di specializzazione e stato.</p>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('meccanici'))) {?>
            <div class="home-grid">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'item');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('item')->value) {
$foreach0DoElse = false;
?>
                    <div class="home-card">
                        <p><?php echo $_smarty_tpl->getValue('item');?>
</p>
                    </div>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php } else { ?>
            <p class="auth-text">Nessun meccanico registrato.</p>
        <?php }?>
    <?php } elseif ($_smarty_tpl->getValue('tipo') == 'team') {?>
        <p class="auth-text"><?php echo (($tmp = $_smarty_tpl->getValue('messaggio') ?? null)===null||$tmp==='' ? 'Vuoi far parte del team? Inviaci il curriculum.' ?? null : $tmp);?>
</p>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
