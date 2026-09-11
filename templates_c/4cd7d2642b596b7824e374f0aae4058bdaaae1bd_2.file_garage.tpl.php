<?php
/* Smarty version 5.8.0, created on 2026-09-10 13:43:52
  from 'file:utente/garage.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa297f8558880_96239331',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd7d2642b596b7824e374f0aae4058bdaaae1bd' => 
    array (
      0 => 'utente/garage.tpl',
      1 => 1789039829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa297f8558880_96239331 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15487733376aa297f8526572_78726096', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5058091596aa297f85327f4_14984489', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_15487733376aa297f8526572_78726096 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Il tuo garage - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_5058091596aa297f85327f4_14984489 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Garage</p>
            <h1>Il tuo garage</h1>
            <p>I veicoli collegati al tuo account.</p>
        </div>
        <a class="button" href="/MechanicOne/veicolo/nuovo">+ Aggiungi veicolo</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
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
                <article class="card" id="veicolo-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['idV']), ENT_QUOTES, 'UTF-8');?>
">
                    <h2><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['marca']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['modello']), ENT_QUOTES, 'UTF-8');?>
</h2>
                    <p>Targa: <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['targa']), ENT_QUOTES, 'UTF-8');?>
</strong></p>
                    <div class="auth-actions">
                        <a class="home-link home-link--blue" href="/MechanicOne/richiedipreventivo/nuovo/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['idV']), ENT_QUOTES, 'UTF-8');?>
">Richiedi preventivo</a>
                        <form action="/MechanicOne/veicolo/eliminaVeicolo/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['idV']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Eliminare questo veicolo? Verranno eliminati anche tutti i preventivi e le prenotazioni collegati, senza possibilità di recupero.');">
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
