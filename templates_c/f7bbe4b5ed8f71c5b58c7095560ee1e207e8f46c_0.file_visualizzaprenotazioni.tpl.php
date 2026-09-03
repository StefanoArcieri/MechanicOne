<?php
/* Smarty version 5.8.0, created on 2026-09-03 19:31:31
  from 'file:utente/visualizzaprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99aef3a820b5_22999294',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7bbe4b5ed8f71c5b58c7095560ee1e207e8f46c' => 
    array (
      0 => 'utente/visualizzaprenotazioni.tpl',
      1 => 1788456653,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99aef3a820b5_22999294 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_9809891436a99aef3a06dd5_15853839', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1236125096a99aef3a130a7_63623250', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_9809891436a99aef3a06dd5_15853839 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Le tue prenotazioni - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_1236125096a99aef3a130a7_63623250 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
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
                            <h3>Prenotazione #<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
</h3>
                            <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
</p>
                            <?php if ($_smarty_tpl->getValue('sezione')['modificabile']) {?>
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
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['cancellabile']) {?>
                                <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
                                </form>
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
