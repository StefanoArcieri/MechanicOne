<?php
/* Smarty version 5.8.0, created on 2026-06-09 15:53:01
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a281abdbfe9b1_19268525',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
      1 => 1780588174,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a281abdbfe9b1_19268525 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>MechanicOne - Benvenuto</title>
</head>
<body>

    <div style="text-align: center; margin-top: 80px; font-family: Arial, sans-serif;">
        <h1>🔧 Benvenuto su MechanicOne!</h1>
        <p>La piattaforma digitale per la gestione della tua officina di fiducia.</p>
        <hr style="width: 40%; margin: 20px auto; border-color: #eee;">
        
        <p>Sei già cliente o vuoi registrarti?</p>
        <a href="utente/mostraLogin" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 5px;">Accedi (Login)</a>
        <a href="utente/mostraRegistrazione" style="display: inline-block; padding: 10px 20px; background-color: #28a745; color: white; text-decoration: none; border-radius: 5px; margin: 5px;">Registrati</a>
    </div>

</body>
</html><?php }
}
