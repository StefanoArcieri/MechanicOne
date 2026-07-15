<?php
/* Smarty version 5.8.0, created on 2026-07-14 23:14:48
  from 'file:visualizzapreventivi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a56a6c8aa7892_37980380',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4b594bd46ab5dde8d63fcb971bb77f28adec609' => 
    array (
      0 => 'visualizzapreventivi.tpl',
      1 => 1784063557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a56a6c8aa7892_37980380 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2797434876a56a6c8a63173_97266389', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_20953639336a56a6c8a6c092_94770735', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_2797434876a56a6c8a63173_97266389 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
I tuoi preventivi - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_20953639336a56a6c8a6c092_94770735 extends \Smarty\Runtime\Block
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

    <section class="status-section">
        <h2 class="status-section__title">Inviati <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviInviati'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviInviati')) == 0) {?>
            <p class="auth-text">Nessun preventivo in attesa di risposta.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventiviInviati'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
                    <article class="card status-card status-card--inviato">
                        <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
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
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Accettati <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviAccettati'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviAccettati')) == 0) {?>
            <p class="auth-text">Nessun preventivo accettato al momento.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventiviAccettati'), 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                    <article class="card status-card status-card--accettato">
                        <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
                        <p class="status-note">Costo: <strong><?php if ($_smarty_tpl->getValue('p')['costo']) {
echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;<?php } else { ?>da definire<?php }?></strong></p>
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
                        <p><a class="home-link home-link--blue" href="/MechanicOne/richiediprenotazione/nuovo">Prenota un intervento &rarr;</a></p>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Svolti <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviSvolti'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviSvolti')) == 0) {?>
            <p class="auth-text">Nessun intervento concluso.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventiviSvolti'), 'p');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach2DoElse = false;
?>
                    <article class="card status-card status-card--svolto">
                        <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
                        <p class="status-note">Costo: <strong><?php echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;</strong></p>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Rifiutati <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviRifiutati'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('preventiviRifiutati')) == 0) {?>
            <p class="auth-text">Nessun preventivo rifiutato.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('preventiviRifiutati'), 'p');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach3DoElse = false;
?>
                    <article class="card status-card status-card--rifiutato">
                        <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
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
