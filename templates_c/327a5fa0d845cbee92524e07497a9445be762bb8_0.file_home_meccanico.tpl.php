<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:33:29
  from 'file:home_meccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a5693d1570_98398939',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '327a5fa0d845cbee92524e07497a9445be762bb8' => 
    array (
      0 => 'home_meccanico.tpl',
      1 => 1784131863,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a5693d1570_98398939 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8443092186a58a5693a9934_46380269', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4483102026a58a5693ca851_89098357', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_8443092186a58a5693a9934_46380269 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Dashboard Meccanico - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_4483102026a58a5693ca851_89098357 extends \Smarty\Runtime\Block
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
            <a class="home-link home-link--orange" href="/MechanicOne/profilomeccanico/profilo">Vedi profilo</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza i preventivi assegnati e le richieste aperte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/gestiscipreventivi/lista">Vedi preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Gestisci gli appuntamenti e l'agenda del tuo lavoro.</p>
            <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Vedi prenotazioni</a>
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
