<?php
/* Smarty version 5.8.0, created on 2026-09-10 16:47:31
  from 'file:admin/gestisciservizi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2c303b86a27_86488909',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b02d78c9f6049c4c3ae2d2e5b4dbac62df97d1e' => 
    array (
      0 => 'admin/gestisciservizi.tpl',
      1 => 1789051403,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2c303b86a27_86488909 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11310218886aa2c303b5e9d3_52148567', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3775807356aa2c303b67b63_41583651', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_11310218886aa2c303b5e9d3_52148567 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>
Catalogo servizi - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_3775807356aa2c303b67b63_41583651 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Catalogo servizi</h1>
            <p>I servizi che l'officina offre ai clienti.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
        <section class="status-section">
            <h2 class="status-section__title">Aggiungi servizio</h2>
            <div class="form-panel" style="width:auto; box-shadow:none; padding:0;">
                <form class="form" action="/MechanicOne/gestisciservizi/aggiungiServizio" method="post">
                    <div class="form-field">
                        <label class="form-label" for="titolo">Titolo</label>
                        <input class="form-input" type="text" id="titolo" name="titolo" required>
                    </div>
                    <div class="form-field form-field--last">
                        <label class="form-label" for="descrizione">Descrizione</label>
                        <textarea class="form-input" id="descrizione" name="descrizione" rows="2"></textarea>
                    </div>
                    <button class="form-submit form-submit--primary" type="submit">Aggiungi al catalogo</button>
                </form>
            </div>
        </section>
    <?php }?>

    <section class="status-section">
        <h2 class="status-section__title">Servizi <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi'))), ENT_QUOTES, 'UTF-8');?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi')) == 0) {?>
            <p class="auth-text">Nessun servizio a catalogo.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('servizi'), 's');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach0DoElse = false;
?>
                    <article class="card" id="servizio-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
">
                        <h3><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['titolo']), ENT_QUOTES, 'UTF-8');?>
</h3>
                        <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['descrizione']), ENT_QUOTES, 'UTF-8');?>
</p>
                        <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                            <div class="auth-actions">
                                <details class="inline-edit">
                                    <summary class="btn btn--secondary">Modifica</summary>
                                    <form class="form inline-edit__form" action="/MechanicOne/gestisciservizi/modificaServizio/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <div class="form-field">
                                            <label class="form-label" for="titolo-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
">Titolo</label>
                                            <input class="form-input" type="text" id="titolo-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
" name="titolo" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['titolo']), ENT_QUOTES, 'UTF-8');?>
" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <label class="form-label" for="descrizione-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
">Descrizione</label>
                                            <textarea class="form-input" id="descrizione-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
" name="descrizione" rows="2"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['descrizione']), ENT_QUOTES, 'UTF-8');?>
</textarea>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
                                    </form>
                                </details>
                                <form action="/MechanicOne/gestisciservizi/eliminaServizio/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['idS']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Eliminare questo servizio?');">
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
    </section>
</div>
<?php
}
}
/* {/block 'content'} */
}
