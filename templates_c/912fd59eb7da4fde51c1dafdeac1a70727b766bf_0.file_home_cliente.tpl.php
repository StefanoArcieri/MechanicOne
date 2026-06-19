<?php
/* Smarty version 5.8.0, created on 2026-06-14 23:51:34
  from 'file:home_cliente.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2f2266c20e84_86521647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '912fd59eb7da4fde51c1dafdeac1a70727b766bf' => 
    array (
      0 => 'home_cliente.tpl',
      1 => 1781473890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2f2266c20e84_86521647 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Cliente - MechanicOne</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #fafaf9; padding: 20px;">
    <div style="max-width: 800px; margin: 40px auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #3498db;">
        <h2 style="color: #2c3e50;">Benvenuto, <?php echo $_smarty_tpl->getValue('nome');?>
!</h2>
        <p style="color: #7f8c8d;">Questa è la tua area riservata come <strong>Cliente</strong>. Da qui potrai gestire i tuoi veicoli, richiedere preventivi e controllare le prenotazioni.</p>
        <hr style="border: 0; height: 1px; background: #ecf0f1; margin: 20px 0;">
        <a href="/MechanicOne/utente/logout" style="display: inline-block; padding: 10px 20px; background-color: #e74c3c; color: white; text-decoration: none; border-radius: 4px; font-weight: bold;">Esci / Logout</a>
    </div>
</body>
</html><?php }
}
