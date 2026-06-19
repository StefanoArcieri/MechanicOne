<?php
/* Smarty version 5.8.0, created on 2026-06-14 23:26:59
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2f1ca3e93f84_34506771',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71851307cbf1c01a4b32238d6c5f60172a353dba' => 
    array (
      0 => 'home.tpl',
      1 => 1781016144,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2f1ca3e93f84_34506771 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Home Officina - MechanicOne</title>
</head>
<body>
    <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; text-align: center;">
        <h1>Benvenuto nell'Officina MechanicOne! 🔧🏎️</h1>
        <p>Il motore gira a pieni regimi, l'accesso è stato eseguito con successo.</p>
        
        <div style="background-color: #e8f8f5; border: 1px solid #a3e4d7; padding: 15px; border-radius: 4px; margin: 20px 0; color: #16a085;">
            <strong>Il tuo ID di sessione in officina è:</strong> <?php echo $_smarty_tpl->getValue('idUtente');?>

        </div>
        
        <p style="color: #27ae60; font-weight: bold; font-size: 18px;">Letsgooo! Stiamo gasicchiando di brutto in MVC puro!</p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 30px 0;">
        <p><a href="/MechanicOne/utente/login" style="color: #e74c3c; text-decoration: none; font-weight: bold;">Esci dall'Officina</a></p>
    </div>
</body>
</html><?php }
}
