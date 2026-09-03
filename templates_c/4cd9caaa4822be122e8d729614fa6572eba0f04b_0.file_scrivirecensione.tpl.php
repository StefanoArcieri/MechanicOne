<?php
/* Smarty version 5.8.0, created on 2026-09-03 19:32:34
  from 'file:utente/scrivirecensione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99af32116b76_86330088',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd9caaa4822be122e8d729614fa6572eba0f04b' => 
    array (
      0 => 'utente/scrivirecensione.tpl',
      1 => 1788452658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99af32116b76_86330088 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?><section class="review-write" id="recensioni">
    <h2>Lascia una recensione</h2>
    <?php if ($_smarty_tpl->getValue('isLogged')) {?>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('meccaniciApprovati')) == 0) {?>
            <p class="auth-text">Nessun meccanico disponibile per una recensione al momento.</p>
        <?php } else { ?>
            <form class="form" action="/MechanicOne/scrivirecensione/scrivi" method="post">
                <div class="form-field">
                    <label class="form-label" for="idM">Meccanico</label>
                    <select class="form-input" id="idM" name="idM" required>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccaniciApprovati'), 'm');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach0DoElse = false;
?>
                            <option value="<?php echo $_smarty_tpl->getValue('m')['idM'];?>
"><?php echo $_smarty_tpl->getValue('m')['nomeCompleto'];?>
</option>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </select>
                </div>
                <div class="form-field">
                    <label class="form-label" for="voto">Voto</label>
                    <select class="form-input" id="voto" name="voto" required>
                        <option value="5">5 - Eccellente</option>
                        <option value="4">4 - Molto buono</option>
                        <option value="3">3 - Buono</option>
                        <option value="2">2 - Sufficiente</option>
                        <option value="1">1 - Scarso</option>
                    </select>
                </div>
                <div class="form-field form-field--last">
                    <label class="form-label" for="testo">Commento</label>
                    <textarea class="form-input" id="testo" name="testo" rows="3" required></textarea>
                </div>
                <button class="form-submit form-submit--primary" type="submit">Pubblica recensione</button>
            </form>
        <?php }?>
    <?php } else { ?>
        <p class="auth-text"><a class="form-link" href="/MechanicOne/utente/login">Accedi</a> per lasciare una recensione.</p>
    <?php }?>
</section>
<?php }
}
