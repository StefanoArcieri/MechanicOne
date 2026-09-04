<?php
/* Smarty version 5.8.0, created on 2026-09-04 17:49:05
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9ae871804a55_12294751',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
      1 => 1788534845,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:utente/scrivirecensione.tpl' => 1,
    'file:utente/visualizzarecensioni.tpl' => 1,
  ),
))) {
function content_6a9ae871804a55_12294751 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10743741506a9ae8717e6e60_37947041', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8492781886a9ae8717f4131_42294806', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_10743741506a9ae8717e6e60_37947041 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Home - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_8492781886a9ae8717f4131_42294806 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="home-stack">
    <section class="hero-split">
        <div class="hero-split__promo">
            <p class="hero-eyebrow hero-eyebrow--light">Benvenuto</p>
            <h1 class="hero-split__title">🔧 MechanicOne</h1>
            <p class="hero-text hero-text--light">La tua officina online per prenotare interventi, richiedere preventivi e seguire i servizi di assistenza, dalla prima richiesta al collaudo finale.</p>
            <div class="hero-cta">
                <a class="btn btn--accent" href="/MechanicOne/utente/registrazione">Registrati</a>
                <a class="btn btn--ghost-light" href="/MechanicOne/utente/login">Accedi</a>
            </div>
        </div>
        <div class="hero-split__action">
            <h2>Richiedi il tuo preventivo</h2>
            <p class="hero-text">Tre passaggi, prezzo chiaro prima di prenotare.</p>
            <ol class="hero-steps">
                <li>Registrati o accedi al tuo account</li>
                <li>Richiedi un preventivo per il servizio che ti serve</li>
                <li>Prenota l'intervento quando il prezzo è confermato</li>
            </ol>
            <a class="btn btn--primary hero-split__action-btn" href="/MechanicOne/richiedipreventivo/nuovo">Inizia ora</a>
        </div>
    </section>

    <section class="hero-card">
        <h2 class="section-title">I nostri servizi</h2>
        <div class="feature-grid">
            <div class="feature-item">
                <span class="feature-item__icon">🛠️</span>
                <h3>Manutenzione</h3>
                <p>Ordinaria e straordinaria, per tenere la tua auto sempre in forma.</p>
            </div>
            <div class="feature-item">
                <span class="feature-item__icon">🔍</span>
                <h3>Riparazioni</h3>
                <p>Diagnosi accurate e controlli di sicurezza su ogni componente.</p>
            </div>
            <div class="feature-item">
                <span class="feature-item__icon">📋</span>
                <h3>Preventivi</h3>
                <p>Richiesta rapida online, con un prezzo chiaro prima di ogni intervento.</p>
            </div>
        </div>
    </section>

    <section class="showcase-row">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-1.jpg" alt="Meccanica pronta ad accogliere un cliente in officina">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Il nostro approccio</p>
            <h2>Un'accoglienza che fa la differenza</h2>
            <p class="hero-text">Ogni richiesta viene seguita con attenzione: ti spieghiamo con chiarezza cosa serve alla tua auto, senza tecnicismi inutili, e ti accompagniamo dalla prima richiesta fino al ritiro del veicolo.</p>
        </div>
    </section>

    <section class="showcase-row showcase-row--reverse">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-2.jpg" alt="Meccanico al lavoro su un blocco motore">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Competenza tecnica</p>
            <h2>Riparazioni fatte a regola d'arte</h2>
            <p class="hero-text">Dalla manutenzione ordinaria agli interventi più complessi sul motore, lavoriamo con cura e strumentazione professionale, usando solo ricambi di qualità.</p>
        </div>
    </section>

    <section class="showcase-row">
        <div class="showcase-row__image">
            <img src="/MechanicOne/templates/img/team-3.jpg" alt="Meccanica al banco da lavoro con una chiave a cricchetto">
        </div>
        <div class="showcase-row__text">
            <p class="hero-eyebrow">Trasparenza</p>
            <h2>Diagnosi precise, zero sorprese</h2>
            <p class="hero-text">Controlliamo a fondo il problema prima di intervenire: ricevi un preventivo chiaro, con tempi e costi definiti, prima ancora che i lavori comincino.</p>
        </div>
    </section>

    <section class="trust-band">
        <p class="hero-eyebrow">Perché scegliere noi</p>
        <h2>Un punto di riferimento per la tua auto</h2>
        <p class="hero-text">Meccanici qualificati, prezzi decisi prima di ogni intervento e uno storico completo di preventivi e prenotazioni sempre a portata di mano dal tuo account.</p>
        <a class="btn btn--primary" href="/MechanicOne/richiedipreventivo/nuovo">Richiedi un preventivo</a>
    </section>

    <section class="hero-card">
        <?php $_smarty_tpl->renderSubTemplate('file:utente/scrivirecensione.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
        <?php $_smarty_tpl->renderSubTemplate('file:utente/visualizzarecensioni.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    </section>
</div>
<?php
}
}
/* {/block 'content'} */
}
