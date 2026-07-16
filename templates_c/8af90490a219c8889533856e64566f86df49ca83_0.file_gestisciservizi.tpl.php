<?php
/* Smarty version 5.8.0, created on 2026-07-16 11:39:01
  from 'file:gestisciservizi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6a58a6b5d5dd59_11140594',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8af90490a219c8889533856e64566f86df49ca83' => 
    array (
      0 => 'gestisciservizi.tpl',
      1 => 1784130640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6a58a6b5d5dd59_11140594 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_11848463906a58a6b5cfb5c9_51109966', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7289894156a58a6b5d09041_06830107', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_11848463906a58a6b5cfb5c9_51109966 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>
Catalogo servizi - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_7289894156a58a6b5d09041_06830107 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo (($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Catalogo servizi' ?? null : $tmp);?>
</h1>
            <p>I servizi che l'officina offre ai clienti.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo $_smarty_tpl->getValue('errore');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
        <section class="status-section">
            <h2 class="status-section__title">Aggiungi servizio</h2>
            <div class="form-panel" style="width:auto; box-shadow:none; padding:0;">
                <form class="form" action="/MechanicOne/gestisciservizi/aggiungiServizio" method="post">
                    <div class="form-field">
                        <label class="form-label" for="titolo">Titolo</label>
                        <input class="form-input" type="text" id="titolo" name="titolo" required>
                    </div>
                    <div class="form-field form-field--last">
                        <label class="form-label" for="descrizione">Descrizione</label>
                        <textarea class="form-input" id="descrizione" name="descrizione" rows="2"></textarea>
                    </div>
                    <button class="form-submit form-submit--primary" type="submit">Aggiungi al catalogo</button>
                </form>
            </div>
        </section>
    <?php }?>

    <section class="status-section">
        <h2 class="status-section__title">Servizi <span class="status-count"><?php echo $_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi'));?>
</span></h2>
        <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('servizi')) == 0) {?>
            <p class="auth-text">Nessun servizio a catalogo.</p>
        <?php } else { ?>
            <div class="cards">
                <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('servizi'), 's');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('s')->value) {
$foreach0DoElse = false;
?>
                    <article class="card">
                        <h3><?php echo $_smarty_tpl->getValue('s')['titolo'];?>
</h3>
                        <p><?php echo $_smarty_tpl->getValue('s')['descrizione'];?>
</p>
                        <?php if ($_smarty_tpl->getValue('userRole') == 'admin') {?>
                            <form action="/MechanicOne/gestisciservizi/eliminaServizio/<?php echo $_smarty_tpl->getValue('s')['idS'];?>
" method="post" onsubmit="return confirm('Eliminare questo servizio?');">
                                <button class="btn btn--danger" type="submit">Elimina</button>
                            </form>
                        <?php }?>
                    </article>
                <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
            </div>
        <?php }?>
    </section>
</div>
<?php
}
}
/* {/block 'content'} */
}
