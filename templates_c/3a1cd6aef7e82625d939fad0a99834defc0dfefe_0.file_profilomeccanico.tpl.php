<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:33:50
  from 'file:profilomeccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a57e493b85_73419429',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a1cd6aef7e82625d939fad0a99834defc0dfefe' => 
    array (
      0 => 'profilomeccanico.tpl',
      1 => 1784130968,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a57e493b85_73419429 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7305726536a58a57e417f85_02225197', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10881498686a58a57e4565d3_57380503', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_7305726536a58a57e417f85_02225197 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Profilo meccanico' ?? null : $tmp);?>
 - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_10881498686a58a57e4565d3_57380503 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="auth-panel auth-panel--mechanic">
    <h1 class="auth-title"><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Profilo meccanico' ?? null : $tmp);?>
</h1>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('team')) {?>
        <p class="auth-text">Vuoi far parte del team di MechanicOne? Inviaci il tuo curriculum e ti ricontatteremo.</p>
        <a class="btn btn--primary" href="/MechanicOne/utente/registrazione">Candidati come meccanico</a>
    <?php } elseif ($_smarty_tpl->getValue('profilo')) {?>
        <div class="home-grid">
            <div class="home-card">
                <h3><?php echo $_smarty_tpl->getValue('profilo')['nome'];?>
 <?php echo $_smarty_tpl->getValue('profilo')['cognome'];?>
</h3>
                <p><?php echo $_smarty_tpl->getValue('profilo')['email'];?>
</p>
                <p class="status-note">Stato account: <strong><?php echo $_smarty_tpl->getValue('profilo')['status'];?>
</strong></p>
                <p><?php echo (($tmp = $_smarty_tpl->getValue('profilo')['specializzazione'] ?? null)===null||$tmp==='' ? 'Nessuna specializzazione indicata' ?? null : $tmp);?>
</p>
            </div>
        </div>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Modifica profilo</h2>
        <form class="form" action="/MechanicOne/profilomeccanico/aggiornaProfilo" method="post">
            <div class="form-field">
                <label class="form-label" for="specializzazione">Specializzazione</label>
                <input class="form-input" type="text" id="specializzazione" name="specializzazione" value="<?php echo $_smarty_tpl->getValue('profilo')['specializzazione'];?>
">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="foto">Link foto profilo</label>
                <input class="form-input" type="text" id="foto" name="foto" value="<?php echo $_smarty_tpl->getValue('profilo')['foto_profilo'];?>
" placeholder="https://...">
            </div>
            <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
        </form>
    <?php } else { ?>
        <p class="auth-text">Profilo non disponibile.</p>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
