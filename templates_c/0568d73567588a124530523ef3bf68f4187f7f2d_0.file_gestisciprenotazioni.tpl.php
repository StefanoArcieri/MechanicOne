<?php
/* Smarty version 5.8.0, created on 2026-09-03 19:32:23
  from 'file:gestione/gestisciprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99af27613bb2_97241808',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0568d73567588a124530523ef3bf68f4187f7f2d' => 
    array (
      0 => 'gestione/gestisciprenotazioni.tpl',
      1 => 1788455710,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99af27613bb2_97241808 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_17691450836a99af27590943_76300006', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19666538306a99af2759cc90_91787541', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_17691450836a99af27590943_76300006 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>
Prenotazioni da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_19666538306a99af2759cc90_91787541 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazioni da gestire' ?? null : $tmp);?>
</h1>
            <p>Conferma gli appuntamenti in attesa; sarà il meccanico a segnare quelli conclusi.</p>
        </div>
        <?php if ($_smarty_tpl->getValue('anno')) {?>
            <a class="btn btn--ghost" href="/MechanicOne/gestisciprenotazioni/lista/<?php echo $_smarty_tpl->getValue('anno');?>
/<?php echo $_smarty_tpl->getValue('mese');?>
">← Tutte le settimane</a>
        <?php }?>
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
                            <p class="status-note"><?php echo $_smarty_tpl->getValue('p')['clienteLabel'];?>
 — <?php echo $_smarty_tpl->getValue('p')['veicoloLabel'];?>
</p>
                            <p><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora'];?>
</p>
                            <?php if ($_smarty_tpl->getValue('p')['data_proposta']) {?>
                                <p class="status-note">Modifica proposta dal cliente: <em><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data_proposta'],"%d/%m/%Y");?>
 alle <?php echo $_smarty_tpl->getValue('p')['ora_proposta'];?>
</em></p>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('p')['meccanicoLabel']) {?>
                                <p class="status-note">Meccanico assegnato: <?php echo $_smarty_tpl->getValue('p')['meccanicoLabel'];?>
</p>
                            <?php }?>

                            <?php if ($_smarty_tpl->getValue('userRole') == 'admin' && ($_smarty_tpl->getValue('sezione')['classe'] == 'in-attesa' || $_smarty_tpl->getValue('sezione')['classe'] == 'accettata')) {?>
                                <details class="inline-edit">
                                    <summary class="btn btn--secondary">Modifica</summary>
                                    <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/modifica/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                        <div class="form-field">
                                            <label class="form-label" for="data-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
">Data</label>
                                            <input class="form-input" type="date" id="data-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" name="data" value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%Y-%m-%d");?>
" required>
                                        </div>
                                        <div class="form-field">
                                            <label class="form-label" for="ora-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
">Ora</label>
                                            <input class="form-input" type="time" id="ora-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" name="ora" value="<?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['ora'],"%H:%M");?>
" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <label class="form-label" for="idM-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
">Meccanico assegnato</label>
                                            <select class="form-input" id="idM-<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" name="idM">
                                                <option value=""<?php if (!$_smarty_tpl->getValue('p')['idM']) {?> selected<?php }?>>— Nessuno —</option>
                                                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach2DoElse = false;
?>
                                                    <option value="<?php echo $_smarty_tpl->getValue('m')['idM'];?>
"<?php if ($_smarty_tpl->getValue('p')['idM'] == $_smarty_tpl->getValue('m')['idM']) {?> selected<?php }?>><?php echo $_smarty_tpl->getValue('m')['nome'];?>
 <?php echo $_smarty_tpl->getValue('m')['cognome'];?>
</option>
                                                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                            </select>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
                                    </form>
                                </details>
                            <?php }?>

                            <?php if ($_smarty_tpl->getValue('sezione')['classe'] == 'in-attesa') {?>
                                <form action="/MechanicOne/gestisciprenotazioni/accetta/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                    <?php if ($_smarty_tpl->getValue('anno')) {?>
                                        <input type="hidden" name="anno" value="<?php echo $_smarty_tpl->getValue('anno');?>
">
                                        <input type="hidden" name="mese" value="<?php echo $_smarty_tpl->getValue('mese');?>
">
                                        <input type="hidden" name="settimanaInizio" value="<?php echo $_smarty_tpl->getValue('settimanaInizio');?>
">
                                    <?php }?>
                                    <button class="btn btn--success" type="submit">Conferma</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    <?php if ($_smarty_tpl->getValue('anno')) {?>
                                        <input type="hidden" name="anno" value="<?php echo $_smarty_tpl->getValue('anno');?>
">
                                        <input type="hidden" name="mese" value="<?php echo $_smarty_tpl->getValue('mese');?>
">
                                        <input type="hidden" name="settimanaInizio" value="<?php echo $_smarty_tpl->getValue('settimanaInizio');?>
">
                                    <?php }?>
                                    <button class="btn btn--danger" type="submit">Cancella</button>
                                </form>
                            <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'accettata') {?>
                                <?php if ($_smarty_tpl->getValue('userRole') == 'meccanico') {?>
                                    <form action="/MechanicOne/gestisciprenotazioni/concludi/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                        <?php if ($_smarty_tpl->getValue('anno')) {?>
                                            <input type="hidden" name="anno" value="<?php echo $_smarty_tpl->getValue('anno');?>
">
                                            <input type="hidden" name="mese" value="<?php echo $_smarty_tpl->getValue('mese');?>
">
                                            <input type="hidden" name="settimanaInizio" value="<?php echo $_smarty_tpl->getValue('settimanaInizio');?>
">
                                        <?php }?>
                                        <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                    </form>
                                <?php } else { ?>
                                    <p class="status-note">In lavorazione: sarà il meccanico a segnarla come conclusa a fine intervento.</p>
                                <?php }?>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    <?php if ($_smarty_tpl->getValue('anno')) {?>
                                        <input type="hidden" name="anno" value="<?php echo $_smarty_tpl->getValue('anno');?>
">
                                        <input type="hidden" name="mese" value="<?php echo $_smarty_tpl->getValue('mese');?>
">
                                        <input type="hidden" name="settimanaInizio" value="<?php echo $_smarty_tpl->getValue('settimanaInizio');?>
">
                                    <?php }?>
                                    <button class="btn btn--danger" type="submit">Cancella</button>
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
