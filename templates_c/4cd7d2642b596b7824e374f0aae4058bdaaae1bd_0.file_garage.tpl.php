<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:51:13
  from 'file:utente/garage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99977140bc80_46529230',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd7d2642b596b7824e374f0aae4058bdaaae1bd' => 
    array (
      0 => 'utente/garage.tpl',
      1 => 1788449079,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99977140bc80_46529230 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11561955296a9997713f2a71_04302067', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18542603106a9997713f6326_84467370', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_11561955296a9997713f2a71_04302067 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Il tuo garage - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18542603106a9997713f6326_84467370 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
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
