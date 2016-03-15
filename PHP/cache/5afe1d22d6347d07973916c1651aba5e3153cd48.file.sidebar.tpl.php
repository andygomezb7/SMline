<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:35
         compiled from ".\themes\smline\Templates\i_profile\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1015353f7b54f0f4502-78500983%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5afe1d22d6347d07973916c1651aba5e3153cd48' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\sidebar.tpl',
      1 => 1396814795,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1015353f7b54f0f4502-78500983',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'u_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54f117788_50334837',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54f117788_50334837')) {function content_53f7b54f117788_50334837($_smarty_tpl) {?><div class="profile_sidebar clearfix">
	<div class="box box_autor">
		<div class="box_title">Estadísticas</div>
		<div class="box_body clearfix no-padding">
			<ul class="list_stats">
				<li class="list_stat left bottom">
					<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_images'];?>
</span>
					<span class="list_name">Imágenes</span>
				</li>
				<li class="list_stat left bottom">
					<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_follows'];?>
</span>
					<span class="list_name">Seguidores</span>
				</li>
				<li class="list_stat left">
					<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_topics'];?>
</span>
					<span class="list_name">Temas</span>
				</li>
			</ul>
			<ul class="list_stats">
				<li class="list_stat bottom">
					<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_posts'];?>
</span>
					<span class="list_name">Posts</span>
				</li>
				<li class="list_stat bottom">
					<span class="list_count" id="autor-total-puntos"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_points'];?>
</span>
					<span class="list_name">Puntos</span>
				</li>
				<li class="list_stat">
					<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_comments'];?>
</span>
					<span class="list_name">Comentarios</span>
				</li>
			</ul>
		</div>
	</div>
	
	<?php echo $_smarty_tpl->getSubTemplate ('i_profile/side_medals.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	
	<?php echo $_smarty_tpl->getSubTemplate ('i_profile/side_followers.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	
</div><?php }} ?>
