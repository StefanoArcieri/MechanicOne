<?php
/* Smarty version 5.8.0, created on 2026-06-14 23:07:24
  from 'file:registrazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a2f180cd65132_96421272',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9c45eb5474529a5860b6f1ac0c4ea9d199bf8de' => 
    array (
      0 => 'registrazione.tpl',
      1 => 1781017934,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a2f180cd65132_96421272 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?><!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Registrazione - MechanicOne</title>
</head>
<body style="background-color: #fafaf9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0;">

    <div style="max-width: 500px; margin: 60px auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #2980b9;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="color: #2c3e50; margin: 0 0 10px 0; font-size: 24px;">🔧 Unisciti a MechanicOne</h2>
            <p style="color: #7f8c8d; margin: 0; font-size: 14px;">Crea il tuo profilo per gestire i tuoi veicoli e richiedere preventivi</p>
        </div>

                <?php if ($_smarty_tpl->getValue('errore')) {?>
            <div style="background-color: #fadbd8; border: 1px solid #f5b7b1; color: #78281f; padding: 12px; margin-bottom: 20px; border-radius: 4px; font-size: 14px;">
                <strong>❌ Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>

            </div>
        <?php }?>

                <form action="/MechanicOne/utente/registrazione" method="POST">
            
            <div style="margin-bottom: 15px;">
                <label for="nome" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Nome</label>
                <input type="text" id="nome" name="nome" required placeholder="Inserisci il tuo nome" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="cognome" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Cognome</label>
                <input type="text" id="cognome" name="cognome" required placeholder="Inserisci il tuo cognome" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Indirizzo Email</label>
                <input type="email" id="email" name="email" required placeholder="esempio@email.it" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

            <div style="margin-bottom: 25px;">
                <label for="password" style="display: block; color: #34495e; font-weight: 600; margin-bottom: 5px; font-size: 14px;">Password</label>
                <input type="password" id="password" name="password" required placeholder="Scegli una password sicura" 
                       style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; font-size: 14px; outline: none;">
            </div>

                        <button type="submit" 
                    style="width: 100%; background-color: #2980b9; color: white; border: none; padding: 12px; font-size: 16px; font-weight: bold; border-radius: 4px; cursor: pointer; transition: background 0.2s;">
                Registrati e Accedi
            </button>
            
        </form>

        <div style="margin-top: 20px; text-align: center; border-top: 1px solid #ecf0f1; padding-top: 15px;">
            <p style="margin: 0; font-size: 13px; color: #95a5a6;">
                Hai già un account? <a href="/MechanicOne/utente/login" style="color: #e67e22; text-decoration: none; font-weight: bold;">Torna al Login</a>
            </p>
        </div>

    </div>

</body>
</html><?php }
}
