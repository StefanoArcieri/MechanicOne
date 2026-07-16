<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:34:47
  from 'file:gestiscipreventivi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a5b78430f1_80809298',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '303b2ec9628c40a917fb7c2c5783581f561daef1' => 
    array (
      0 => 'gestiscipreventivi.tpl',
      1 => 1784131488,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a5b78430f1_80809298 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16010864766a58a5b77a3b68_20422717', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14281369816a58a5b77b3a55_32275058', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_16010864766a58a5b77a3b68_20422717 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Preventivi da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_14281369816a58a5b77b3a55_32275058 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Preventivi da gestire' ?? null : $tmp);?>
</h1>
            <p>Valuta le richieste dei clienti, fissa il prezzo o segna il lavoro come concluso.</p>
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
                            <h3>Preventivo #<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
</h3>
                            <p class="status-note"><?php echo $_smarty_tpl->getValue('p')['clienteLabel'];?>
 — <?php echo $_smarty_tpl->getValue('p')['veicoloLabel'];?>
</p>
                            <p class="status-note">Servizio: <?php echo $_smarty_tpl->getValue('p')['servizioLabel'];?>
</p>
                            <p><?php echo $_smarty_tpl->getValue('p')['descrizione'];?>
</p>
                            <?php if ($_smarty_tpl->getValue('p')['descrizione_proposta']) {?>
                                <p class="status-note">Modifica proposta dal cliente: <em><?php echo $_smarty_tpl->getValue('p')['descrizione_proposta'];?>
</em></p>
                            <?php }?>

                            <?php if ($_smarty_tpl->getValue('sezione')['classe'] == 'inviato') {?>
                                <form class="form" action="/MechanicOne/gestiscipreventivi/updateCosto/<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" method="post">
                                    <div class="form-field">
                                        <label class="form-label" for="costo-<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
">Prezzo (&euro;)</label>
                                        <input class="form-input" type="number" min="0" step="1" id="costo-<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" name="costo" required>
                                    </div>
                                    <button class="form-submit form-submit--primary" type="submit">Accetta e fissa il prezzo</button>
                                </form>
                                <form action="/MechanicOne/gestiscipreventivi/rifiuta/<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" method="post" onsubmit="return confirm('Rifiutare questa richiesta?');">
                                    <button class="btn btn--danger" type="submit">Rifiuta</button>
                                </form>
                            <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'accettato') {?>
                                <p class="status-note">Prezzo: <strong><?php echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;</strong></p>
                                <form action="/MechanicOne/gestiscipreventivi/segnaSvolto/<?php echo $_smarty_tpl->getValue('p')['idPrev'];?>
" method="post">
                                    <button class="btn btn--success" type="submit">Segna come svolto</button>
                                </form>
                            <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'svolto') {?>
                                <p class="status-note">Prezzo: <strong><?php echo $_smarty_tpl->getValue('p')['costo'];?>
 &euro;</strong></p>
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
