<?php
/* Smarty version 5.8.0, created on 2026-09-10 15:34:44
  from 'file:gestione/gestisciprenotazioni_mesi.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.8.0',
  'unifunc' => 'content_6aa2b1f466eae9_21324163',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cce7d4358d676bd77ac812953261cb7c8c91cb1b' => 
    array (
      0 => 'gestione/gestisciprenotazioni_mesi.tpl',
      1 => 1788539995,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6aa2b1f466eae9_21324163 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_3286849636aa2b1f4633f69_61700006', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_4616653786aa2b1f463cd97_02465822', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_3286849636aa2b1f4633f69_61700006 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\MechanicOne\\templates\\gestione';
?>
Prenotazioni da gestire - MechanicOne<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_4616653786aa2b1f463cd97_02465822 extends \Smarty\Runtime\Block
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
            <p>Scegli un mese per vedere le prenotazioni organizzate per settimana.</p>
        </div>
    </header>

    <?php if ($_smarty_tpl->getValue('errore')) {?>
        <div class="form-alert"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('errore')), ENT_QUOTES, 'UTF-8');?>
</div>
    <?php }?>

    <?php if ($_smarty_tpl->getSmarty()->getModifierCallback('count')($_smarty_tpl->getValue('mesi')) == 0) {?>
        <p class="auth-text">Nessuna prenotazione registrata.</p>
    <?php } else { ?>
        <div class="cards">
            <?php
$_from = $_smarty_tpl->getSmarty()->getRuntime('Foreach')->init($_smarty_tpl, $_smarty_tpl->getValue('mesi'), 'm');
$foreach0DoElse = true;
foreach ($_from ?? [] as $_smarty_tpl->getVariable('m')->value) {
$foreach0DoElse = false;
?>
                <a class="card card--link" href="/MechanicOne/gestisciprenotazioni/lista/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['anno']), ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['mese']), ENT_QUOTES, 'UTF-8');?>
">
                    <h3><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['label']), ENT_QUOTES, 'UTF-8');?>
</h3>
                    <p class="status-note"><?php echo htmlspecialchars((string) ($_smarty_tpl->getValue('m')['count']), ENT_QUOTES, 'UTF-8');?>
 prenotazion<?php if ($_smarty_tpl->getValue('m')['count'] == 1) {?>e<?php } else { ?>i<?php }?></p>
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
