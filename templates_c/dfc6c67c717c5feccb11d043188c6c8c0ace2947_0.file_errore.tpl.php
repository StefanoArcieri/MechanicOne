<?php
/* Smarty version 5.8.0, created on 2026-06-14 23:48:34
  from 'file:errore.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2f21b2300489_37674180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfc6c67c717c5feccb11d043188c6c8c0ace2947' => 
    array (
      0 => 'errore.tpl',
      1 => 1781015551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2f21b2300489_37674180 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Errore <?php echo $_smarty_tpl->getValue('codice');?>
 - MechanicOne</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px; font-family: Arial, sans-serif;">
        <h2>🔧 Ops! Problema ai motori di MechanicOne 🔧</h2>
        <h1 style="font-size: 48px; color: #e74c3c;">Errore <?php echo $_smarty_tpl->getValue('codice');?>
</h1>
        <p style="font-size: 18px; color: #555;"><?php echo $_smarty_tpl->getValue('messaggio');?>
</p>
        <hr style="width: 50%; margin: 20px auto; border: 0; border-top: 1px solid #eee;">
        <p><a href="/MechanicOne/" style="color: #3498db; text-decoration: none; font-weight: bold;">Torna all'ingresso dell'Officina</a></p>
    </div>
</body>
</html><?php }
}
