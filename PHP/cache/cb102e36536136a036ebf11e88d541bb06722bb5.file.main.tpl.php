<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:34
         compiled from ".\themes\smline\Templates\i_profile\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:523553f7b54eaf2d40-10238610%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cb102e36536136a036ebf11e88d541bb06722bb5' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\main.tpl',
      1 => 1398101302,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '523553f7b54eaf2d40-10238610',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'u_info' => 0,
    'web' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54ec4a993_47690418',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54ec4a993_47690418')) {function content_53f7b54ec4a993_47690418($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_image']||$_smarty_tpl->tpl_vars['u_info']->value['u_color']) {?>
<style type="text/css">
body {
	<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_image']) {?>background-image: url(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_image'];?>
);
	background-repeat: <?php if (!$_smarty_tpl->tpl_vars['u_info']->value['u_image_repeat']) {?>no-<?php }?>repeat;<?php }?>
	background-color: #<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_color'];?>
;

}
.profile-content {
	background: transparent!important;
}
#content {
	background: rgba(255, 255, 255, 0.8)!important;
}
#header {
	box-shadow: 0 2px 20px #000000;
}

</style>
<?php }?>
<div class="profile_main">
	<div id="profile_content_main">
		<div id="user_info_cell" class="clearfix">
			<div class="user_icons">
				<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_sex']==1) {?>fe<?php }?>male.png" class="stip" title="<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_sex']==1) {?>Mujer<?php } else { ?>Hombre<?php }?>" />
				<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/flag/<?php echo strtolower($_smarty_tpl->tpl_vars['u_info']->value['u_country']);?>
.png" class="stip" title="<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_country_name'];?>
" />
				<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ranks/<?php echo $_smarty_tpl->tpl_vars['u_info']->value['r_image'];?>
" class="stip" title="<?php echo $_smarty_tpl->tpl_vars['u_info']->value['r_name'];?>
" />
			</div>
			<h1 class="type_pagetitle">
				<h1 class="fn nickname"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_names']||$_smarty_tpl->tpl_vars['u_info']->value['u_surnames']) {?> <small>(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_names'];?>
 <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_surnames'];?>
)</small><?php }?></h1>
			</h1>
			<div class="u_r_s">
				<span style="color:#<?php echo $_smarty_tpl->tpl_vars['u_info']->value['r_color'];?>
" class="etip r_name" title="Rango"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['r_name'];?>
</span>
				<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_site']) {?>
				 - <a href="<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_site'];?>
" target="_blank" rel="nofollow"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_site'];?>
</a>
				<?php }?>
			</div>
			<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_bio']) {?>
			<span class="user_bio"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_bio'];?>
</span>
			<?php } else { ?>
			<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/location.gif" class="u_p_r" /> Vive en <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_country_name'];?>

			<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/time.png" class="u_p_r marg" /> Miembro desde el <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_register'][0];?>
 de <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_register'][1];?>
 de <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_register'][2];?>
<br>
			<?php }?>
			<div class="u_s_a">
			<?php if ($_smarty_tpl->tpl_vars['user']->value->is_online($_smarty_tpl->tpl_vars['u_info']->value['u_id'])) {?><span class="badge badge_green reset_cursor">Conectado</span>
			<?php } else { ?><span class="badge badge_lightgrey reset_cursor">Desconectado</span><?php }?>
			<span class="desc lighter" style="color: #a4a4a4;">Última actividad <?php echo $_smarty_tpl->tpl_vars['u_info']->value['last_active'];?>
</span>
			</div>
			
			<?php if (($_smarty_tpl->tpl_vars['user']->value->permits['gomod']||$_smarty_tpl->tpl_vars['user']->value->permits['goadmin'])&&$_smarty_tpl->tpl_vars['u_info']->value['u_status']==3) {?>
				<div id="error" style="margin-top:10px;">Este usuario se encuentra actualmente suspendido</div>
			<?php }?>
	
			<div class="profile_actions">
				
				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['su']&&$_smarty_tpl->tpl_vars['u_info']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['u_info']->value['u_status']!=3) {?>
				<a onclick="mod.banned(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
)" class="button_1 margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/minus.png"/>Suspender</a>
				<?php } elseif ($_smarty_tpl->tpl_vars['user']->value->permits['ru']&&$_smarty_tpl->tpl_vars['u_info']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['u_info']->value['u_status']==3) {?>
				<a onclick="mod.unbanned(<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
, '<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
')" class="button_1 margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/sok.png"/>Reactivar</a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aeu']&&$_smarty_tpl->tpl_vars['u_info']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=users&action=edit&uid=<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
" class="button_1 margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/edit_.png"/>Editar usuario</a>
				<?php }?>
				<?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_id']==$_smarty_tpl->tpl_vars['user']->value->uid) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/cuenta#perfil" class="button_1 margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/edit_.png"/>Editar perfil</a>
				<?php } elseif ($_smarty_tpl->tpl_vars['user']->value->uid) {?>
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/mensajes/a/<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
" class="button_1 margin-top-5"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/message.png"/>Enviar mensaje</a>
				<div id="follows-buttons" data-type="user" type-id="<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
">
					<a class="button_1 to_follow" style="<?php if ($_smarty_tpl->tpl_vars['user']->value->is_following('user',$_smarty_tpl->tpl_vars['u_info']->value['u_id'])) {?>display:none;<?php }?>"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/follow.png"/>Seguir</a>
					<a class="button_3 ok_follow" style="<?php if (!$_smarty_tpl->tpl_vars['user']->value->is_following('user',$_smarty_tpl->tpl_vars['u_info']->value['u_id'])) {?>display:none;<?php }?>">Siguiendo</a>
					<a class="b_cancel un_follow" style="display:none;">Dejar de seguir</a>
				</div>
				<?php }?>
				
				<?php if ($_smarty_tpl->tpl_vars['user']->value->uid&&$_smarty_tpl->tpl_vars['u_info']->value['u_id']!=$_smarty_tpl->tpl_vars['user']->value->uid) {?>
				<a class="button_1 type_5 stip floatR" onclick="user.new_report('usuario', '<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
', false, <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
);" title="Reportar usuario"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/flag.png"></a>
				<?php }?>
			</div>
			
		</div>
		
		<div class="profile_tab_active">
		<?php echo $_smarty_tpl->getSubTemplate ('i_profile/states.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		</div>
	</div>
</div><?php }} ?>
