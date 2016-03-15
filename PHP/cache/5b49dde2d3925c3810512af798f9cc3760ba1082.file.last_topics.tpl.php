<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\last_topics.tpl" */ ?>
<?php /*%%SmartyHeaderCode:919653f8c031885db9-32907825%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5b49dde2d3925c3810512af798f9cc3760ba1082' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\last_topics.tpl',
      1 => 1398819465,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '919653f8c031885db9-32907825',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'last_topics' => 0,
    't' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c03191e355_35290270',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c03191e355_35290270')) {function content_53f8c03191e355_35290270($_smarty_tpl) {?><div class="box">
	<div class="box_title">Temas recientes</div>
	<div class="box_body last_topics" style="position: relative;">

		<?php if (!$_smarty_tpl->tpl_vars['last_topics']->value['list']) {?><div class="emptyData">No hay temas con los filtros seleccionados</div><?php }?>
		<?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['last_topics']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
		<div class="list-element">
			<i class="etip icon" title="<?php echo $_smarty_tpl->tpl_vars['t']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/comus-cats/<?php echo $_smarty_tpl->tpl_vars['t']->value['c_img'];?>
) no-repeat;"></i>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['t']->value['comu_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['t']->value['t_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['t']->value['t_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['t']->value['t_title'];?>
" <?php if ($_smarty_tpl->tpl_vars['t']->value['t_status']==0||$_smarty_tpl->tpl_vars['t']->value['comu_status']==0) {?>style="font-weight: normal;color:red"<?php }?>><?php echo $_smarty_tpl->tpl_vars['t']->value['t_title'];?>
</a>
			<?php if ($_smarty_tpl->tpl_vars['t']->value['t_status']==0) {?>
			<a class="stip floatR" title="Este tema se encuentra eliminado">
				<i class="icon info nm"></i>
			</a>
			<?php } elseif ($_smarty_tpl->tpl_vars['t']->value['comu_status']==0) {?>
			<a class="stip floatR" title="La comunidad se encuentra suspendida">
				<i class="icon info nm"></i>
			</a>
			<?php }?>
			<p>En <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['t']->value['comu_seo'];?>
/"><?php echo $_smarty_tpl->tpl_vars['t']->value['comu_name'];?>
</a> por <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['t']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value['u_nick'];?>
</a></p>
		</div>
		<?php } ?>
		<?php echo $_smarty_tpl->tpl_vars['last_topics']->value['pages'];?>

	</div>
</div><?php }} ?>
