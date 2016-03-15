<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:22
         compiled from ".\themes\smline\Templates\i_admin\themes.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1864053f7b506d73071-58808212%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de609a0b814b817054b84eae0b4670dd698b08b1' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\themes.tpl',
      1 => 1401047850,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1864053f7b506d73071-58808212',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'action' => 0,
    'install_error' => 0,
    'web' => 0,
    't_seo' => 0,
    'data_theme' => 0,
    'status' => 0,
    'themes' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b506e51b22_32853685',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b506e51b22_32853685')) {function content_53f7b506e51b22_32853685($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['action']->value=='install') {?>
		
		<div class="box box_main">
			<div class="box_title"><?php if ($_smarty_tpl->tpl_vars['action']->value=='edit') {?>Editar<?php } else { ?>Instalar<?php }?> tema</div>
			<div class="box_body clearfix admin-settings">
				
				<?php if ($_smarty_tpl->tpl_vars['install_error']->value) {?>
				<span class="item-info error margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"><?php echo $_smarty_tpl->tpl_vars['install_error']->value;?>
</span>
				<?php } else { ?>
				<span class="item-info margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png">El nombre de la carpeta del tema debe tener letras, n&uacute;meros y/o guiones (no bajos).</span>
				<?php }?>
				
				<form action="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=install" method="post" name="sm_install">
				
					<ul>
						
						<li class="list_item clearfix">
							<label for="t_seo">Nombre de la carpeta del tema:
								<small><?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/themes/<strong class="dirtheme"><?php echo $_smarty_tpl->tpl_vars['t_seo']->value;?>
</strong></small>
							</label>
							<input type="text" id="t_seo" class="inp_text" name="t_seo" autocomplete="off" style="display:inline-block;" onchange="$('.dirtheme').html($(this).val())" onkeyup="$('.dirtheme').html($(this).val())" value="<?php echo $_smarty_tpl->tpl_vars['t_seo']->value;?>
">
						</li>
						
						<input type="hidden" value="1" name="install">
					
					</ul>
					
					<hr>
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes" class="button_1 floatL">Volver</a>
					<input type="button" class="button_1 b_ok floatR" value="Instalar tema" onclick="document.forms.sm_install.submit();">
					
				</form>
				
			</div>
		</div>
		
<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=='uninstall') {?>
	
<div class="box">
	<div class="box_title">Desinstalar tema: <?php echo $_smarty_tpl->tpl_vars['data_theme']->value['t_name'];?>
</div>
	<div class="box_body clearfix admin-settings">
		
		<form action="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=uninstall&tid=<?php echo $_smarty_tpl->tpl_vars['data_theme']->value['t_id'];?>
" method="post" name="sm_uninstall">
			<input type="hidden" value="1" name="uninstall">
		
			<center><h4>&iquest;Realmente deseas desinstalar este tema?</h4></center>
			
			<hr>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes" class="button_1 floatL">Volver</a>
			<input type="button" class="button_1 b_ok floatR" value="Desinstalar tema" onclick="document.forms.sm_uninstall.submit();">
		
		</form>
		
	</div>
	
</div>

<?php } elseif ($_smarty_tpl->tpl_vars['action']->value=='aplicar') {?>
	
<div class="box">
	<div class="box_title">Aplicar tema: <?php echo $_smarty_tpl->tpl_vars['data_theme']->value['t_name'];?>
</div>
	<div class="box_body clearfix admin-settings">
		
		<form action="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=aplicar&tid=<?php echo $_smarty_tpl->tpl_vars['data_theme']->value['t_id'];?>
" method="post" name="sm_aplicar">
			<input type="hidden" value="1" name="aplicar">
			
			<span class="item-info margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png">El contenido de la carpeta de cach&eacute; se eliminar&aacute;.</span>
			
			<br />
			
			<center><h4>&iquest;Realmente deseas aplicar este tema?</h4></center>
			
			<hr>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes" class="button_1 floatL">Volver</a>
			<input type="button" class="button_1 b_ok floatR" value="Aplicar tema" onclick="document.forms.sm_aplicar.submit();">
		
		</form>
		
	</div>
	
</div>

<?php } else { ?>

<div class="box">
	<div class="box_title">Temas</div>
	<div class="box_body clearfix">
	
		<?php if ($_smarty_tpl->tpl_vars['status']->value=='error_uninstall') {?>
		<span class="item-info error margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png">Error al desinstalar el tema.</span><hr />
		<?php } elseif ($_smarty_tpl->tpl_vars['status']->value=='error_aplicar') {?>
		<span class="item-info error margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png">Error al aplicar el tema.</span><hr />
		<?php } elseif ($_smarty_tpl->tpl_vars['status']->value=='ok_uninstall') {?>
		<span class="item-info ok margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ok.png">El tema fue desinstalado correctamente!</span><hr />
		<?php } elseif ($_smarty_tpl->tpl_vars['status']->value=='ok_install') {?>
		<span class="item-info ok margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ok.png">El tema fue instalado correctamente!</span><hr />
		<?php }?>
		
		<div class="box box_main">
			<div class="box_title">Instalados</div>
			<div class="boxy_body">
				<div class="box_content SMnews">
					
					<?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['themes']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
					
					<li class="themes">
						<div class="title">
							
							<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/themes/<?php echo $_smarty_tpl->tpl_vars['t']->value['t_seo'];?>
/css/img/thumbnail.png" alt="thumbnail" title="theme tumbnail" class="theme_thumb" />
							<h3><?php echo $_smarty_tpl->tpl_vars['t']->value['t_name'];?>
</h3>
							<span class="ldate">Instalado el <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['t']->value['t_install'],"%d/%m/%Y a las %I:%M %p");?>
</span>
						</div>
						
						<div class="body">Directorio: <strong><?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/themes/<?php echo $_smarty_tpl->tpl_vars['t']->value['t_seo'];?>
</strong></div>
						
						<div class="body">Dise&ntilde;ado por: <a href="<?php echo $_smarty_tpl->tpl_vars['t']->value['t_author_link'];?>
"><?php echo $_smarty_tpl->tpl_vars['t']->value['t_author'];?>
</a></div>
						
						<div class="body">
							<?php if ($_smarty_tpl->tpl_vars['t']->value['t_seo']!=$_smarty_tpl->tpl_vars['web']->value['theme']) {?>
								Acciones: 
								<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=uninstall&tid=<?php echo $_smarty_tpl->tpl_vars['t']->value['t_id'];?>
">Desinstalar tema</a> - 
								<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=aplicar&tid=<?php echo $_smarty_tpl->tpl_vars['t']->value['t_id'];?>
">Aplicar este tema</a>
							<?php } else { ?>
								<strong style="color:#00B147">Tema aplicado</strong>
							<?php }?>
						</div>
					</li>
									
					<?php } ?>
					
				</div>
					
			</div>
		</div>
		
		<hr>
		<a class="button_1 b_ok floatR" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes&action=install">Instalar un tema</a>
		
	</div>
</div>

<?php }?><?php }} ?>
