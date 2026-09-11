<?php
/* Smarty version 5.8.0, created on 2026-09-09 18:54:44
  from 'file:utente/profilo_utente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa18f54091189_84206994',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c924d440c910ce8bcf52a5f5d2a79b2c7c6b1e36' => 
    array (
      0 => 'utente/profilo_utente.tpl',
      1 => 1788972860,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa18f54091189_84206994 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3505374086aa18f540790d5_71203642', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21106785966aa18f5407e007_41972530', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_3505374086aa18f540790d5_71203642 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Area Cliente - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_21106785966aa18f5407e007_41972530 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="auth-panel auth-panel--user">
    <div class="client-hero">
        <img class="client-hero__img" src="/MechanicOne/templates/img/officina-banner.jpg" alt="Officina MechanicOne, meccanici al lavoro su più auto sollevate sui ponti">
        <div class="client-hero__overlay">
            <p class="hero-eyebrow hero-eyebrow--light">Area cliente</p>
            <h1 class="client-hero__title">Benvenuto nella tua area personale, <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nome')), ENT_QUOTES, 'UTF-8');?>
! 🚗</h1>
            <p class="hero-text hero-text--light">Questa è la tua area privata in MechanicOne. Da qui puoi avere un anteprima su i tuoi veicoli, preventivi e prenotazioni.</p>
        </div>
    </div>

    <h2 class="section-title">Il tuo garage</h2>
    <div class="info-panel"><strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countVeicoliTotali')), ENT_QUOTES, 'UTF-8');?>
</strong> veicoli registrati.</div>
    <?php if ($_smarty_tpl->getValue('countVeicoliTotali') > 0) {?>
        <ul class="hero-steps">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('veicoli'), 'v');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('v')->value) {
$foreach0DoElse = false;
?>
                <li><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['marca']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['modello']), ENT_QUOTES, 'UTF-8');?>
 (<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('v')['targa']), ENT_QUOTES, 'UTF-8');?>
)</li>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </ul>
    <?php }?>

    <h2 class="section-title">I tuoi preventivi</h2>
    <div class="info-panel">Totali: <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPreventiviTotali')), ENT_QUOTES, 'UTF-8');?>
</strong> — Inviati: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPreventiviInviati')), ENT_QUOTES, 'UTF-8');?>
, Accettati: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPreventiviAccettati')), ENT_QUOTES, 'UTF-8');?>
, Rifiutati: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPreventiviRifiutati')), ENT_QUOTES, 'UTF-8');?>
, Svolti: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPreventiviSvolti')), ENT_QUOTES, 'UTF-8');?>
.</div>

    <h2 class="section-title">Le tue prenotazioni</h2>
    <div class="info-panel">Totali: <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPrenotazioniTotali')), ENT_QUOTES, 'UTF-8');?>
</strong> — In attesa: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPrenotazioniInAttesa')), ENT_QUOTES, 'UTF-8');?>
, Accettate: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPrenotazioniAccettate')), ENT_QUOTES, 'UTF-8');?>
, Concluse: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPrenotazioniConcluse')), ENT_QUOTES, 'UTF-8');?>
, Cancellate: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('countPrenotazioniCancellate')), ENT_QUOTES, 'UTF-8');?>
.</div>

    <hr class="auth-divider">
    <div class="cta-panel">👤 Per visualizzare il tuo garage, aggiungere veicoli, richiedere un preventivo o una prenotazione, clicca sulla tua icona utente!</div>
    <a class="home-link home-link--danger" href="/MechanicOne/utente/logout">Esci dall'Officina</a>
</div>
<?php
}
}
/* {/block 'content'} */
}
