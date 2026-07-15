<?php
/* Smarty version 5.8.0, created on 2026-07-14 21:23:53
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a568cc9b05914_36853758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
      1 => 1784023866,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:scrivirecensione.tpl' => 1,
    'file:visualizzarecensioni.tpl' => 1,
  ),
))) {
function content_6a568cc9b05914_36853758 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20918003176a568cc99af8a1_60990047', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3561059676a568cc9aae236_86430548', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_20918003176a568cc99af8a1_60990047 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Home - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_3561059676a568cc9aae236_86430548 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

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

    <?php $_smarty_tpl->renderSubTemplate('file:scrivirecensione.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
    <?php $_smarty_tpl->renderSubTemplate('file:visualizzarecensioni.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
</section>
<?php
}
}
/* {/block 'content'} */
}
