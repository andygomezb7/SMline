<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\top_users.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2022553f7af4e886453-15200305%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '40360f44df441c6e0aaeb8928a25435a0279d61b' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\top_users.tpl',
      1 => 1398819377,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2022553f7af4e886453-15200305',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'top_users' => 0,
    'i' => 0,
    'web' => 0,
    'u' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e8a5858_61418243',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e8a5858_61418243')) {function content_53f7af4e8a5858_61418243($_smarty_tpl) {?><div class="box margin-top-5">
	<div class="box_title">Top usuarios</div>
	<div class="box_filter filter_users clearfix">
		<a onclick="tops_filter('users', 1, 'ho')" class="f_p_ho">Hoy</a>
		<a onclick="tops_filter('users', 2, 'ay')" class="f_p_ay">Ayer</a>
		<a onclick="tops_filter('users', 3, 'se')" class="f_p_se">Semana</a>
		<a onclick="tops_filter('users', 4, 'me')" class="f_p_me">Mes</a>
		<a onclick="tops_filter('users', 5, 'hi')" class="f_p_hi active">Histórico</a>
	</div>
	<div class="box_body top_users list_element">
		<?php if (!$_smarty_tpl->tpl_vars['top_users']->value) {?><div class="emptyData">No hay usuarios en este rango de tiempo</div><?php }?>
		<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_users']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['u']->key;
?>
		<div class="list-element">
			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
			<span class="value"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_points'];?>
</span>
		</div>
		<?php } ?>
		<div class="box_more">
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops/users">Ver más</a>
		</div>
	</div>
</div><?php }} ?>
