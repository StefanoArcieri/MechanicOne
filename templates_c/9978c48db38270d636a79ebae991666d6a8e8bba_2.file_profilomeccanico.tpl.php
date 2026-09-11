<?php
/* Smarty version 5.8.0, created on 2026-09-10 18:48:13
  from 'file:meccanico/profilomeccanico.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2df4d840271_23305978',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9978c48db38270d636a79ebae991666d6a8e8bba' => 
    array (
      0 => 'meccanico/profilomeccanico.tpl',
      1 => 1789058857,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2df4d840271_23305978 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4633296036aa2df4d824b01_64501300', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2584944476aa2df4d831270_01164647', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_4633296036aa2df4d824b01_64501300 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Profilo meccanico' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
 - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_2584944476aa2df4d831270_01164647 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
?>

<div class="auth-panel auth-panel--mechanic">
    <h1 class="auth-title"><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Profilo meccanico' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</h1>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('profilo')) {?>
        <div class="home-grid">
            <div class="home-card">
                <?php if ($_smarty_tpl->getValue('profilo')['foto_profilo']) {?>
                    <img class="profile-photo" src="/MechanicOne/uploads/meccanici/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['foto_profilo']), ENT_QUOTES, 'UTF-8');?>
" alt="Foto profilo di <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['cognome']), ENT_QUOTES, 'UTF-8');?>
">
                <?php }?>
                <h3><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['cognome']), ENT_QUOTES, 'UTF-8');?>
</h3>
                <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['email']), ENT_QUOTES, 'UTF-8');?>
</p>
                <p><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('profilo')['specializzazione'] ?? null)===null||$tmp==='' ? 'Nessuna specializzazione indicata' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</p>
            </div>
        </div>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Modifica profilo</h2>
        <form class="form" action="/MechanicOne/profilomeccanico/aggiornaProfilo" method="post" enctype="multipart/form-data">
            <div class="form-field">
                <label class="form-label" for="specializzazione">Specializzazione</label>
                <input class="form-input" type="text" id="specializzazione" name="specializzazione" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['specializzazione']), ENT_QUOTES, 'UTF-8');?>
">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="foto">Foto profilo</label>
                <input class="form-input" type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/webp,image/gif">
                <p class="form-hint">JPG, PNG, WEBP o GIF, max 3&nbsp;MB. Lascia vuoto per non cambiarla.</p>
            </div>
            <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
        </form>

        <hr class="auth-divider">

        <h2 class="auth-title auth-title--small">Cambia password</h2>
        <p class="auth-text">Hai fatto accesso con la password provvisoria consegnata dall'admin? Impostane una tua qui sotto.</p>
        <form class="form" action="/MechanicOne/profilomeccanico/cambiaPassword" method="post">
            <div class="form-field">
                <label class="form-label" for="password_attuale">Password attuale</label>
                <input class="form-input" type="password" id="password_attuale" name="password_attuale" required>
            </div>
            <div class="form-field">
                <label class="form-label" for="nuova_password">Nuova password</label>
                <input class="form-input" type="password" id="nuova_password" name="nuova_password" required minlength="8" placeholder="Almeno 8 caratteri">
            </div>
            <div class="form-field form-field--last">
                <label class="form-label" for="conferma_password">Conferma nuova password</label>
                <input class="form-input" type="password" id="conferma_password" name="conferma_password" required minlength="8">
            </div>
            <button class="form-submit form-submit--primary" type="submit">Aggiorna password</button>
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
