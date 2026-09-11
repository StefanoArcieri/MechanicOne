<?php
/* Smarty version 5.8.0, created on 2026-09-11 16:25:41
  from 'file:meccanico/gestisciprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa40f6524fa53_75765833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '834d0145fb00488da9c2670eab51c93bda8a436b' => 
    array (
      0 => 'meccanico/gestisciprenotazioni.tpl',
      1 => 1789136397,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa40f6524fa53_75765833 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_14317989956aa40f65217535_07889047', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_7025921936aa40f6521b005_66101475', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_14317989956aa40f65217535_07889047 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
?>
Area Prenotazioni - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_7025921936aa40f6521b005_66101475 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\meccanico';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1>Area Prenotazioni</h1>
            <p>Visualizza e gestisci le tue prenotazioni. </p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mesi')) == 0) {?>
        <p class="auth-text">Nessuna prenotazione registrata.</p>
    <?php } else { ?>
        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mesi'), 'mese');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('mese')->value) {
$foreach0DoElse = false;
?>
            <section class="status-section">
                <h2 class="status-section__title"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('mese')['label']), ENT_QUOTES, 'UTF-8');?>
 <span class="status-count"><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['attive'])), ENT_QUOTES, 'UTF-8');?>
</span></h2>

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['attive']) == 0) {?>
                    <p class="auth-text">Nessuna prenotazione in attesa o confermata in questo mese.</p>
                <?php } else { ?>
                    <div class="cards">
                        <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mese')['attive'], 'p');
$foreach1DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach1DoElse = false;
?>
                            <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('p')['stato'],' ','-')), ENT_QUOTES, 'UTF-8');?>
" id="prenotazione-<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
">
                                <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
                                <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>

                                <?php if ($_smarty_tpl->getValue('p')['stato'] == 'in attesa') {?>
                                    <form action="/MechanicOne/gestisciprenotazioni/accetta/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <button class="btn btn--success" type="submit">Conferma</button>
                                    </form>
                                <?php } elseif ($_smarty_tpl->getValue('p')['stato'] == 'accettata') {?>
                                    <p class="status-note">Meccanico assegnato: <?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('p')['meccanicoLabel'] ?? null)===null||$tmp==='' ? 'nessuno' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <form action="/MechanicOne/gestisciprenotazioni/concludi/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
" method="post">
                                        <button class="btn btn--success" type="submit">Segna come conclusa</button>
                                    </form>
                                <?php }?>
                            </article>
                        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['archiviate']) > 0) {?>
                    <details class="inline-edit">
                        <summary class="btn btn--secondary">Concluse e cancellate (<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mese')['archiviate'])), ENT_QUOTES, 'UTF-8');?>
)</summary>
                        <div class="cards">
                            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mese')['archiviate'], 'p');
$foreach2DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('p')->value) {
$foreach2DoElse = false;
?>
                                <article class="card status-card status-card--<?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('replace')($_smarty_tpl->getValue('p')['stato'],' ','-')), ENT_QUOTES, 'UTF-8');?>
">
                                    <h3>Prenotazione #<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['idPren']), ENT_QUOTES, 'UTF-8');?>
</h3>
                                    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['clienteLabel']), ENT_QUOTES, 'UTF-8');?>
 — <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['veicoloLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <p><?php echo htmlspecialchars((string) ($_smarty_tpl->getSmarty()->getModifierCallback('date_format')($_smarty_tpl->getValue('p')['data'],"%d/%m/%Y")), ENT_QUOTES, 'UTF-8');?>
 alle <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['ora']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <?php if ($_smarty_tpl->getValue('p')['meccanicoLabel']) {?>
                                        <p class="status-note">Meccanico assegnato: <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('p')['meccanicoLabel']), ENT_QUOTES, 'UTF-8');?>
</p>
                                    <?php }?>
                                </article>
                            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
                        </div>
                    </details>
                <?php }?>
            </section>
        <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
