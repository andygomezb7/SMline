<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:28
         compiled from ".\themes\smline\Templates\i_post\content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15253f7b368cb8c52-93540788%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '64bb6c80d1cffb3ebbbc52fb52391e49506ad2fd' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_post\\content.tpl',
      1 => 1398884794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15253f7b368cb8c52-93540788',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post' => 0,
    'user' => 0,
    'web' => 0,
    'h' => 0,
    'x' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b368e99443_39447773',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b368e99443_39447773')) {function content_53f7b368e99443_39447773($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?><?php if ($_smarty_tpl->tpl_vars['post']->value['p_status']==0&&$_smarty_tpl->tpl_vars['user']->value->permits['vpb']) {?><div class="item-info error" style="margin-bottom:5px">Este post se encuentra actualmente <b>eliminado</b>. Tus privilegios de rango te permiten visualizar posts eliminados.</div><?php } elseif ($_smarty_tpl->tpl_vars['post']->value['p_status']==2&&$_smarty_tpl->tpl_vars['user']->value->permits['vpr']) {?><div class="item-info" style="margin-bottom:5px"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png">Este post se encuentra actualmente en <b>revisi&oacute;n</b>. Tus privilegios de rango te permiten visualizar posts en revisi&oacute;n. Recuerda que en tus deberes como moderador incluye el revisar y aprobar posts.</div><?php }?><h1 class="post_title"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_title'];?>
</h1>	<div class="post-head-info clearfix">		<span class="post_date"><a class="stip" title="<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['p_date'],"%d/%m/%Y %I:%M %p");?>
"><?php echo hace($_smarty_tpl->tpl_vars['post']->value['p_date']);?>
</a> | <a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['post']->value['c_seo'];?>
"><?php echo $_smarty_tpl->tpl_vars['post']->value['c_name'];?>
</a></span>		<div class="actions_follow_and_fav">			<div id="follows-buttons" data-type="posts" type-id="<?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
" style="display:inline-block;">				<a class="button_1 to_follow require-login" style="<?php if ($_smarty_tpl->tpl_vars['user']->value->is_following('post',$_smarty_tpl->tpl_vars['post']->value['p_id'])) {?>display:none;<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/follow.png"/>Seguir post</a>				<a class="button_3 ok_follow" style="<?php if (!$_smarty_tpl->tpl_vars['user']->value->is_following('post',$_smarty_tpl->tpl_vars['post']->value['p_id'])) {?>display:none;<?php }?>">Siguiendo</a>				<a class="b_cancel un_follow" style="display:none;">Dejar de seguir</a>			</div>						<?php if ($_smarty_tpl->tpl_vars['post']->value['p_user']!=$_smarty_tpl->tpl_vars['user']->value->uid&&!$_smarty_tpl->tpl_vars['user']->value->permits['goadmin']&&!$_smarty_tpl->tpl_vars['user']->value->permits['gomod']) {?>			<a class="button_1 type_5 stip require-login" onclick="user.new_report('post', '<?php echo $_smarty_tpl->tpl_vars['post']->value['p_title'];?>
', '<?php echo $_smarty_tpl->tpl_vars['post']->value['u_nick'];?>
', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);" title="Reportar post"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/flag.png" /></a>			<?php }?>						<?php if ($_smarty_tpl->tpl_vars['post']->value['p_user']!=$_smarty_tpl->tpl_vars['user']->value->uid) {?>			<a class="button_1 post_add_fav require-login" onclick="<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>post.fav(0);return false;<?php }?>" href="#" style="<?php if ($_smarty_tpl->tpl_vars['post']->value['p_is_fav']) {?>display:none;<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/heart_10.png"/>Agregar a favoritos</a>			<a class="button_1 post_remove_fav" onclick="post.fav(1);" style="<?php if (!$_smarty_tpl->tpl_vars['post']->value['p_is_fav']) {?>display:none;<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/heart_10.png"/>Borrar de favoritos</a>			<?php }?>									<?php if (($_smarty_tpl->tpl_vars['post']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid&&($_smarty_tpl->tpl_vars['user']->value->permits['bpp']||$_smarty_tpl->tpl_vars['user']->value->permits['epp']))||$_smarty_tpl->tpl_vars['user']->value->permits['bp']||$_smarty_tpl->tpl_vars['user']->value->permits['ep']||$_smarty_tpl->tpl_vars['user']->value->permits['apr']||$_smarty_tpl->tpl_vars['user']->value->permits['fp']) {?>			<a class="button_1 post_options" onclick="$('.list_options').toggle(400);">Opciones</a>			<ul class="list_options">				<?php if ($_smarty_tpl->tpl_vars['post']->value['p_status']==0&&($_smarty_tpl->tpl_vars['post']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid||$_smarty_tpl->tpl_vars['user']->value->permits['goadmin'])&&$_smarty_tpl->tpl_vars['user']->value->permits['vpb']) {?>					<li><a onclick="mod.reac('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sok.png"/> Reactivar post</a></li>				<?php } elseif ($_smarty_tpl->tpl_vars['post']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['bpp']&&$_smarty_tpl->tpl_vars['post']->value['p_status']!=0) {?>					<li><a onclick="post.del(<?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete.png"/> Borrar post</a></li>				<?php } elseif ($_smarty_tpl->tpl_vars['user']->value->permits['bp']&&$_smarty_tpl->tpl_vars['post']->value['p_status']!=0) {?>					<li><a onclick="mod.del('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete.png"/> Borrar post</a></li>				<?php }?>				<?php if (($_smarty_tpl->tpl_vars['post']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['user']->value->permits['epp'])||$_smarty_tpl->tpl_vars['user']->value->permits['ep']) {?>					<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/agregar-post?pid=<?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/edit.png"/> Editar post</a></li>				<?php }?>				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['apr']&&$_smarty_tpl->tpl_vars['post']->value['p_status']!=2) {?>					<li><a onclick="mod.revise('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cross.png"/> Mandar a revisión</a></li>				<?php }?>				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['apr']&&$_smarty_tpl->tpl_vars['post']->value['p_status']==2) {?>					<li><a onclick="mod.approve('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/blue_ball.png"/> Aprobar post</a></li>				<?php }?>				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['fp']&&$_smarty_tpl->tpl_vars['post']->value['p_sticky']==0) {?>					<li><a onclick="mod.add_sticky('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sticky.png"/> Fijar post</a></li>				<?php }?>				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['dfp']&&$_smarty_tpl->tpl_vars['post']->value['p_sticky']==1) {?>					<li><a onclick="mod.remove_sticky('posts', <?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sticky.png"/> Desfijar post</a></li>				<?php }?>			</ul>			<?php }?>											</div>	</div>		<?php if ($_smarty_tpl->tpl_vars['post']->value['history']) {?>	<div class="post-mod-history">		<center><h3>Historial de moderación del post			<a onclick="$('.post-mod-history table').toggle();" class="floatR" title="Ocultar/Mostrar"><i class="icon expand"></i></a>		</h3></center>		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="718" align="center">            <thead>				<tr>					<th>Moderador</th>					<th>Acción</th>					<th>Razón</th>					<th>Fecha</th>				</tr>			</thead>			<tbody>				<?php  $_smarty_tpl->tpl_vars['h'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['h']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['history']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['h']->key => $_smarty_tpl->tpl_vars['h']->value) {
$_smarty_tpl->tpl_vars['h']->_loop = true;
?>				<tr>					<td><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
"><b><?php echo $_smarty_tpl->tpl_vars['h']->value['u_nick'];?>
</b></a></td>					<td>						<?php if ($_smarty_tpl->tpl_vars['h']->value['h_action']==1) {?><span class="color-red">borró el post</span> 						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==2) {?><span class="color-green">reactivó el post</span>						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==3) {?><span class="color-gray">editó el post</span>						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==4) {?><span class="color-indigo">a revisión</span>						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==5) {?><span class="color-coral">aprobó el post</span>						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==6) {?><span class="color-blue">fijó el post</span>						<?php } elseif ($_smarty_tpl->tpl_vars['h']->value['h_action']==7) {?><span class="color-deeppink">desfijó el post</span>						<?php }?>					</td>					<td><?php echo $_smarty_tpl->tpl_vars['h']->value['h_reason'];?>
</td>					<td><?php echo hace($_smarty_tpl->tpl_vars['h']->value['h_date']);?>
</td>				</tr>				<?php } ?>			</tbody>		</table>	</div>	<?php }?>	<div class="box_body post_content margin-top-5 clearfix">				<?php echo $_smarty_tpl->tpl_vars['post']->value['p_body'];?>
		<hr class="hr-dashed"/>								<span class="share-title">Recomienda este post a tus amigos.</span>		<script type="text/javascript">var switchTo5x=true;</script>		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>		<script type="text/javascript">stLight.options({publisher: "f9eaeb68-1fbe-46ad-9970-5ad61d3aa753", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>		<div class="post-share-bottom">			<span class="st_email_hcount" displayText="Email"></span>			<span class="st_linkedin_hcount" displayText="LinkedIn"></span>			<span class="st_googleplus_hcount" displayText="Google +"></span>			<span class="st_twitter_hcount" displayText="Tweet"></span>			<span class="st_facebook_hcount" displayText="Facebook"></span>			<span class="number-share-t unrated">				<a onclick="<?php if ($_smarty_tpl->tpl_vars['user']->value->uid) {?>post.share();return false;<?php }?>" href="#" class="share-t require-login"></a>				<span class="count-shareds">					<span class="shar-pico"></span>					<span class="total-share"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_shared'];?>
</span>				</span>			</span>		</div>		<?php if ($_smarty_tpl->tpl_vars['user']->value->info['u_points_ava']&&$_smarty_tpl->tpl_vars['post']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid) {?>		<div class="dar-puntos floatR">			<span class="item-info ok margin-top-5" style="display:none"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ok.png"> Puntos agregados!</span>			<center>			<span class="share-title center">Califica este post.</span>			<?php  $_smarty_tpl->tpl_vars['x'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['x']->value = 1;
  if ($_smarty_tpl->tpl_vars['x']->value<=$_smarty_tpl->tpl_vars['user']->value->info['u_points_ava']) { for ($_foo=true;$_smarty_tpl->tpl_vars['x']->value<=$_smarty_tpl->tpl_vars['user']->value->info['u_points_ava']; $_smarty_tpl->tpl_vars['x']->value++) {
?>			<a class="dar-pts-<?php echo $_smarty_tpl->tpl_vars['x']->value;?>
" onclick="post.puntuar(<?php echo $_smarty_tpl->tpl_vars['x']->value;?>
)"><?php if ($_smarty_tpl->tpl_vars['x']->value==10) {?>+<?php }?><?php echo $_smarty_tpl->tpl_vars['x']->value;?>
</a>			<?php }} ?>			</center>		</div>		<?php } elseif ($_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['post']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid) {?>		<div style="clear: both"></div>		<div class="dar-puntos">			<span class="item-info margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/info.png"> No tienes puntos para dar por el momento, tus puntos se recargan en <?php if ($_smarty_tpl->tpl_vars['post']->value['horas_recarga']) {?><?php echo $_smarty_tpl->tpl_vars['post']->value['horas_recarga'];?>
<?php } else { ?>una<?php }?> hora<?php if ($_smarty_tpl->tpl_vars['post']->value['horas_recarga']>1) {?>s<?php }?></span>		</div>		<?php }?>			</div>		<div class="post-head-info pbottom margin-top-10 clearfix">		<ul class="post-metadata">			<li class="floatL">				<i class="icon coins"></i><b id="total-puntos"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_puntos'];?>
</b> Puntos			</li>			<li class="floatL">				<i class="icon heart"></i><b id="post-total-favs"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_favs'];?>
</b> Favoritos			</li>			<li class="floatL">				<i class="icon comments"></i><b id="post-total-comment"><?php echo $_smarty_tpl->tpl_vars['post']->value['p_comments'];?>
</b> Comentarios			</li>			<li class="floatL">				<i class="icon eye"></i><b><?php echo $_smarty_tpl->tpl_vars['post']->value['p_follows'];?>
</b> Seguidores			</li>			<li class="floatL">				<i class="icon hits"></i><b><?php echo $_smarty_tpl->tpl_vars['post']->value['p_hits'];?>
</b> Visitas			</li>		</ul>	</div><?php }} ?>
