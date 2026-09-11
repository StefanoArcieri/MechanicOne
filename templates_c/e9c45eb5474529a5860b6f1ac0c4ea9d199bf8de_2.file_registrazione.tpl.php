<?php
/* Smarty version 5.8.0, created on 2026-09-06 16:38:01
  from 'file:registrazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9d7ac992b3e9_40016013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9c45eb5474529a5860b6f1ac0c4ea9d199bf8de' => 
    array (
      0 => 'registrazione.tpl',
      1 => 1788539995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9d7ac992b3e9_40016013 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20251680576a9d7ac9920168_09367450', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19846564936a9d7ac99262d6_83631235', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_20251680576a9d7ac9920168_09367450 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Registrazione - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19846564936a9d7ac99262d6_83631235 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="form-panel form-panel--register">
    <div class="form-header">
        <h2 class="form-title">🔧 Unisciti a MechanicOne</h2>
        <p class="form-subtitle">Crea il tuo profilo per gestire i tuoi veicoli e richiedere preventivi</p>
    </div>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert">
            <strong>❌ Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>

        </div>
    <?php }?>

    <form action="/MechanicOne/utente/registrazione" method="POST" class="form">
        <div class="form-field">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" required placeholder="Inserisci il tuo nome" class="form-input">
        </div>

        <div class="form-field">
            <label for="cognome" class="form-label">Cognome</label>
            <input type="text" id="cognome" name="cognome" required placeholder="Inserisci il tuo cognome" class="form-input">
        </div>

        <div class="form-field">
            <label for="email" class="form-label">Indirizzo Email</label>
            <input type="email" id="email" name="email" required placeholder="esempio@email.it" class="form-input">
        </div>

        <div class="form-field form-field--last">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" required minlength="8" placeholder="Almeno 8 caratteri" class="form-input">
        </div>

        <button type="submit" class="form-submit form-submit--primary">
            Registrati e Accedi
        </button>
    </form>

    <div class="form-footer">
        <p class="form-help">
            Hai già un account? <a href="/MechanicOne/utente/login" class="form-link">Torna al Login</a>
        </p>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
