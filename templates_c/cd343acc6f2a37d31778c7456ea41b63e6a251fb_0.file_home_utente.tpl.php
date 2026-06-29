<?php
/* Smarty version 5.8.0, created on 2026-06-28 16:17:23
  from 'file:home_utente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a412cf332a1b4_71058056',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cd343acc6f2a37d31778c7456ea41b63e6a251fb' => 
    array (
      0 => 'home_utente.tpl',
      1 => 1782656134,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a412cf332a1b4_71058056 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_318787186a412cf3320c99_42468029', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9088986916a412cf3328fd0_30461448', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_318787186a412cf3320c99_42468029 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Area Cliente - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_9088986916a412cf3328fd0_30461448 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel auth-panel--user">
    <h1 class="auth-title auth-title--small">Benvenuto a bordo, <?php echo $_smarty_tpl->getValue('nome');?>
! 🚗</h1>
    <p class="auth-text">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi motori.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Garage Personale 🛠️</h3>
            <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/veicolo/lista">Gestisci Veicoli &rarr;</a>
        </div>
        <div class="home-card">
            <h3>Preventivi e Prenotazioni 📝</h3>
            <p>Controlla lo stato dei tuoi preventivi o prenota un appuntamento sul ponte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Vedi Richieste &rarr;</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>
</div>
<?php
}
}
/* {/block 'content'} */
}
