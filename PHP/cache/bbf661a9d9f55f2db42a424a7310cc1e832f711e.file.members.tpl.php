<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:56
         compiled from ".\themes\smline\Templates\members.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1731953f7b564c9da40-99180212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbf661a9d9f55f2db42a424a7310cc1e832f711e' => 
    array (
      0 => '.\\themes\\smline\\Templates\\members.tpl',
      1 => 1401214083,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1731953f7b564c9da40-99180212',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'get_users' => 0,
    'order' => 0,
    'web' => 0,
    'u' => 0,
    'user' => 0,
    'array_paises' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b564dc6891_54131083',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b564dc6891_54131083')) {function content_53f7b564dc6891_54131083($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div id="main-col" style="margin-right:5px;">
	<div class="filterBy filterFull clearfix ui-corner-all">
		<div class="floatL xResults">
			Mostrando <strong><?php echo $_smarty_tpl->tpl_vars['get_users']->value['start'];?>
 - <?php if ($_smarty_tpl->tpl_vars['get_users']->value['end']<$_smarty_tpl->tpl_vars['get_users']->value['total']) {?><?php echo $_smarty_tpl->tpl_vars['get_users']->value['end'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['get_users']->value['total'];?>
<?php }?></strong> resultados de <strong><?php echo $_smarty_tpl->tpl_vars['get_users']->value['total'];?>
</strong>	</div>
		<ul class="floatR">
			<li class="orderTxt">Ordenar por</li>
			<li<?php if ($_smarty_tpl->tpl_vars['order']->value=='nombre') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/miembros?order=nombre">Nombre de usuario</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['order']->value=='actividad'||$_smarty_tpl->tpl_vars['order']->value=='') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/miembros?order=actividad">&Uacute;ltima actividad</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['order']->value=='registro') {?> class="here"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/miembros?order=registro">Registro</a></li>
		</ul>
		<div class="clearBoth"></div>
	</div>

	<div id="showResult" class="resultFull mis-comunidades">
		<ul class="clearfix">

		<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_users']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
			<li class="resultBox clearfix">
				<div class="floatL avatarBox">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" class="img-ava<?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['u']->value['u_id'])) {?> online<?php }?>">
						<img class="avatar-2" src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/avatar/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
_120.jpg?<?php echo $_smarty_tpl->tpl_vars['u']->value['u_last_avatar'];?>
" alt="Avatar de <?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
 - <?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['u']->value['u_id'])) {?>Online<?php } else { ?>Offline<?php }?>">
					</a>
				</div>
				<div class="floatL infoBox">
					<h4>
						<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ranks/<?php echo $_smarty_tpl->tpl_vars['u']->value['r_image'];?>
" alt="Imagen del rango" title="<?php echo $_smarty_tpl->tpl_vars['u']->value['r_name'];?>
" class="stip" />
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
					</h4>
					<ul>
						<li>Registro: <strong><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['u']->value['u_date'],"%d/%m/%Y");?>
</strong></li>
						<li>&Uacute;ltima actividad: <strong><?php echo hace($_smarty_tpl->tpl_vars['u']->value['u_last_active']);?>
</strong></li>
						<li>Posts: <strong><?php echo $_smarty_tpl->tpl_vars['u']->value['u_posts'];?>
</strong> - Puntos: <strong><?php echo $_smarty_tpl->tpl_vars['u']->value['u_points'];?>
</strong></li>
						<li>Pa&iacute;s: <strong><?php echo $_smarty_tpl->tpl_vars['array_paises']->value[$_smarty_tpl->tpl_vars['u']->value['u_country']];?>
</strong></li>
					</ul>
				</div>
			</li>
		<?php } ?>
		</ul>
	</div>
<?php echo $_smarty_tpl->tpl_vars['get_users']->value['pages'];?>

</div>

<div id="sidebar">
	<div class="box">
		<div class="box_title">Usuarios recomendados</div>
		<div class="box_body last_members list_element">
		
		<?php if (!$_smarty_tpl->tpl_vars['get_users']->value['recomendados']) {?><div class="emptyData">No hay usuarios recomendados</div><?php }?>
		
		<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_users']->value['recomendados']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
			<div class="list-element">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
">
					<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/avatar/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_id'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['u']->value['u_last_avatar'];?>
" alt="Avatar de <?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" title="Avatar de <?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
" />
				</a>
				<a class="u_nick" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
				
			</div>
		<?php } ?>
			
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
