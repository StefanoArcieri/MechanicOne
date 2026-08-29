<?php
/* Smarty version 5.8.0, created on 2026-07-16 17:27:58
  from 'file:layouts/base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58f87ef2e8f2_37902979',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8d470a5407eb956363632e73f7f40b175b858b2' => 
    array (
      0 => 'layouts/base.tpl',
      1 => 1784215661,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58f87ef2e8f2_37902979 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8665523026a58f87eedfe39_28251613', "title");
?>
</title>
    <link rel="stylesheet" href="/MechanicOne/templates/css/style.css?v=3">
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
                        <?php if ($_smarty_tpl->getValue('isLogged')) {?>
                            <?php if ($_smarty_tpl->getValue('userRole') == 'meccanico') {?>
                                <a href="/MechanicOne/profilomeccanico/profilo">Il mio profilo</a>
                                <a href="/MechanicOne/gestiscipreventivi/lista">Preventivi da gestire</a>
                                <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                            <?php } elseif ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                                <a href="/MechanicOne/gestiscimeccanici/lista">Gestisci meccanici</a>
                                <a href="/MechanicOne/gestisciservizi/lista">Gestisci servizi</a>
                                <a href="/MechanicOne/gestiscipreventivi/lista">Preventivi da gestire</a>
                                <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                            <?php } else { ?>
                                <a href="/MechanicOne/profilomeccanico/area">Area Meccanico</a>
                                <a href="/MechanicOne/richiedipreventivo/nuovo">Richiedi un preventivo</a>
                                <a href="/MechanicOne/visualizzapreventivi/lista">Visualizza i tuoi preventivi</a>
                                <a href="/MechanicOne/richiediprenotazione/nuovo">Richiedi una prenotazione</a>
                                <a href="/MechanicOne/visualizzaprenotazioni/lista">Visualizza le tue prenotazioni</a>
                                <a href="/MechanicOne/aggiungiveicolo/nuovo">Aggiungi un veicolo</a>
                                <a href="/MechanicOne/garage/lista">Visualizza il tuo garage</a>
                            <?php }?>
                            <a href="/MechanicOne/utente/logout" class="profile-menu__logout">Esci</a>
                        <?php } else { ?>
                            <a href="/MechanicOne/utente/login">Accedi</a>
                            <a href="/MechanicOne/utente/registrazione">Registrati</a>
                        <?php }?>
                    </div>
                </details>
            </div>
        </header>

        <main class="page-layout">
            <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12008401746a58f87ef2c2a1_67907513', "content");
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
class Block_8665523026a58f87eedfe39_28251613 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
?>
MechanicOne<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_12008401746a58f87ef2c2a1_67907513 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
}
}
/* {/block "content"} */
}
