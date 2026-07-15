<?php
/* Smarty version 5.8.0, created on 2026-07-14 23:16:38
  from 'file:visualizzaprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a56a73699aa15_11513792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24e65cb3e82692d4803937dd6f6c0254c5fb9e8b' => 
    array (
      0 => 'visualizzaprenotazioni.tpl',
      1 => 1784063557,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a56a73699aa15_11513792 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17808312866a56a736916147_04543896', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14603513476a56a736922d17_62369502', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_17808312866a56a736916147_04543896 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Le tue prenotazioni - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_14603513476a56a736922d17_62369502 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Prenotazioni</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Le tue prenotazioni' ?? null : $tmp);?>
</h1>
            <p>Controlla i tuoi appuntamenti e proponi modifiche finché non vengono confermati.</p>
        </div>
        <a class="button" href="/MechanicOne/richiediprenotazione/nuovo">+ Richiedi prenotazione</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <section class="status-section">
        <h2 class="status-section__title">In attesa <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniInAttesa'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniInAttesa')) == 0) {?>
            <p class="auth-text">Nessuna prenotazione in attesa di conferma.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prenotazioniInAttesa'), 'p');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach0DoElse = false;
?>
                    <article class="card status-card status-card--in-attesa">
                        <h3>Prenotazione #<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
</p>
                        <?php if ($_smarty_tpl->getValue('p')['data_proposta']) {?>
                            <p class="status-note">Modifica proposta in attesa: <em><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data_proposta'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora_proposta'];?>
</em></p>
                            <form action="/MechanicOne/visualizzaprenotazioni/annullaModifica/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        <?php } else { ?>
                            <details class="edit-toggle">
                                <summary>Modifica data/ora</summary>
                                <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                    <div class="form-field">
                                        <input class="form-input" type="date" name="nuovaData" value="<?php echo $_smarty_tpl->getValue('p')['data'];?>
" required>
                                    </div>
                                    <div class="form-field form-field--last">
                                        <input class="form-input" type="time" name="nuovaOra" value="<?php echo $_smarty_tpl->getValue('p')['ora'];?>
" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        <?php }?>
                        <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                            <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                        </form>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Confermate <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniConfermate'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniConfermate')) == 0) {?>
            <p class="auth-text">Nessuna prenotazione confermata al momento.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prenotazioniConfermate'), 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                    <article class="card status-card status-card--accettata">
                        <h3>Prenotazione #<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
</p>
                        <?php if ($_smarty_tpl->getValue('p')['data_proposta']) {?>
                            <p class="status-note">Modifica proposta in attesa: <em><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data_proposta'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora_proposta'];?>
</em></p>
                            <form action="/MechanicOne/visualizzaprenotazioni/annullaModifica/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                <button class="btn btn--secondary" type="submit">Annulla modifica</button>
                            </form>
                        <?php } else { ?>
                            <details class="edit-toggle">
                                <summary>Modifica data/ora</summary>
                                <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                    <div class="form-field">
                                        <input class="form-input" type="date" name="nuovaData" value="<?php echo $_smarty_tpl->getValue('p')['data'];?>
" required>
                                    </div>
                                    <div class="form-field form-field--last">
                                        <input class="form-input" type="time" name="nuovaOra" value="<?php echo $_smarty_tpl->getValue('p')['ora'];?>
" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Proponi modifica</button>
                                </form>
                            </details>
                        <?php }?>
                        <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                            <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                        </form>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Concluse <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniConcluse'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniConcluse')) == 0) {?>
            <p class="auth-text">Nessun intervento concluso.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prenotazioniConcluse'), 'p');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach2DoElse = false;
?>
                    <article class="card status-card status-card--conclusa">
                        <h3>Prenotazione #<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
</p>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>

    <section class="status-section">
        <h2 class="status-section__title">Cancellate <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniCancellate'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('prenotazioniCancellate')) == 0) {?>
            <p class="auth-text">Nessuna prenotazione cancellata.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('prenotazioniCancellate'), 'p');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach3DoElse = false;
?>
                    <article class="card status-card status-card--cancellata">
                        <h3>Prenotazione #<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
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
