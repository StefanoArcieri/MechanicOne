<?php
/* Smarty version 5.8.0, created on 2026-09-09 20:08:23
  from 'file:layouts/base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa1a097e9ad33_36652607',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8d470a5407eb956363632e73f7f40b175b858b2' => 
    array (
      0 => 'layouts/base.tpl',
      1 => 1788977228,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa1a097e9ad33_36652607 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8309755236aa1a097e92fe3_99896560', "title");
?>
</title>
    <link rel="stylesheet" href="/MechanicOne/templates/css/style.css?v=22">
</head>
<body class="page-shell">
    <div class="page-wrapper">
        <header class="site-header">
            <a class="site-brand" href="/MechanicOne">MechanicOne</a>

            <div class="header-user">
                <?php if ($_smarty_tpl->getValue('isLogged')) {?>
                    <span class="header-greeting">Benvenuto, <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('nomeUtente')), ENT_QUOTES, 'UTF-8');?>
</span>
                <?php } else { ?>
                    <a class="header-login-link" href="/MechanicOne/utente/login">Benvenuto, clicca qui per accedere</a>
                <?php }?>

                <details class="profile-menu">
                    <summary class="profile-menu__trigger" aria-label="Menu profilo">👤</summary>
                    <div class="profile-menu__panel">
                        
                        <?php if ($_smarty_tpl->getValue('userRole') == 'meccanico') {?>
                            <a href="/MechanicOne/profilomeccanico/profilo">Il mio profilo</a>
                            <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                        <?php } elseif ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                            <a href="/MechanicOne/gestiscimeccanici/lista">Gestisci meccanici</a>
                            <a href="/MechanicOne/gestisciservizi/lista">Gestisci servizi</a>
                            <a href="/MechanicOne/gestiscipreventivi/lista">Preventivi da gestire</a>
                            <a href="/MechanicOne/gestisciprenotazioni/lista">Prenotazioni da gestire</a>
                        <?php } else { ?>
                            <a href="/MechanicOne/utente/dashboardUtente">Il mio profilo</a>
                            <a href="/MechanicOne/richiedipreventivo/nuovo">Richiedi un preventivo</a>
                            <a href="/MechanicOne/visualizzapreventivi/lista">Visualizza i tuoi preventivi</a>
                            <a href="/MechanicOne/richiediprenotazione/nuovo">Richiedi una prenotazione</a>
                            <a href="/MechanicOne/visualizzaprenotazioni/lista">Visualizza le tue prenotazioni</a>
                            <a href="/MechanicOne/veicolo/nuovo">Aggiungi un veicolo</a>
                            <a href="/MechanicOne/veicolo/lista">Visualizza il tuo garage</a>
                        <?php }?>
                        <?php if ($_smarty_tpl->getValue('isLogged')) {?>
                            <a href="/MechanicOne/utente/logout" class="profile-menu__logout">Esci</a>
                        <?php } else { ?>
                            <a href="/MechanicOne/utente/login" class="profile-menu__logout">Accedi</a>
                        <?php }?>
                    </div>
                </details>
            </div>
        </header>

        <main class="page-layout">
            <?php if ($_smarty_tpl->getValue('messaggioSuccesso')) {?>
                <div class="flash-success"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('messaggioSuccesso')), ENT_QUOTES, 'UTF-8');?>
</div>
            <?php }?>
            <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2989505936aa1a097e9a354_81018748', "content");
?>

        </main>

        <footer class="site-footer">
            <div class="footer-grid">
                <div class="footer-col footer-col--brand">
                    <p class="footer-brand">🔧 MechanicOne</p>
                    <p class="footer-tagline">Preventivi trasparenti, prenotazioni comode e meccanici qualificati: la tua officina di fiducia.</p>
                </div>

                <div class="footer-col">
                    <h3 class="footer-heading">Contatti</h3>
                    <ul class="footer-list">
                        <li><a href="tel:+390862451556">📞 0862 451 556</a></li>
                        <li><a href="mailto:info@mechanicone.it">✉️ info@mechanicone.it</a></li>
                        <li>🕑 Lun–Sab: 8:00–19:00</li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3 class="footer-heading">Dove siamo</h3>
                    <ul class="footer-list">
                        <li>📍 Via delle Aquile, 12</li>
                        <li>67100 L'Aquila (AQ)</li>
                        <li><a href="https://www.google.com/maps/search/?api=1&query=Via+delle+Aquile+12+67100+L%27Aquila+AQ" target="_blank" rel="noopener">Vedi sulla mappa</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3 class="footer-heading">Lavora con noi</h3>
                    <p class="footer-text">Sei un meccanico e vuoi entrare nel team? Scrivici: ti ricontatteremo per attivare il tuo profilo.</p>
                    <a class="footer-link" href="mailto:lavoraconnoi@mechanicone.it">✉️ lavoraconnoi@mechanicone.it</a>
                </div>
            </div>

            <div class="footer-bottom">
                <p>© 2026 MechanicOne - Officina meccanica di fiducia</p>
            </div>
        </footer>
    </div>
</body>
</html>
<?php }
/* {block "title"} */
class Block_8309755236aa1a097e92fe3_99896560 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
?>
MechanicOne<?php
}
}
/* {/block "title"} */
/* {block "content"} */
class Block_2989505936aa1a097e9a354_81018748 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\layouts';
}
}
/* {/block "content"} */
}
