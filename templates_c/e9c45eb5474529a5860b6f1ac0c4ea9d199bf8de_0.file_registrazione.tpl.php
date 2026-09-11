<?php
/* Smarty version 5.8.0, created on 2026-09-03 17:50:16
  from 'file:registrazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99973834b4c8_64601668',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9c45eb5474529a5860b6f1ac0c4ea9d199bf8de' => 
    array (
      0 => 'registrazione.tpl',
      1 => 1784128572,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99973834b4c8_64601668 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_13016170646a999738341eb5_88184335', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4046762956a9997383474a1_68550300', 'content');
$_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_13016170646a999738341eb5_88184335 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Registrazione - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_4046762956a9997383474a1_68550300 extends \Smarty\Runtime\Block
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
            <strong>❌ Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>

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

        <div class="form-field">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="password" required placeholder="Scegli una password sicura" class="form-input">
        </div>

        <div class="form-field">
            <label for="ruolo" class="form-label">Tipo di account</label>
            <select id="ruolo" name="ruolo" class="form-input" onchange="toggleSpecializzazione(this.value)">
                <option value="cliente">Cliente</option>
                <option value="meccanico">Meccanico</option>
            </select>
        </div>

        <div class="form-field form-field--last" id="campo-specializzazione" style="display:none;">
            <label for="specializzazione" class="form-label">Specializzazione</label>
            <input type="text" id="specializzazione" name="specializzazione" placeholder="Es. Elettrauto, Carrozzeria..." class="form-input">
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
<?php echo '<script'; ?>
>
function toggleSpecializzazione(ruolo) {
    var campo = document.getElementById('campo-specializzazione');
    campo.style.display = ruolo === 'meccanico' ? 'block' : 'none';
}
<?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'content'} */
}
