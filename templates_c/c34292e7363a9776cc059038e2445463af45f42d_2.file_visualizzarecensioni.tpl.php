<?php
/* Smarty version 5.8.0, created on 2026-09-09 19:37:53
  from 'file:utente/visualizzarecensioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa199712bf6b6_83706462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c34292e7363a9776cc059038e2445463af45f42d' => 
    array (
      0 => 'utente/visualizzarecensioni.tpl',
      1 => 1788975472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa199712bf6b6_83706462 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?><section class="review-list">
    <h2>Cosa dicono i nostri clienti</h2>

    <div class="rating-summary">
        <span class="rating-summary__value"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('mediaStelle')), ENT_QUOTES, 'UTF-8');?>
</span>
        <span class="stars"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('stelleMedia')), ENT_QUOTES, 'UTF-8');?>
</span>
        <span class="status-note">(<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('numeroRecensioni')), ENT_QUOTES, 'UTF-8');?>
 recensioni)</span>
    </div>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('recensioni')) == 0) {?>
        <p class="auth-text">Nessuna recensione pubblicata finora.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recensioni'), 'r');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('r')->value) {
$foreach0DoElse = false;
?>
                <article class="review-card" id="recensione-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('r')['idR']), ENT_QUOTES, 'UTF-8');?>
">
                    <div class="review-card__meta">
                        <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('r')['nomeMeccanico']), ENT_QUOTES, 'UTF-8');?>
 <span class="stars stars--inline"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('r')['stelleVoto']), ENT_QUOTES, 'UTF-8');?>
</span></span>
                        <span><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('r')['data_recensione'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
</span>
                    </div>
                    <p class="review-card__commento"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('r')['commento']), ENT_QUOTES, 'UTF-8');?>
</p>
                    <p class="status-note">— <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('r')['nomeAutore']), ENT_QUOTES, 'UTF-8');?>
</p>
                </article>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</section>
<?php }
}
