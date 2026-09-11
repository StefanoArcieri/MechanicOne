<?php
/* Smarty version 5.8.0, created on 2026-09-11 13:21:48
  from 'file:utente/visualizzaprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa3e44ccbeca3_76295690',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f7bbe4b5ed8f71c5b58c7095560ee1e207e8f46c' => 
    array (
      0 => 'utente/visualizzaprenotazioni.tpl',
      1 => 1789125104,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa3e44ccbeca3_76295690 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_16186550006aa3e44cc9cec0_03288092', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_2328022786aa3e44cca1d81_30823309', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_16186550006aa3e44cc9cec0_03288092 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>
Le tue prenotazioni - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_2328022786aa3e44cca1d81_30823309 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\utente';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Prenotazioni</p>
            <h1>Le tue prenotazioni</h1>
            <p>Controlla i tuoi appuntamenti e modificali finché non vengono confermati.</p>
        </div>
        <a class="button" href="/MechanicOne/richiediprenotazione/nuovo">+ Richiedi prenotazione</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezioni'), 'sezione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('sezione')->value) {
$foreach0DoElse = false;
?>
        <section class="status-section">
            <h2 class="status-section__title"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['label']), ENT_QUOTES, 'UTF-8');?>
 <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items'])), ENT_QUOTES, 'UTF-8');?>
</span></h2>
            <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items']) == 0) {?>
                <p class="auth-text"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['vuoto']), ENT_QUOTES, 'UTF-8');?>
</p>
            <?php } else { ?>
                <div class="cards">
                    <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezione')['items'], 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                        <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['classe']), ENT_QUOTES, 'UTF-8');?>
">
                            <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
                            <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>
                            <?php if ($_smarty_tpl->getValue('sezione')['modificabile']) {?>
                                <details class="edit-toggle">
                                    <summary>Modifica data/ora</summary>
                                    <form class="form" action="/MechanicOne/visualizzaprenotazioni/modifica/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <div class="form-field">
                                            <input class="form-input" type="date" name="nuovaData" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['data']), ENT_QUOTES, 'UTF-8');?>
" min="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('oggi')), ENT_QUOTES, 'UTF-8');?>
" required>
                                        </div>
                                        <div class="form-field form-field--last">
                                            <input class="form-input" type="time" name="nuovaOra" value="<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
" required>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Modifica</button>
                                    </form>
                                </details>
                            <?php }?>
                            <?php if ($_smarty_tpl->getValue('sezione')['cancellabile']) {?>
                                <form action="/MechanicOne/visualizzaprenotazioni/annullaPrenotazione/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Annullare questa prenotazione?');">
                                    <button class="btn btn--danger" type="submit">Annulla prenotazione</button>
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
