<?php
/* Smarty version 5.8.0, created on 2026-09-11 12:47:49
  from 'file:admin/gestisciprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa3dc55d3dae4_91302218',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ea6eebc1ba346c1022abe54b69f0831b00e145d3' => 
    array (
      0 => 'admin/gestisciprenotazioni.tpl',
      1 => 1789123631,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa3dc55d3dae4_91302218 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7793691516aa3dc55cf2716_46791031', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_12778444106aa3dc55cf68a8_36320260', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_7793691516aa3dc55cf2716_46791031 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>
Area Prenotazioni - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_12778444106aa3dc55cf68a8_36320260 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Area Prenotazioni</h1>
            <p>Visualizza e gestisci le tue prenotazioni. </p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mesi')) == 0) {?>
        <p class="auth-text">Nessuna prenotazione registrata.</p>
    <?php } else { ?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mesi'), 'mese');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('mese')->value) {
$foreach0DoElse = false;
?>
            <section class="status-section">
                <h2 class="status-section__title"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('mese')['label']), ENT_QUOTES, 'UTF-8');?>
 <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['attive'])), ENT_QUOTES, 'UTF-8');?>
</span></h2>

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['attive']) == 0) {?>
                    <p class="auth-text">Nessuna prenotazione in attesa o confermata in questo mese.</p>
                <?php } else { ?>
                    <div class="cards">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mese')['attive'], 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                            <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('p')['stato'],' ','-')), ENT_QUOTES, 'UTF-8');?>
" id="prenotazione-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">
                                <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
                                <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>

                                <?php if ($_smarty_tpl->getValue('p')['stato'] == 'in attesa') {?>
                                    <details class="inline-edit">
                                        <summary class="btn btn--success">Conferma</summary>
                                        <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/accetta/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                            <div class="form-field form-field--last">
                                                <label class="form-label" for="idM-accetta-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Assegna meccanico</label>
                                                <select class="form-input" id="idM-accetta-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="idM" required>
                                                    <option value="" disabled selected>— Scegli un meccanico —</option>
                                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach2DoElse = false;
?>
                                                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['idM']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['cognome']), ENT_QUOTES, 'UTF-8');?>
</option>
                                                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                                </select>
                                            </div>
                                            <button class="form-submit form-submit--primary" type="submit">Conferma</button>
                                        </form>
                                    </details>
                                <?php }?>
                                    <details class="inline-edit">
                                        <summary class="btn btn--secondary">Modifica</summary>
                                        <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/modifica/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                            <div class="form-field">
                                                <label class="form-label" for="data-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Data</label>
                                                <input class="form-input" type="date" id="data-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="data" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%Y-%m-%d")), ENT_QUOTES, 'UTF-8');?>
">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-label" for="ora-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Ora</label>
                                                <input class="form-input" type="time" id="ora-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="ora" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['ora'],"%H:%M")), ENT_QUOTES, 'UTF-8');?>
">
                                            </div>
                                            <div class="form-field form-field--last">
                                                <label class="form-label" for="idM-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Meccanico assegnato</label>
                                                <select class="form-input" id="idM-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="idM">
                                                    <option value=""<?php if (!$_smarty_tpl->getValue('p')['idM']) {?> selected<?php }?>>— Nessuno —</option>
                                                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach3DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach3DoElse = false;
?>
                                                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['idM']), ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->getValue('p')['idM'] == $_smarty_tpl->getValue('m')['idM']) {?> selected<?php }?>><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['nome']), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['cognome']), ENT_QUOTES, 'UTF-8');?>
</option>
                                                    <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                                                </select>
                                            </div>
                                            <button class="form-submit form-submit--primary" type="submit">Salva modifiche</button>
                                        </form>
                                    </details>
                                    <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                        <button class="btn btn--danger" type="submit">Cancella</button>
                                    </form>
                            </article>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['archiviate']) > 0) {?>
                    <details class="inline-edit">
                        <summary class="btn btn--secondary">Concluse e cancellate (<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['archiviate'])), ENT_QUOTES, 'UTF-8');?>
)</summary>
                        <div class="cards">
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mese')['archiviate'], 'p');
$foreach4DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach4DoElse = false;
?>
                                <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('p')['stato'],' ','-')), ENT_QUOTES, 'UTF-8');?>
">
                                    <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
                                    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <?php if ($_smarty_tpl->getValue('p')['meccanicoLabel']) {?>
                                        <p class="status-note">Meccanico assegnato: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['meccanicoLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <?php }?>
                                    <form action="/MechanicOne/gestisciprenotazioni/elimina/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                        <button class="btn btn--danger" type="submit">Elimina</button>
                                    </form>
                                </article>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </div>
                    </details>
                <?php }?>
            </section>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
