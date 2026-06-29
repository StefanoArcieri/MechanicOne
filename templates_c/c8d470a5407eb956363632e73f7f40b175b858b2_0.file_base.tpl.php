<?php
/* Smarty version 5.8.0, created on 2026-06-29 18:21:04
  from 'file:layouts/base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a429b70381761_29296357',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8d470a5407eb956363632e73f7f40b175b858b2' => 
    array (
      0 => 'layouts/base.tpl',
      1 => 1782750051,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a429b70381761_29296357 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8915090456a429b70346828_85525081', "title");
?>
</title>
    <link rel="stylesheet" href="/MechanicOne/templates/css/style.css">
</head>
<body class="page-shell">
    <div class="page-wrapper">
        <header class="site-header">
            <a class="site-brand" href="/MechanicOne">MechanicOne</a>

            <div class="header-user">
                <?php if ($_smarty_tpl->getValue('isLogged')) {?>
                    <span class="header-greeting">Benvenuto, <?php echo $_smarty_tpl->getValue('nomeUtente');?>
</span>
                <?php } else { ?>
                    <a class="header-login-link" href="/MechanicOne/utente/login">Benvenuto, clicca qui per accedere</a>
                <?php }?>

                <details class="profile-menu">
                    <summary class="profile-menu__trigger" aria-label="Menu profilo">👤</summary>
                    <div class="profile-menu__panel">
                        <a href="/MechanicOne/meccanico/area">Area Meccanico</a>
                        <a href="/MechanicOne/preventivo/richiedi"> Richiedi un preventivo</a>
                        <a href="/MechanicOne/preventivo/lista"> Visualizza i tuoi preventivi</a>
                        <a href="/MechanicOne/prenotazione/prenota"> Richiedi una prenotazione</a>
                        <a href="/MechanicOne/prenotazione/lista"> Visualizza le tue prenotazioni</a>
                        <a href="/MechanicOne/veicolo/aggiungiVeicolo"> Aggiungi un veicolo</a>
                        <a href="/MechanicOne/veicolo/getVeicoliPersonali"> Visualizza il tuo garage</a>
                    </div>
                </details>
            </div>
        </header>

        <main class="page-layout">
            <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18958829126a429b7037f5a1_49234699', "content");
?>

        </main>

        <footer class="site-footer">
            <p>© 2026 MechanicOne - Officina meccanica di fiducia</p>
        </footer>
    </div>
</body>
</html>
<?php }
/* {block "title"} */
class Block_8915090456a429b70346828_85525081 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
?>
MechanicOne<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_18958829126a429b7037f5a1_49234699 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
}
}
/* {/block "content"} */
}
