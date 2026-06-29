<?php
/* Smarty version 5.8.0, created on 2026-06-28 17:40:30
  from 'file:home_meccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a41406eab1276_13731088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '327a5fa0d845cbee92524e07497a9445be762bb8' => 
    array (
      0 => 'home_meccanico.tpl',
      1 => 1782659087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a41406eab1276_13731088 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_5774349576a41406eaaa433_05290714', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12097911556a41406eab0364_56288550', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_5774349576a41406eaaa433_05290714 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Dashboard Meccanico - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_12097911556a41406eab0364_56288550 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel auth-panel--mechanic">
    <h2 class="auth-title auth-title--small">Benvenuto, <?php echo $_smarty_tpl->getValue('nome');?>
!</h2>
    <p class="auth-text">Questa è la tua area di lavoro come <strong>Meccanico</strong>. Qui puoi gestire preventivi, appuntamenti e il tuo profilo.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Il mio profilo</h3>
            <p>Verifica i tuoi dati e lo stato del tuo account.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/meccanico/profilo">Vedi profilo</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza i preventivi assegnati e le richieste aperte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Vedi preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Gestisci gli appuntamenti e l'agenda del tuo lavoro.</p>
            <a class="home-link home-link--green" href="/MechanicOne/prenotazione/lista">Vedi prenotazioni</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
</div>
<?php
}
}
/* {/block 'content'} */
}
