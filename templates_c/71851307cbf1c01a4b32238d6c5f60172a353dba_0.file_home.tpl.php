<?php
/* Smarty version 5.8.0, created on 2026-06-29 17:38:10
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a429162693505_38076914',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
      1 => 1782680837,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a429162693505_38076914 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14626843196a429162686932_35935164', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10340209016a4291626925a2_10438248', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_14626843196a429162686932_35935164 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Home - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_10340209016a4291626925a2_10438248 extends \Smarty\Runtime\Block
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
</section>
<?php
}
}
/* {/block 'content'} */
}
