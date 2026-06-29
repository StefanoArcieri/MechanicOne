<?php
/* Smarty version 5.8.0, created on 2026-06-28 17:04:50
  from 'file:home_admin.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a4138128685b2_44600621',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe9d953a178afb08ed8698cb1e9ef6b6566037ed' => 
    array (
      0 => 'home_admin.tpl',
      1 => 1782659087,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a4138128685b2_44600621 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3281735966a41381285c1b8_29622265', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19250026576a413812866f29_63458057', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_3281735966a41381285c1b8_29622265 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Pannello Admin - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19250026576a413812866f29_63458057 extends \Smarty\Runtime\Block
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
            <a class="home-link home-link--orange" href="/MechanicOne/meccanico/lista">Apri elenco meccanici</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Visualizza le richieste e i preventivi da gestire.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/preventivo/lista">Apri preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Controlla gli appuntamenti in programma e lo stato delle prenotazioni.</p>
            <a class="home-link home-link--green" href="/MechanicOne/prenotazione/lista">Apri prenotazioni</a>
        </div>
        <div class="home-card">
            <h3>Veicoli</h3>
            <p>Consulta i veicoli registrati dai clienti.</p>
            <a class="home-link home-link--purple" href="/MechanicOne/veicolo/lista">Apri garage veicoli</a>
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
