<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\includes\sub-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2302353f7af4e555d10-66586246%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '453ba04cdaee04e0667658f8e912454379cff677' => 
    array (
      0 => '.\\themes\\smline\\Templates\\includes\\sub-menu.tpl',
      1 => 1398885196,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2302353f7af4e555d10-66586246',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'sm_page' => 0,
    'do' => 0,
    'web' => 0,
    'user' => 0,
    'c_action' => 0,
    'f_action' => 0,
    't_action' => 0,
    's_data' => 0,
    'page' => 0,
    'act' => 0,
    'comus_cats' => 0,
    'c' => 0,
    'cinfo' => 0,
    'cats' => 0,
    'u_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e6923d2_21993313',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e6923d2_21993313')) {function content_53f7af4e6923d2_21993313($_smarty_tpl) {?><div id="wrapper">
	<div id="menu_2">
		<div class="floatL">
		<?php if ($_smarty_tpl->tpl_vars['sm_page']->value=='images'||$_smarty_tpl->tpl_vars['sm_page']->value=='image') {?>
			<li<?php if (!$_smarty_tpl->tpl_vars['do']->value) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes">Inicio</a></li>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
			<li<?php if ($_smarty_tpl->tpl_vars['do']->value=='agregar') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes/agregar"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/add.png" /> Agregar imagen</a></li>
			<?php }?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/imagenes/historial">Historial</a></li>
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='communities') {?>
			<li<?php if (!$_smarty_tpl->tpl_vars['c_action']->value) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades">Inicio</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['c_action']->value=='mis-comunidades') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/mis-comunidades">Mis comunidades</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['c_action']->value=='historial') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/historial">Historial</a></li>
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='favorites') {?>
			<li<?php if ($_smarty_tpl->tpl_vars['f_action']->value==''||$_smarty_tpl->tpl_vars['f_action']->value=='posts') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/favoritos">Posts</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['f_action']->value=='imagenes') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/favoritos/imagenes">Imágenes</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['f_action']->value=='temas') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/favoritos/temas">Temas</a></li>
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='tops') {?>
			<li<?php if (!$_smarty_tpl->tpl_vars['t_action']->value) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops">Posts</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['t_action']->value=='usuarios') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops/usuarios">Usuarios</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['t_action']->value=='comunidades') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops/comunidades">Comunidades</a></li>
			
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='search') {?>
			<li<?php if (!$_smarty_tpl->tpl_vars['s_data']->value['type']) {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
">Buscar en posts</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['s_data']->value['type']=='temas') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
&type=temas">Buscar en temas</a></li>
		<?php } else { ?>
			<li<?php if ($_smarty_tpl->tpl_vars['page']->value['css']=='home') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/">Inicio</a></li>
			<li<?php if ($_smarty_tpl->tpl_vars['sm_page']->value=='profile'||$_smarty_tpl->tpl_vars['sm_page']->value=='members') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/miembros">Miembros</a></li>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?><li<?php if ($_smarty_tpl->tpl_vars['act']->value=='agregar-post') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/agregar-post"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/add.png" /> Agregar post</a></li><?php }?>
			<li<?php if ($_smarty_tpl->tpl_vars['sm_page']->value=='mod-history') {?> class="active"<?php }?>><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/historial">Historial</a></li>
		<?php }?>
		</div>
		<?php if ($_smarty_tpl->tpl_vars['sm_page']->value=='communities'&&$_smarty_tpl->tpl_vars['page']->value['css']=='home') {?>
		<div class="floatR">
			<select class="inp_text" onchange="location.href=$(this).val();">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="/comunidades">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comus_cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				<option value="/comunidades/home/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_seo'];?>
" <?php if ($_smarty_tpl->tpl_vars['c']->value['c_id']==$_smarty_tpl->tpl_vars['cinfo']->value['c_id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>
				<?php } ?>
			</select>
		</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='home'||$_smarty_tpl->tpl_vars['sm_page']->value=='home_portadas') {?>
		<div class="floatR">
			<select class="inp_text" onchange="location.href=$(this).val();">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="/">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				<option value="/posts/<?php echo $_smarty_tpl->tpl_vars['c']->value['c_seo'];?>
" <?php if ($_smarty_tpl->tpl_vars['c']->value['c_id']==$_smarty_tpl->tpl_vars['cinfo']->value['c_id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>
				<?php } ?>
			</select>
		</div>
		<?php } elseif ($_smarty_tpl->tpl_vars['sm_page']->value=='profile') {?>
		<div class="floatR">
			<?php if ($_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->uid!=$_smarty_tpl->tpl_vars['u_info']->value['u_id']) {?>
				<?php if ($_smarty_tpl->tpl_vars['u_info']->value['is_block']) {?>
					<li><a onclick="user.set_unblock(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
');" id="b-block-<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
">Desbloquear</a></li>
				<?php } else { ?>
					<li><a onclick="user.set_block(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
');" id="b-block-<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
">Bloquear</a></li>
				<?php }?>
			<?php }?>
		</div>
		<?php }?>
	</div>
</div>
<?php }} ?>
