<?php
/* Smarty version 5.8.0, created on 2026-09-09 19:26:22
  from 'file:admin/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa196be0860b8_06458749',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '761c61ec1234eb38acb2cd5cd37450c1437e628f' => 
    array (
      0 => 'admin/dashboard.tpl',
      1 => 1788539995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa196be0860b8_06458749 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_579692256aa196be075500_65268864', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10585979886aa196be082d05_67461118', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_579692256aa196be075500_65268864 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>
Dashboard Admin - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_10585979886aa196be082d05_67461118 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>

<div class="auth-panel auth-panel--admin">
    <h2 class="auth-title auth-title--small">Pannello di Controllo, <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nome')), ENT_QUOTES, 'UTF-8');?>
!</h2>
    <p class="auth-text">Hai effettuato l'accesso come <strong>Amministratore Generale</strong>. Qui puoi gestire gli aspetti principali dell'officina.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Gestione meccanici</h3>
            <p>Crea nuovi account meccanico con credenziali pronte da consegnare e gestisci le specializzazioni del team.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/gestiscimeccanici/lista">Apri elenco meccanici</a>
        </div>
        <div class="home-card">
            <h3>Servizi</h3>
            <p>Gestisci il catalogo dei servizi offerti dall'officina.</p>
            <a class="home-link home-link--purple" href="/MechanicOne/gestisciservizi/lista">Apri catalogo servizi</a>
        </div>
        <div class="home-card">
            <h3>Preventivi</h3>
            <p>Valuta le richieste e fissa i prezzi: risultano svolti in automatico quando un meccanico prende in carico l'intervento.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/gestiscipreventivi/lista">Apri preventivi</a>
        </div>
        <div class="home-card">
            <h3>Prenotazioni</h3>
            <p>Controlla gli appuntamenti in programma, organizzati per mese e settimana.</p>
            <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Apri prenotazioni</a>
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
