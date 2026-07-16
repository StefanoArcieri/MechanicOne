<?php
/* Smarty version 5.8.0, created on 2026-07-15 17:49:13
  from 'file:visualizzapreventivi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a57abf9e795b2_09944049',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4b594bd46ab5dde8d63fcb971bb77f28adec609' => 
    array (
      0 => 'visualizzapreventivi.tpl',
      1 => 1784130487,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a57abf9e795b2_09944049 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19886515316a57abf9a30249_43997201', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17789631816a57abf9c47de3_06554612', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_19886515316a57abf9a30249_43997201 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
I tuoi preventivi - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_17789631816a57abf9c47de3_06554612 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Preventivi</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'I tuoi preventivi' ?? null : $tmp);?>
</h1>
            <p>Segui lo stato delle tue richieste e proponi modifiche finché non vengono accettate.</p>
        </div>
        <a class="button" href="/MechanicOne/richiedipreventivo/nuovo">+ Richiedi preventivo</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezioni'), 'sezione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('sezione')->value) {
$foreach0DoElse = false;
?>
        <section class="status-section">
            <h2 class="status-section__title"><?php echo $_smarty_tpl->getValue('sezione')['label'];?>
 <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items']);?>
</span></h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items']) == 0) {?>
                <p class="auth-text"><?php echo $_smarty_tpl->getValue('sezione')['vuoto'];?>
</p>
            <?php } else { ?>
                <div class="cards">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezione')['items'], 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                        <article class="card status-card status-card--<?php echo $_smarty_tpl->getValue('sezione')['classe'];?>
">
                            <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                            <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
                            <?php if ($_smarty_tpl->getValue('sezione')['mostraCosto']) {?>
                                <p class="status-note">Costo: <strong><?php if ($_smarty_tpl->getValue('p')['costo']) {
echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;<?php } else { ?>da definire<?php }?></strong></p>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['modificabile']) {?>
                                <?php if ($_smarty_tpl->getValue('p')['descrizione_proposta']) {?>
                                    <p class="status-note">Modifica proposta in attesa: <em><?php echo $_smarty_tpl->getValue('p')['descrizione_proposta'];?>
</em></p>
                                    <form action="/MechanicOne/visualizzapreventivi/annullaModifica/<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" method="post">
                                        <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                                    </form>
                                <?php } else { ?>
                                    <details class="edit-toggle">
                                        <summary>Modifica</summary>
                                        <form class="form" action="/MechanicOne/visualizzapreventivi/modifica/<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" method="post">
                                            <div class="form-field form-field--last">
                                                <textarea class="form-input" name="nuovaDescrizione" rows="3" required><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
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
