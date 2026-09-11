<?php
/* Smarty version 5.8.0, created on 2026-09-10 17:56:53
  from 'file:gestione/gestisciprenotazioni.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2d345ae2d43_53486180',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0568d73567588a124530523ef3bf68f4187f7f2d' => 
    array (
      0 => 'gestione/gestisciprenotazioni.tpl',
      1 => 1789055716,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:gestione/_card_prenotazione.tpl' => 2,
  ),
))) {
function content_6aa2d345ae2d43_53486180 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_19740181826aa2d345aa2527_99779696', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18898562966aa2d345aaa775_41562864', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_19740181826aa2d345aa2527_99779696 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>
Prenotazioni da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_18898562966aa2d345aaa775_41562864 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazioni da gestire' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
</h1>
            <p>Conferma gli appuntamenti in attesa; sarà il meccanico a segnare quelli conclusi.</p>
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
                            <?php $_smarty_tpl->renderSubTemplate('file:gestione/_card_prenotazione.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('p'=>$_smarty_tpl->getValue('p'),'archiviata'=>false), (int) 0, $_smarty_current_dir);
?>
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
                                <?php $_smarty_tpl->renderSubTemplate('file:gestione/_card_prenotazione.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('p'=>$_smarty_tpl->getValue('p'),'archiviata'=>true), (int) 0, $_smarty_current_dir);
?>
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
