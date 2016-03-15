<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:28
         compiled from ".\themes\smline\Templates\i_post\author.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2725953f7b368b6cb86-68859047%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf72e2e7675756c5779822176262caa5f4a11613' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_post\\author.tpl',
      1 => 1397580049,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2725953f7b368b6cb86-68859047',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'post' => 0,
    'user' => 0,
    't' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b368c3bc35_32700330',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b368c3bc35_32700330')) {function content_53f7b368c3bc35_32700330($_smarty_tpl) {?><div class="box box_autor">
	<div class="box_title"><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
</a></div>
	<div class="box_body clearfix">
		<div class="user-icons-head clearfix">
			<span class="u_rank etip" style="color:#<?php echo $_smarty_tpl->tpl_vars['post']->value['r_color'];?>
;"z title="Rango"><?php echo $_smarty_tpl->tpl_vars['post']->value['r_name'];?>
</span>
			<div class="autor_status">
				 <i class="icon <?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['post']->value['u_id'])) {?>on<?php } else { ?>off<?php }?>line stip" title="<?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['post']->value['u_id'])) {?>Conectado<?php } else { ?>Desconectado<?php }?>"></i>
				 <i class="icon stip" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/flag/<?php echo $_smarty_tpl->tpl_vars['post']->value['u_country_icon'];?>
.png) center no-repeat;" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['u_country'];?>
"></i>
				 <i class="icon <?php if ($_smarty_tpl->tpl_vars['post']->value['u_sex']==1) {?>fe<?php }?>male stip" title="<?php if ($_smarty_tpl->tpl_vars['post']->value['u_sex']==1) {?>Mujer<?php } else { ?>Hombre<?php }?>"></i>
				 <i class="icon stip" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ranks/<?php echo $_smarty_tpl->tpl_vars['post']->value['r_image'];?>
) center no-repeat;" title="<?php echo $_smarty_tpl->tpl_vars['post']->value['r_name'];?>
"></i>
			</div>
		</div>
		
		<ul class="list_stats">
			<li class="somb_in">
				<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['post']->value['u_posts'];?>
</span>
				<span class="list_name">Posts</span>
			</li>
			<li class="somb_in">
				<span class="list_count" id="autor-total-puntos"><?php echo $_smarty_tpl->tpl_vars['post']->value['u_points'];?>
</span>
				<span class="list_name">Puntos</span>
			</li>
			<li class="somb_in">
				<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['post']->value['u_comments'];?>
</span>
				<span class="list_name">Comentarios</span>
			</li>
			<li class="somb_in">
				<span class="list_count"><?php echo $_smarty_tpl->tpl_vars['post']->value['u_follows'];?>
</span>
				<span class="list_name">Seguidores</span>
			</li>
		</ul>
		<div style="position: relative;width: 125px;">
			<?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['post']->value['u_id'])) {?><span class="u-status-online stip" title="Conectado"></span><?php }?>
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['post']->value['u_id'];?>
_120.jpg?<?php echo $_smarty_tpl->tpl_vars['post']->value['u_last_avatar'];?>
" class="avatar" /></a>
		</div>
		<div id="follows-buttons" data-type="user" type-id="<?php echo $_smarty_tpl->tpl_vars['post']->value['u_id'];?>
">
			<a class="button_1 type_1 to_follow require-login" style="<?php if ($_smarty_tpl->tpl_vars['user']->value->is_following('user',$_smarty_tpl->tpl_vars['post']->value['u_id'])) {?>display:none;<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/follow.png"/>Seguir</a>
			<a class="button_3 type_1 ok_follow" style="<?php if (!$_smarty_tpl->tpl_vars['user']->value->is_following('user',$_smarty_tpl->tpl_vars['post']->value['u_id'])) {?>display:none;<?php }?>">Siguiendo</a>
			<a class="b_cancel type_1 un_follow" style="display:none;">Dejar de seguir</a>
		</div>
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mensajes/a/<?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
" class="button_1 type_1 margin-top-5 require-login">
			<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/message.png"/>Mensaje</a>
		<hr />
		<div class="autor-data">
			<li><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/location.gif"/> Vive en <b><?php echo $_smarty_tpl->tpl_vars['post']->value['u_country'];?>
</b></li>
			<li><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/time.png"/> Se registró el <b><?php echo $_smarty_tpl->tpl_vars['post']->value['u_register'][0];?>
 de <?php echo $_smarty_tpl->tpl_vars['post']->value['u_register'][1];?>
 del <?php echo $_smarty_tpl->tpl_vars['post']->value['u_register'][2];?>
</b></li>
			<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['gomod']||$_smarty_tpl->tpl_vars['user']->value->permits['goadmin']) {?><li><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/zoom.png"/> IP <a href="http://geoiptool.com/es/?IP=<?php echo $_smarty_tpl->tpl_vars['post']->value['p_ip'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_ip'];?>
</a></li><?php }?>
		</div>
	</div>
</div>

<div class="sidebar_tags">
<?php  $_smarty_tpl->tpl_vars['t'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['t']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['tags']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['t']->key => $_smarty_tpl->tpl_vars['t']->value) {
$_smarty_tpl->tpl_vars['t']->_loop = true;
?>
<?php if ($_smarty_tpl->tpl_vars['t']->value) {?><a class="button_1" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['t']->value;?>
&as=tags"><i class="icon p-tag"></i><?php echo $_smarty_tpl->tpl_vars['t']->value;?>
</a><?php }?>
<?php } ?>
</div>
<?php }} ?>
