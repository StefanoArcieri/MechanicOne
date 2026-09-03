<?php
/* Smarty version 5.8.0, created on 2026-09-03 19:32:34
  from 'file:utente/visualizzarecensioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a99af322eb435_71434271',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c34292e7363a9776cc059038e2445463af45f42d' => 
    array (
      0 => 'utente/visualizzarecensioni.tpl',
      1 => 1788452658,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a99af322eb435_71434271 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?><section class="review-list">
    <h2>Cosa dicono i nostri clienti</h2>

    <div class="rating-summary">
        <span class="rating-summary__value"><?php echo $_smarty_tpl->getValue('mediaStelle');?>
</span>
        <span class="stars"><?php echo $_smarty_tpl->getValue('stelleMedia');?>
</span>
        <span class="status-note">(<?php echo $_smarty_tpl->getValue('numeroRecensioni');?>
 recensioni)</span>
    </div>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('recensioni')) == 0) {?>
        <p class="auth-text">Nessuna recensione pubblicata finora.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('recensioni'), 'r');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('r')->value) {
$foreach1DoElse = false;
?>
                <article class="review-card">
                    <div class="review-card__meta">
                        <span><?php echo $_smarty_tpl->getValue('r')['nomeMeccanico'];?>
</span>
                        <span><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('r')['data_recensione'],"%d/%m/%Y");?>
</span>
                    </div>
                    <div class="stars"><?php echo $_smarty_tpl->getValue('r')['stelleVoto'];?>
</div>
                    <p><?php echo $_smarty_tpl->getValue('r')['commento'];?>
</p>
                    <p class="status-note">— <?php echo $_smarty_tpl->getValue('r')['nomeAutore'];?>
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
