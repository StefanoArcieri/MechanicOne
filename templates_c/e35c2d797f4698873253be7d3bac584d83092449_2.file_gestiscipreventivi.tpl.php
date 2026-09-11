<?php
/* Smarty version 5.8.0, created on 2026-09-10 16:29:38
  from 'file:admin/gestiscipreventivi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2bed22a5b19_37582438',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e35c2d797f4698873253be7d3bac584d83092449' => 
    array (
      0 => 'admin/gestiscipreventivi.tpl',
      1 => 1789050575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2bed22a5b19_37582438 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_10437946686aa2bed2265485_00764779', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1240974726aa2bed226afb3_64088515', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_10437946686aa2bed2265485_00764779 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>
Preventivi da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_1240974726aa2bed226afb3_64088515 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\admin';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Area Preventivi</h1>
            <p>Valuta le richieste dei clienti e fissa il prezzo: il resto è automatico.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <div class="kanban">
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezioni'), 'sezione');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('sezione')->value) {
$foreach0DoElse = false;
?>
            <div class="kanban-column">
                <div class="kanban-column__header kanban-column__header--<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['classe']), ENT_QUOTES, 'UTF-8');?>
">
                    <h2 class="kanban-column__title"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['label']), ENT_QUOTES, 'UTF-8');?>
</h2>
                    <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items'])), ENT_QUOTES, 'UTF-8');?>
</span>
                </div>

                <div class="kanban-column__body">
                    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items']) == 0) {?>
                        <p class="auth-text"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['vuoto']), ENT_QUOTES, 'UTF-8');?>
</p>
                    <?php } else { ?>
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('sezione')['items'], 'p', false, NULL, 'item', array (
  'iteration' => true,
  'last' => true,
  'total' => true,
));
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_item']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_item']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_item']->value['iteration'] === $_smarty_tpl->tpl_vars['__smarty_foreach_item']->value['total'];
?>
                            <?php if (($_smarty_tpl->getValue('__smarty_foreach_item')['iteration'] ?? null) == 4) {?>
                                <details class="kanban-more">
                                    <summary class="kanban-more__toggle">Mostra altri <?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('sezione')['items'])-3), ENT_QUOTES, 'UTF-8');?>
</summary>
                                    <div class="kanban-more__body">
                            <?php }?>
                            <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('sezione')['classe']), ENT_QUOTES, 'UTF-8');?>
">
                                <h3>Preventivo #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
</h3>
                                <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                <p class="status-note">Servizio: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['servizioLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione']), ENT_QUOTES, 'UTF-8');?>
</p>
                                <?php if ($_smarty_tpl->getValue('p')['pdf'] && ($_smarty_tpl->getValue('p')['stato'] == 'accettato' || $_smarty_tpl->getValue('p')['stato'] == 'svolto')) {?>
                                    <p><a class="form-link" href="/MechanicOne/gestiscipreventivi/scaricaPdf/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
">📄 Scarica PDF</a></p>
                                <?php }?>
                                <?php if ($_smarty_tpl->getValue('p')['descrizione_proposta']) {?>
                                    <p class="status-note">Modifica proposta dal cliente: <em><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['descrizione_proposta']), ENT_QUOTES, 'UTF-8');?>
</em></p>
                                <?php }?>

                                <?php if ($_smarty_tpl->getValue('sezione')['classe'] == 'inviato') {?>
                                    <form class="form" action="/MechanicOne/gestiscipreventivi/updateCosto/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <div class="form-field">
                                            <label class="form-label" for="costo-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
">Prezzo (&euro;)</label>
                                            <input class="form-input" type="number" min="0" step="1" id="costo-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" name="costo" required>
                                        </div>
                                        <button class="form-submit form-submit--primary" type="submit">Accetta e fissa il prezzo</button>
                                    </form>
                                    <form action="/MechanicOne/gestiscipreventivi/rifiuta/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Rifiutare questa richiesta?');">
                                        <button class="btn btn--danger" type="submit">Rifiuta</button>
                                    </form>
                                <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'accettato') {?>
                                    <p class="status-note">Prezzo: <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['costo']), ENT_QUOTES, 'UTF-8');?>
 &euro;</strong></p>
                                    <p class="status-note">In attesa che il cliente prenoti e un meccanico prenda in carico l'intervento: a quel punto risulterà svolto in automatico.</p>
                                <?php } elseif ($_smarty_tpl->getValue('sezione')['classe'] == 'svolto') {?>
                                    <p class="status-note">Prezzo: <strong><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['costo']), ENT_QUOTES, 'UTF-8');?>
 &euro;</strong></p>
                                <?php }?>

                                <form action="/MechanicOne/gestiscipreventivi/elimina/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPrev']), ENT_QUOTES, 'UTF-8');?>
" method="post" onsubmit="return confirm('Eliminare definitivamente questo preventivo? Se ha già una prenotazione collegata, verrà eliminata anche quella. L\'azione non è reversibile.');">
                                    <button class="btn btn--danger" type="submit">Elimina</button>
                                </form>
                            </article>
                            <?php if (($_smarty_tpl->getValue('__smarty_foreach_item')['last'] ?? null) && ($_smarty_tpl->getValue('__smarty_foreach_item')['iteration'] ?? null) > 3) {?>
                                    </div>
                                </details>
                            <?php }?>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    <?php }?>
                </div>
            </div>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    </div>
</div>
<?php
}
}
/* {/block 'content'} */
}
