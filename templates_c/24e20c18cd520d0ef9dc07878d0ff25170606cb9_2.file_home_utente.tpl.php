<?php
/* Smarty version 5.8.0, created on 2026-09-04 17:32:45
  from 'file:utente/home_utente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9ae49d6c5300_74976450',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e20c18cd520d0ef9dc07878d0ff25170606cb9' => 
    array (
      0 => 'utente/home_utente.tpl',
      1 => 1788535859,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:utente/scrivirecensione.tpl' => 1,
    'file:utente/visualizzarecensioni.tpl' => 1,
  ),
))) {
function content_6a9ae49d6c5300_74976450 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_15905404516a9ae49d6b0217_27802726', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20620669086a9ae49d6bdc11_12736193', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_15905404516a9ae49d6b0217_27802726 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Area Cliente - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_20620669086a9ae49d6bdc11_12736193 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="auth-panel auth-panel--user">
    <div class="client-hero">
        <img class="client-hero__img" src="/MechanicOne/templates/img/officina-banner.jpg" alt="Officina MechanicOne, meccanici al lavoro su più auto sollevate sui ponti">
        <div class="client-hero__overlay">
            <p class="hero-eyebrow hero-eyebrow--light">Area cliente</p>
            <h1 class="client-hero__title">Benvenuto a bordo, <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nome')), ENT_QUOTES, 'UTF-8');?>
! 🚗</h1>
            <p class="hero-text hero-text--light">Questa è la tua area privata in MechanicOne. Da qui puoi gestire i tuoi veicoli, i preventivi e le prenotazioni.</p>
        </div>
    </div>

    <div class="home-grid">
        <div class="home-card">
            <span class="feature-item__icon">🚗</span>
            <h3>Garage Personale</h3>
            <p>Visualizza le auto che hai registrato nell'officina o aggiungi un nuovo veicolo.</p>
            <a class="home-link home-link--orange" href="/MechanicOne/garage/lista">Gestisci Veicoli &rarr;</a>
        </div>
        <div class="home-card">
            <span class="feature-item__icon">📝</span>
            <h3>Preventivi e Prenotazioni</h3>
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
