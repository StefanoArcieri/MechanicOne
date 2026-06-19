<?php
/* Smarty version 5.8.0, created on 2026-06-14 23:52:08
  from 'file:home_meccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2f2288c70299_27721612',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '327a5fa0d845cbee92524e07497a9445be762bb8' => 
    array (
      0 => 'home_meccanico.tpl',
      1 => 1781473890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2f2288c70299_27721612 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Meccanico - MechanicOne</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #fafaf9; padding: 20px;">
    <div style="max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #f39c12;">
        <h2 style="color: #2c3e50;">Benvenuto, <?php echo $_smarty_tpl->getValue('nome');?>
!</h2>
        <p style="color: #7f8c8d;">Questa è la tua area di lavoro come <strong>Meccanico</strong>. Da qui potrai visualizzare gli appuntamenti e i preventivi in attesa di approvazione.</p>
        <hr style="border: 0; height: 1px; background: #ecf0f1; margin: 20px 0;">
        <a href="/MechanicOne/utente/logout" style="display: inline-block; padding: 10px 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Esci / Logout</a>
    </div>
</body>
</html><?php }
}
