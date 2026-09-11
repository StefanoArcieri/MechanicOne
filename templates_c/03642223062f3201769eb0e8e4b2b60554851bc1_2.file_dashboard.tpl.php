<?php
/* Smarty version 5.8.0, created on 2026-09-11 16:01:06
  from 'file:meccanico/dashboard.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa409a2d87eb2_77440487',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03642223062f3201769eb0e8e4b2b60554851bc1' => 
    array (
      0 => 'meccanico/dashboard.tpl',
      1 => 1789135257,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa409a2d87eb2_77440487 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1342382686aa409a2d61936_67001990', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19351594466aa409a2d6d269_49736003', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_1342382686aa409a2d61936_67001990 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
?>
Dashboard Meccanico - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19351594466aa409a2d6d269_49736003 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
?>

<div class="auth-panel auth-panel--mechanic">
    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><strong>Errore:</strong> <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('profilo')) {?>
        <div class="dashboard-hero">
            <?php if ($_smarty_tpl->getValue('profilo')['foto_profilo']) {?>
                <img class="profile-photo" src="/MechanicOne/uploads/meccanici/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['foto_profilo']), ENT_QUOTES, 'UTF-8');?>
" alt="Foto profilo di <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['cognome']), ENT_QUOTES, 'UTF-8');?>
">
            <?php } else { ?>
                <div class="dashboard-hero__avatar-placeholder"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['iniziale']), ENT_QUOTES, 'UTF-8');?>
</div>
            <?php }?>
            <h2><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('profilo')['cognome']), ENT_QUOTES, 'UTF-8');?>
</h2>
            <p class="auth-text"><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('profilo')['specializzazione'] ?? null)===null||$tmp==='' ? 'Nessuna specializzazione indicata' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</p>
        </div>

        <hr class="auth-divider">

        <h3 class="auth-title auth-title--small">Situazione generale</h3>
        <div class="stat-grid">
            <div class="stat-card">
                <span class="stat-card__numero"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('stats')['daAccettare']), ENT_QUOTES, 'UTF-8');?>
</span>
                <span class="stat-card__etichetta">Prenotazioni disponibili</span>
            </div>
            <div class="stat-card">
                <span class="stat-card__numero"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('stats')['inCorso']), ENT_QUOTES, 'UTF-8');?>
</span>
                <span class="stat-card__etichetta">In carico a te</span>
            </div>
            <div class="stat-card">
                <span class="stat-card__numero"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('stats')['concluse']), ENT_QUOTES, 'UTF-8');?>
</span>
                <span class="stat-card__etichetta">Interventi conclusi da te</span>
            </div>
        </div>

        <hr class="auth-divider">

        <h3 class="auth-title auth-title--small">Cosa vuoi fare?</h3>
        <div class="home-grid">
            <div class="home-card">
                <h3>Il mio profilo</h3>
                <p>Modifica la tua specializzazione, la foto profilo o la password.</p>
                <a class="home-link home-link--orange" href="/MechanicOne/profilomeccanico/profilo">Vai al profilo</a>
            </div>
            <div class="home-card">
                <h3>Prenotazioni</h3>
                <p>Prendi in carico nuovi interventi e gestisci quelli già assegnati a te.</p>
                <a class="home-link home-link--green" href="/MechanicOne/gestisciprenotazioni/lista">Gestisci prenotazioni</a>
            </div>
        </div>

        <hr class="auth-divider">
        <a class="btn btn--danger" href="/MechanicOne/utente/logout">Esci / Logout</a>
    <?php } else { ?>
        <p class="auth-text">Profilo non disponibile.</p>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
