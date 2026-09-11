<?php
/* Smarty version 5.8.0, created on 2026-09-10 17:56:53
  from 'file:gestione/_card_prenotazione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2d345b4e083_63037161',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83fc8936cf9e7de4a0adcd036439cce42f5dab67' => 
    array (
      0 => 'gestione/_card_prenotazione.tpl',
      1 => 1789055699,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2d345b4e083_63037161 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?><article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('p')['stato'],' ','-')), ENT_QUOTES, 'UTF-8');?>
">
    <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
    <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>
    <?php if ($_smarty_tpl->getValue('p')['data_proposta']) {?>
        <p class="status-note">Modifica proposta dal cliente: <em><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data_proposta'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora_proposta']), ENT_QUOTES, 'UTF-8');?>
</em></p>
    <?php }?>
    <?php if ($_smarty_tpl->getValue('p')['meccanicoLabel']) {?>
        <p class="status-note">Meccanico assegnato: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['meccanicoLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
    <?php }?>

    <?php if (!$_smarty_tpl->getValue('archiviata')) {?>
        <?php if ($_smarty_tpl->getValue('userRole') == 'admin' && ($_smarty_tpl->getValue('p')['stato'] == 'in attesa' || $_smarty_tpl->getValue('p')['stato'] == 'accettata')) {?>
            <details class="inline-edit">
                <summary class="btn btn--secondary">Modifica</summary>
                <form class="form inline-edit__form" action="/MechanicOne/gestisciprenotazioni/modifica/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                    <div class="form-field">
                        <label class="form-label" for="data-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Data</label>
                        <input class="form-input" type="date" id="data-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="data" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%Y-%m-%d")), ENT_QUOTES, 'UTF-8');?>
" required>
                    </div>
                    <div class="form-field">
                        <label class="form-label" for="ora-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">Ora</label>
                        <input class="form-input" type="time" id="ora-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" name="ora" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['ora'],"%H:%M")), ENT_QUOTES, 'UTF-8');?>
" required>
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
        <?php }?>

        <?php if ($_smarty_tpl->getValue('p')['stato'] == 'in attesa') {?>
            <form action="/MechanicOne/gestisciprenotazioni/accetta/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                <button class="btn btn--success" type="submit">Conferma</button>
            </form>
            <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                <button class="btn btn--danger" type="submit">Cancella</button>
            </form>
        <?php } elseif ($_smarty_tpl->getValue('p')['stato'] == 'accettata') {?>
            <?php if ($_smarty_tpl->getValue('userRole') == 'meccanico') {?>
                <form action="/MechanicOne/gestisciprenotazioni/concludi/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                    <button class="btn btn--success" type="submit">Segna come conclusa</button>
                </form>
            <?php } else { ?>
                <p class="status-note">In lavorazione: sarà il meccanico a segnarla come conclusa a fine intervento.</p>
            <?php }?>
            <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                <button class="btn btn--danger" type="submit">Cancella</button>
            </form>
        <?php }?>
    <?php }?>
</article>
<?php }
}
