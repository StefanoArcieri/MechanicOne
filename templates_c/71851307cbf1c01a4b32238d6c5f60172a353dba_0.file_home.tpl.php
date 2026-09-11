<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:49:38
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99971205d311_21077277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
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
function content_6a99971205d311_21077277 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2225905496a99971204d124_33464603', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_6131651896a9997120586f4_71093011', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_2225905496a99971204d124_33464603 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Home - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_6131651896a9997120586f4_71093011 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="home-stack">
    <section class="hero-card">
        <div class="hero-content">
            <p class="hero-eyebrow">Benvenuto</p>
            <h1>MechanicOne</h1>
            <p class="hero-text">La tua officina online per prenotare interventi, richiedere preventivi e seguire i servizi di assistenza.</p>
        </div>

        <div class="hero-services">
            <h2>I nostri servizi</h2>
            <ul class="services-list">
                <li>Manutenzione ordinaria e straordinaria</li>
                <li>Riparazioni veicoli e controlli di sicurezza</li>
                <li>Preventivi rapidi e prenotazioni online</li>
            </ul>
        </div>
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
