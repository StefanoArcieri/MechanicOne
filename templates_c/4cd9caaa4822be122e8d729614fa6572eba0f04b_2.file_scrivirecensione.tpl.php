<?php
/* Smarty version 5.8.0, created on 2026-09-09 19:35:14
  from 'file:utente/scrivirecensione.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa198d2077595_75161795',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd9caaa4822be122e8d729614fa6572eba0f04b' => 
    array (
      0 => 'utente/scrivirecensione.tpl',
      1 => 1788975308,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa198d2077595_75161795 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?><section class="review-write" id="recensioni">
    <h2>Lascia una recensione</h2>
    <?php if ($_smarty_tpl->getValue('isLogged')) {?>
        <form class="form" action="/MechanicOne/recensione/scrivi" method="post">
                        <div class="form-field">
                <label class="form-label" for="idM">Meccanico</label>
                <select class="form-input" id="idM" name="idM">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('meccanici'), 'm');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach0DoElse = false;
?>
                        <option value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['idM']), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['nomeCompleto']), ENT_QUOTES, 'UTF-8');?>
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
                <label class="form-label" for="commento">Commento</label>
                <textarea class="form-input" id="commento" name="commento" rows="3" required></textarea>
            </div>
            <button class="form-submit form-submit--primary" type="submit">Pubblica recensione</button>
        </form>
    <?php } else { ?>
        <p class="auth-text"><a class="form-link" href="/MechanicOne/utente/login">Accedi</a> per lasciare una recensione.</p>
    <?php }?>
</section>
<?php }
}
