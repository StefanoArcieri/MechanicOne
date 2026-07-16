<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:38:43
  from 'file:gestiscimeccanici.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a6a37c1b99_53862869',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4244c0c7cdfc83e915fe5324ba3b618e7b22cf8' => 
    array (
      0 => 'gestiscimeccanici.tpl',
      1 => 1784130825,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a6a37c1b99_53862869 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17803473766a58a6a373b705_78366552', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19244675356a58a6a374dae7_97889969', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_17803473766a58a6a373b705_78366552 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Meccanici - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19244675356a58a6a374dae7_97889969 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Meccanici' ?? null : $tmp);?>
</h1>
            <p>Il team di MechanicOne.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('meccanici')) == 0) {?>
        <p class="auth-text">Nessun meccanico registrato.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach0DoElse = false;
?>
                <article class="card">
                    <h3><?php echo $_smarty_tpl->getValue('m')['nome'];?>
 <?php echo $_smarty_tpl->getValue('m')['cognome'];?>
</h3>
                    <p><?php echo (($tmp = $_smarty_tpl->getValue('m')['specializzazione'] ?? null)===null||$tmp==='' ? 'Nessuna specializzazione indicata' ?? null : $tmp);?>
</p>
                    <p class="status-note">Stato: <strong><?php echo $_smarty_tpl->getValue('m')['status'];?>
</strong></p>
                    <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                        <div class="auth-actions">
                            <?php if ($_smarty_tpl->getValue('m')['status'] != 'approvato') {?>
                                <form action="/MechanicOne/gestiscimeccanici/approvaMeccanico/<?php echo $_smarty_tpl->getValue('m')['idM'];?>
" method="post">
                                    <button class="btn btn--success" type="submit">Approva</button>
                                </form>
                            <?php }?>
                            <form action="/MechanicOne/gestiscimeccanici/eliminaMeccanico/<?php echo $_smarty_tpl->getValue('m')['idM'];?>
" method="post" onsubmit="return confirm('Eliminare questo meccanico?');">
                                <button class="btn btn--danger" type="submit">Elimina</button>
                            </form>
                        </div>
                    <?php }?>
                </article>
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
