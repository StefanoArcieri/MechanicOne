<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:36:45
  from 'file:gestisciprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a62dbb6a37_33829799',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '10fb615a959fd65b2a86a4ab812a7936edafc29a' => 
    array (
      0 => 'gestisciprenotazioni.tpl',
      1 => 1784131741,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a62dbb6a37_33829799 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_8967190616a58a62daf6825_18491916', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3455072026a58a62db09e17_28603173', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_8967190616a58a62daf6825_18491916 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Prenotazioni da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_3455072026a58a62db09e17_28603173 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazioni da gestire' ?? null : $tmp);?>
</h1>
            <p>Conferma gli appuntamenti in attesa e segna quelli conclusi.</p>
        </div>
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

                            <?php if ($_smarty_tpl->getValue('sezione')['classe'] == 'in-attesa') {?>
                                <form action="/MechanicOne/gestisciprenotazioni/accetta/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                    <button class="btn btn--success" type="submit">Conferma</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Cancella</button>
                                </form>
                            <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'accettata') {?>
                                <form action="/MechanicOne/gestisciprenotazioni/concludi/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post">
                                    <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                </form>
                                <form action="/MechanicOne/gestisciprenotazioni/cancella/<?php echo $_smarty_tpl->getValue('p')['idPren'];?>
" method="post" onsubmit="return confirm('Cancellare questa prenotazione?');">
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
