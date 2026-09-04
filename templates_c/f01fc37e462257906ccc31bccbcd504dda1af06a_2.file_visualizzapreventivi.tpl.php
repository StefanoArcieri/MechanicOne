<?php
/* Smarty version 5.8.0, created on 2026-09-04 17:33:52
  from 'file:utente/visualizzapreventivi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a9ae4e0e09f70_35815425',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f01fc37e462257906ccc31bccbcd504dda1af06a' => 
    array (
      0 => 'utente/visualizzapreventivi.tpl',
      1 => 1788531364,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a9ae4e0e09f70_35815425 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20902503156a9ae4e0d81305_06730041', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18002936266a9ae4e0d8f452_68712170', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_20902503156a9ae4e0d81305_06730041 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
I tuoi preventivi - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18002936266a9ae4e0d8f452_68712170 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Preventivi</p>
            <h1><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'I tuoi preventivi' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</h1>
            <p>Segui lo stato delle tue richieste e proponi modifiche finché non vengono accettate.</p>
        </div>
        <a class="button" href="/MechanicOne/richiedipreventivo/nuovo">+ Richiedi preventivo</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezioni'), 'sezione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('sezione')->value) {
$foreach0DoElse = false;
?>
        <section class="status-section">
            <h2 class="status-section__title"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['label']), ENT_QUOTES, 'UTF-8');?>
 <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items'])), ENT_QUOTES, 'UTF-8');?>
</span></h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items']) == 0) {?>
                <p class="auth-text"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['vuoto']), ENT_QUOTES, 'UTF-8');?>
</p>
            <?php } else { ?>
                <div class="cards">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezione')['items'], 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                        <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['classe']), ENT_QUOTES, 'UTF-8');?>
">
                            <h3>Preventivo #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
</h3>
                            <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione']), ENT_QUOTES, 'UTF-8');?>
</p>
                            <?php if ($_smarty_tpl->getValue('p')['pdf'] && ($_smarty_tpl->getValue('p')['stato'] == 'accettato' || $_smarty_tpl->getValue('p')['stato'] == 'svolto')) {?>
                                <p><a class="form-link" href="/MechanicOne/visualizzapreventivi/scaricaPdf/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
">📄 Scarica PDF</a></p>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['mostraCosto']) {?>
                                <p class="status-note">Costo: <strong><?php if ($_smarty_tpl->getValue('p')['costo']) {
echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['costo']), ENT_QUOTES, 'UTF-8');?>
 &euro;<?php } else { ?>da definire<?php }?></strong></p>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['modificabile']) {?>
                                <?php if ($_smarty_tpl->getValue('p')['descrizione_proposta']) {?>
                                    <p class="status-note">Modifica proposta in attesa: <em><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione_proposta']), ENT_QUOTES, 'UTF-8');?>
</em></p>
                                    <form action="/MechanicOne/visualizzapreventivi/annullaModifica/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                                    </form>
                                <?php } else { ?>
                                    <details class="edit-toggle">
                                        <summary>Modifica</summary>
                                        <form class="form" action="/MechanicOne/visualizzapreventivi/modifica/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                            <div class="form-field form-field--last">
                                                <textarea class="form-input" name="nuovaDescrizione" rows="3" required><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione']), ENT_QUOTES, 'UTF-8');?>
</textarea>
                                            </div>
                                            <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                        </form>
                                    </details>
                                <?php }?>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['mostraPrenotaLink']) {?>
                                <p><a class="home-link home-link--blue" href="/MechanicOne/richiediprenotazione/nuovo">Prenota un intervento &rarr;</a></p>
                            <?php }?>
                        </article>
                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                </div>
            <?php }?>
        </section>
    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
</div>
<?php
}
}
/* {/block 'content'} */
}
