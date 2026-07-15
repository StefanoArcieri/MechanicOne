<?php
/* Smarty version 5.8.0, created on 2026-07-14 23:14:33
  from 'file:garage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a56a6b9bbf611_43261947',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '04730dceeb326e841f9b9d4624b3fc3c57d0a2b4' => 
    array (
      0 => 'garage.tpl',
      1 => 1784063557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a56a6b9bbf611_43261947 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_575149216a56a6b9b4a098_32963585', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18357680266a56a6b9b54b93_94418465', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_575149216a56a6b9b4a098_32963585 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Il tuo garage - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18357680266a56a6b9b54b93_94418465 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Garage</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Il tuo garage' ?? null : $tmp);?>
</h1>
            <p>I veicoli collegati al tuo account.</p>
        </div>
        <a class="button" href="/MechanicOne/aggiungiveicolo/nuovo">+ Aggiungi veicolo</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('veicoli')) > 0) {?>
        <section class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('veicoli'), 'v');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('v')->value) {
$foreach0DoElse = false;
?>
                <article class="card">
                    <h2><?php echo $_smarty_tpl->getValue('v')['marca'];?>
 <?php echo $_smarty_tpl->getValue('v')['modello'];?>
</h2>
                    <p>Targa: <strong><?php echo $_smarty_tpl->getValue('v')['targa'];?>
</strong></p>
                    <div class="auth-actions">
                        <a class="home-link home-link--blue" href="/MechanicOne/richiedipreventivo/nuovo">Richiedi preventivo</a>
                        <form action="/MechanicOne/garage/eliminaVeicolo/<?php echo $_smarty_tpl->getValue('v')['idV'];?>
" method="post" onsubmit="return confirm('Eliminare questo veicolo?');">
                            <button class="btn btn--danger" type="submit">Elimina</button>
                        </form>
                    </div>
                </article>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </section>
    <?php } else { ?>
        <p class="auth-text">Non hai ancora nessun veicolo. Aggiungine uno per iniziare a richiedere preventivi e prenotazioni.</p>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
