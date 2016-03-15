<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:35:21
         compiled from ".\themes\smline\Templates\i_admin\settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2036753f7b799c50bf0-12506496%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c95cfa10a7d858cf4d7869e70bef1a8784c446da' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\settings.tpl',
      1 => 1396558984,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2036753f7b799c50bf0-12506496',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b799d567b4_05198002',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b799d567b4_05198002')) {function content_53f7b799d567b4_05198002($_smarty_tpl) {?><script type="text/javascript">

$(document).ready(function(){
$('.list_item span#r_offline').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['offline']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['offline']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_welcome').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['welcome']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['welcome']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_reg_active').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['reg_active']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['reg_active']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_recover_active').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['recover_active']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['recover_active']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_active_user').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['active_user']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['active_user']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_live').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['live']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['live']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.list_item span#r_port_posts').addClass('<?php if ($_smarty_tpl->tpl_vars['web']->value['port_posts']==1) {?>button_3<?php } else { ?>b_cancel<?php }?>').text('<?php if ($_smarty_tpl->tpl_vars['web']->value['port_posts']==1) {?>Activado<?php } else { ?>Desactivado<?php }?>');
$('.settings-no-load').fadeIn(450);
$('.settings-loading').remove();
});

</script>

<div class="box">
	<div class="box_title">Configuraciones del sitio</div>
	<div class="box_body clearfix admin-settings">
		<span class="item-info"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png" />Haz click sobre la configuración que quieres editar y presiona enter para guardar cambios.</span>
		<hr />
		<center class="settings-loading"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/loading.gif" /></center>
		<ul style="display:none;" class="settings-no-load">
		
			<li class="list_item type_text clearfix">
				<label id="r_title">Título de la web:</label>
				<span id="r_title"><?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
</span><input type="text" id="r_title" class="inp_text" maxlength="40" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_slogan">Lema de la web:</label>
				<span id="r_slogan"><?php echo $_smarty_tpl->tpl_vars['web']->value['slogan'];?>
</span><input type="text" id="r_slogan" class="inp_text" maxlength="40" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['slogan'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_url">URL de la web:</label>
				<span id="r_url"><?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
</span><input type="text" id="r_url" class="inp_text" maxlength="40" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_descripcion">Descripción del sitio:<small>Descripción de los contenidos de tu web para Google, Bing, Yahoo etc</small></label>
				<span id="r_descripcion"><?php echo $_smarty_tpl->tpl_vars['web']->value['descripcion'];?>
</span><input type="text" id="r_descripcion" class="inp_text" maxlength="300" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['descripcion'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_tags">Tags del sitio:<small>Etiquetas o keywords que identifiquen tu web para Google, Bing, Yahoo etc</small></label>
				<span id="r_tags"><?php echo $_smarty_tpl->tpl_vars['web']->value['tags'];?>
</span><input type="text" id="r_tags" class="inp_text" maxlength="300" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['tags'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_offline">Mantenimiento:</label>
				<span id="r_offline" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_offline_message">Mensaje de mantenimiento:</label>
				<span id="r_offline_message"><?php echo $_smarty_tpl->tpl_vars['web']->value['offline_message'];?>
</span><input type="text" id="r_offline_message" style="width:370px;" class="inp_text" maxlength="300" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['offline_message'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_welcome">Dar bienvenida:</label>
				<span id="r_welcome" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_welcome_message">Mensaje de bienvenida:</label>
				<span id="r_welcome_message"><?php echo $_smarty_tpl->tpl_vars['web']->value['welcome_message'];?>
</span><input type="text" id="r_welcome_message" style="width:370px;" class="inp_text" maxlength="300" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['welcome_message'];?>
" autocomplete="off">
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_user_robot">ID de usuario "robot":</label>
				<span id="r_user_robot"><?php echo $_smarty_tpl->tpl_vars['web']->value['user_robot'];?>
</span><input type="text" id="r_user_robot" class="inp_text" maxlength="12" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['user_robot'];?>
" style="width:110px;" autocomplete="off">
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_reg_active">Registro:</label>
				<span id="r_reg_active" class="button_3">Activado</span>
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_active_user">Activación de cuentas por e-mail:</label>
				<span id="r_active_user" class="">Desactivado</span>
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_recover_active">Recuperación de cuentas por e-mail:</label>
				<span id="r_recover_active" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_min_age">Edad requerida:</label>
				<span id="r_min_age"><?php echo $_smarty_tpl->tpl_vars['web']->value['min_age'];?>
</span><input type="text" id="r_min_age" class="inp_text" maxlength="2" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['min_age'];?>
" style="width:20px;" autocomplete="off"> años.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_points_update">Actualizar/Recargar puntos cada:</label>
				<span id="r_points_update"><?php echo $_smarty_tpl->tpl_vars['web']->value['points_update'];?>
</span><input type="text" id="r_points_update" class="inp_text" maxlength="3" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['points_update'];?>
" style="width:20px;" autocomplete="off"> horas.
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_live">Notificaciones en vivo:</label>
				<span id="r_live" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_live_timeout">Comprobar nuevas notificaciones cada:</label>
				<span id="r_live_timeout"><?php echo $_smarty_tpl->tpl_vars['web']->value['live_timeout'];?>
</span><input type="text" id="r_live_timeout" class="inp_text" maxlength="2" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['live_timeout'];?>
" style="width:20px;" autocomplete="off"> segundos.
			</li>
			
			<li class="list_item type_but clearfix">
				<label id="r_port_posts">Home con portadas:<small>Los últimos posts en el inicio mostrarán su imágen de portada</small></label>
				<span id="r_port_posts" class="">Activado</span>
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_user_online">Usuario online:</label>
				<span id="r_user_online"><?php echo $_smarty_tpl->tpl_vars['web']->value['user_online'];?>
</span><input type="text" id="r_user_online" class="inp_text" maxlength="2" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['user_online'];?>
" style="width:20px;" autocomplete="off"> minutos.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_max_posts">Posts por página:</label>
				<span id="r_max_posts"><?php echo $_smarty_tpl->tpl_vars['web']->value['max_posts'];?>
</span><input type="text" id="r_max_posts" class="inp_text" maxlength="2" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['max_posts'];?>
" style="width:20px;" autocomplete="off"> posts.
			</li>
			
			<li class="list_item type_text clearfix">
				<label id="r_max_comm">Comentarios por post:</label>
				<span id="r_max_comm"><?php echo $_smarty_tpl->tpl_vars['web']->value['max_comm'];?>
</span><input type="text" id="r_max_comm" class="inp_text" maxlength="2" value="<?php echo $_smarty_tpl->tpl_vars['web']->value['max_comm'];?>
" style="width:20px;" autocomplete="off"> comentarios.
			</li>
			
		</ul>
		
	</div>
</div><?php }} ?>
