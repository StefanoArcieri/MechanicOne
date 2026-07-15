<?php
/* Smarty version 5.8.0, created on 2026-07-14 13:58:26
  from 'file:visualizzarecensioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a562462624ba9_25596629',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97c357c354212e5d7d7edc468d73be668b61b421' => 
    array (
      0 => 'visualizzarecensioni.tpl',
      1 => 1784023846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a562462624ba9_25596629 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
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
