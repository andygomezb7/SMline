<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:21
         compiled from ".\themes\smline\Templates\i_admin\main_home.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2723653f7b505b21059-54366367%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '67026158b7961a78d7ea70ad31c7534d0b226bf1' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\main_home.tpl',
      1 => 1399068711,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2723653f7b505b21059-54366367',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'user' => 0,
    'get_access' => 0,
    'u' => 0,
    'get_admins' => 0,
    'version' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b505b636e6_24326455',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b505b636e6_24326455')) {function content_53f7b505b636e6_24326455($_smarty_tpl) {?><div class="box">
	<div class="box_title">Administración SMLine</div>
	<div class="box_body clearfix">
		<span class="item-info"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png" />Hola <strong><?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
</strong>. Tu rango te da el privilegio de administrar este sitio web. Recuerda visitar regularmente el <a href="http://smline.net/" target="_blank">foro oficial</a> para estar al tanto de cada novedad.</span>
		<hr />
		
		
		<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				type: 'GET',
				url: '/ajax/sm/news',
				dataType: 'json',
				success: function(h) {
					$('.SMnews').html('');
					for(var i = 0; i < h.length; i++){
						var html = '<li>';
						html += '<div class="title"><a href="' + h[i]['link'] + '" target="_blank">' + h[i]['title'] +'</a><span class="ldate">' + h[i]['date'] +'</span></div>';
						html += '<div class="body">' + h[i]['desc'] +'</div>';
						html += '</li>';
						$('.SMnews').append(html);
					}
				}
			});

		});
		</script>
		
		
		<div class="box boxy_main">
			<div class="box_title">En vivo desde SMline</div>
			<div class="boxy_body">
				<div class="boxy_content SMnews">
					
					<div class="emptyData">
						Cargando contenidos desde SMline...
					</div>
					
				</div>
				
			</div>
		</div>
		
		<div class="list_tables">		
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th colspan="2">Accesos recientes</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_access']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
					<tr class="Tleft">
						<td>
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a> <small>(<a href="http://geoiptool.com/es/?IP=<?php echo $_smarty_tpl->tpl_vars['u']->value['a_ip'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['u']->value['a_ip'];?>
</a>)</small>
						</td>
						<td><?php echo hace($_smarty_tpl->tpl_vars['u']->value['a_date']);?>
</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th>Equipo de administraci&oacute;n</th>
					</tr>
				</thead>
				<tbody>
					<?php  $_smarty_tpl->tpl_vars['u'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['u']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['get_admins']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['u']->key => $_smarty_tpl->tpl_vars['u']->value) {
$_smarty_tpl->tpl_vars['u']->_loop = true;
?>
					<tr>
						<td>
							<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['u']->value['u_nick'];?>
</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			
			<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="right">
				<thead>
					<tr>
						<th colspan="2">Versiones</th>
					</tr>
				</thead>
				<tbody>
					<tr class="Tleft">
						<td>Versión de SMLine</td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['web']->value['smline_version'];?>
</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versión de Smarty</td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['version']->value['smarty'];?>
</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versión de de PHP</td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['version']->value['php'];?>
</b></td>
					</tr>
					<tr class="Tleft">
						<td>Versi&oacute;n de MySQLi</td>
						<td><b><?php echo $_smarty_tpl->tpl_vars['version']->value['mysqli']['version'];?>
</b></td>
					</tr>
					
				</tbody>
			</table>
			
		</div>
		
	</div>
</div><?php }} ?>
