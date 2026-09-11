<?php
/* Smarty version 5.8.0, created on 2026-09-10 15:34:50
  from 'file:gestione/gestisciprenotazioni_settimane.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2b1fa6b4782_86264936',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c658cf022a457270810ea19e8a2094f558d053d7' => 
    array (
      0 => 'gestione/gestisciprenotazioni_settimane.tpl',
      1 => 1788539995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2b1fa6b4782_86264936 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_18815323656aa2b1fa694068_67955959', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_728372376aa2b1fa6a15d8_16913619', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_18815323656aa2b1fa694068_67955959 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
echo htmlspecialchars((string) ((($tmp = $_smarty_tpl->getValue('titolo') ?? null)===null||$tmp==='' ? 'Prenotazioni' ?? null : $tmp)), ENT_QUOTES, 'UTF-8');?>
 - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_728372376aa2b1fa6a15d8_16913619 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>

<div class="page">
    <header class="hero">
        <div>
            <p class="eyebrow">Officina</p>
            <h1><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('titolo')), ENT_QUOTES, 'UTF-8');?>
</h1>
            <p>Scegli una settimana per vedere le prenotazioni.</p>
        </div>
        <a class="btn btn--ghost" href="/MechanicOne/gestisciprenotazioni/lista">← Tutti i mesi</a>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('settimane')) == 0) {?>
        <p class="auth-text">Nessuna prenotazione in questo mese.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('settimane'), 's', false, 'i');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('i')->value => $_smarty_tpl->getVariable('s')->value) {
$foreach0DoElse = false;
?>
                <a class="card card--link" href="/MechanicOne/gestisciprenotazioni/lista/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('anno')), ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('mese')), ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['inizio']), ENT_QUOTES, 'UTF-8');?>
">
                    <h3>Settimana <?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('i')+1), ENT_QUOTES, 'UTF-8');?>
</h3>
                    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['label']), ENT_QUOTES, 'UTF-8');?>
</p>
                    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('s')['count']), ENT_QUOTES, 'UTF-8');?>
 prenotazion<?php if ($_smarty_tpl->getValue('s')['count'] == 1) {?>e<?php } else { ?>i<?php }?></p>
                </a>
            <?php
}
$_smarty_tpl->getSmarty()->getRuntime('Foreach')->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
</div>
<?php
}
}
/* {/block 'content'} */
}
