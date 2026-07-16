<?php
/* Smarty version 5.8.0, created on 2026-07-16 16:04:31
  from 'file:home_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58e4efa7b302_40132942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe9d953a178afb08ed8698cb1e9ef6b6566037ed' => 
    array (
      0 => 'home_admin.tpl',
      1 => 1784202398,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58e4efa7b302_40132942 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11341493446a58e4efa70a45_89416452', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15614277316a58e4efa79c09_67251451', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_11341493446a58e4efa70a45_89416452 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Pannello Admin - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_15614277316a58e4efa79c09_67251451 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel auth-panel--admin">
    <h2 class="auth-title auth-title--small">Pannello di Controllo, <?php echo $_smarty_tpl->getValue('nome');?>
!</h2>
    <p class="auth-text">Hai effettuato l'accesso come <strong>Amministratore Generale</strong>. Qui puoi gestire gli aspetti principali dell'officina.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Gestione meccanici</h3>
            <p>Approva i meccanici e controlla le loro specializzazioni.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/gestiscimeccanici/lista">Apri elenco meccanici</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza le richieste e i preventivi da gestire.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/gestiscipreventivi/lista">Apri preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Controlla gli appuntamenti in programma e lo stato delle prenotazioni.</p>
            <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Apri prenotazioni</a>
        </div>
        <div class="home-card">
            <h3>Servizi</h3>
            <p>Gestisci il catalogo dei servizi offerti dall'officina.</p>
            <a class="home-link home-link--purple" href="/MechanicOne/gestisciservizi/lista">Apri catalogo servizi</a>
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
