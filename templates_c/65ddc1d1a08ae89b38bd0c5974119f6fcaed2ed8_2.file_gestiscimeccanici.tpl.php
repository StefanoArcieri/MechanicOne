<?php
/* Smarty version 5.8.0, created on 2026-09-11 17:04:23
  from 'file:admin/gestiscimeccanici.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa41877c70568_25511419',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65ddc1d1a08ae89b38bd0c5974119f6fcaed2ed8' => 
    array (
      0 => 'admin/gestiscimeccanici.tpl',
      1 => 1788539995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa41877c70568_25511419 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_21422789896aa41877c57672_17906611', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18356988596aa41877c5b8d5_22303317', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_21422789896aa41877c57672_17906611 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>
Meccanici - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18356988596aa41877c5b8d5_22303317 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Meccanici' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</h1>
            <p>Il team di MechanicOne.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('credenzialiGenerate')) {?>
        <div class="credentials-box">
            <h3 class="credentials-box__title">✅ Account meccanico creato</h3>
            <p>Consegna queste credenziali al collaboratore: <strong>non verranno mostrate di nuovo</strong>.</p>
            <div class="credentials-box__row">
                <span class="credentials-box__label">Email</span>
                <code class="credentials-box__value"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('credenzialiGenerate')['email']), ENT_QUOTES, 'UTF-8');?>
</code>
            </div>
            <div class="credentials-box__row">
                <span class="credentials-box__label">Password provvisoria</span>
                <code class="credentials-box__value"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('credenzialiGenerate')['password']), ENT_QUOTES, 'UTF-8');?>
</code>
            </div>
        </div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
        <section class="status-section">
            <h2 class="status-section__title">Crea nuovo meccanico</h2>
            <div class="form-panel" style="width:auto; box-shadow:none; padding:0;">
                <form class="form" action="/MechanicOne/gestiscimeccanici/creaMeccanico" method="post">
                    <div class="form-field">
                        <label class="form-label" for="nome">Nome</label>
                        <input class="form-input" type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="cognome">Cognome</label>
                        <input class="form-input" type="text" id="cognome" name="cognome" required>
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-input" type="email" id="email" name="email" required>
                    </div>
                    <div class="form-field form-field--last">
                        <label class="form-label" for="specializzazione">Specializzazione</label>
                        <input class="form-input" type="text" id="specializzazione" name="specializzazione" placeholder="Es. Elettrauto, Carrozzeria...">
                    </div>
                    <p class="form-hint">La password viene generata automaticamente: comparirà qui sopra subito dopo la creazione, pronta da copiare.</p>
                    <button class="form-submit form-submit--primary" type="submit">Crea account meccanico</button>
                </form>
            </div>
        </section>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('meccanici')) == 0) {?>
        <p class="auth-text">Nessun meccanico registrato.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach0DoElse = false;
?>
                <article class="card">
                    <h3><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['cognome']), ENT_QUOTES, 'UTF-8');?>
</h3>
                    <p><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('m')['specializzazione'] ?? null)===null||$tmp==='' ? 'Nessuna specializzazione indicata' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</p>
                    <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                        <div class="auth-actions">
                            <form action="/MechanicOne/gestiscimeccanici/eliminaMeccanico/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['idM']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Eliminare questo meccanico?');">
                                <button class="btn btn--danger" type="submit">Elimina</button>
                            </form>
                        </div>
                    <?php }?>
                </article>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
