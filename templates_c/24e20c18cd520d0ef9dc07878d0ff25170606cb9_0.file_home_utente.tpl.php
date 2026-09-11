<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:50:31
  from 'file:utente/home_utente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9997476873f7_29032176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e20c18cd520d0ef9dc07878d0ff25170606cb9' => 
    array (
      0 => 'utente/home_utente.tpl',
      1 => 1788449079,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:utente/scrivirecensione.tpl' => 1,
    'file:utente/visualizzarecensioni.tpl' => 1,
  ),
))) {
function content_6a9997476873f7_29032176 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19828864016a9997476746e6_64768495', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18140982966a99974767e776_23851151', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_19828864016a9997476746e6_64768495 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Area Cliente - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18140982966a99974767e776_23851151 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="auth-panel auth-panel--user">
    <h1 class="auth-title auth-title--small">Benvenuto a bordo, <?php echo $_smarty_tpl->getValue('nome');?>
! 🚗</h1>
    <p class="auth-text">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi motori.</p>

    <div class="home-grid">
        <div class="home-card">
            <h3>Garage Personale 🛠️</h3>
            <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/garage/lista">Gestisci Veicoli &rarr;</a>
        </div>
        <div class="home-card">
            <h3>Preventivi e Prenotazioni 📝</h3>
            <p>Controlla lo stato dei tuoi preventivi o prenota un appuntamento sul ponte.</p>
            <a class="home-link home-link--blue" href="/MechanicOne/visualizzapreventivi/lista">Vedi Richieste &rarr;</a>
        </div>
    </div>

    <hr class="auth-divider">
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>

    <?php $_smarty_tpl->renderSubTemplate('file:utente/scrivirecensione.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <?php $_smarty_tpl->renderSubTemplate('file:utente/visualizzarecensioni.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</div>
<?php
}
}
/* {/block 'content'} */
}
