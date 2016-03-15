<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:34
         compiled from ".\themes\smline\Templates\i_profile\left.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1865853f7b54eabc231-08542066%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '441ac4207682d1cc090513b283840a26a9f69543' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\left.tpl',
      1 => 1398873124,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1865853f7b54eabc231-08542066',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'u_info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54eacbc31_69478940',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54eacbc31_69478940')) {function content_53f7b54eacbc31_69478940($_smarty_tpl) {?><div class="vertical_tabbed_tabs" id="profile_tabs">
	<p class="short photo_holder">
		<img class="profile_avatar" id="profile_photo" src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/avatar/<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_id'];?>
_120.jpg?<?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_last_avatar'];?>
" alt="Foto de <?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_nick'];?>
">
	</p>
	<ul class="tabs_links">
		<li class="tab_link_core tab_states active">
			<a onclick="profile.load_tab('states');" href="#estados" class="a-estados">Estados</a>
		</li>
		<li class="tab_link_core tab_info">
			<a onclick="profile.load_tab('info');" href="#informacion" class="a-informacion">Información</a>
		</li>
		<li class="tab_link_core tab_activity">
			<a onclick="profile.load_tab('activity');" href="#actividad" class="a-actividad">Actividad</a>
		</li>
		<li class="tab_link_core tab_posts">
			<a onclick="profile.load_tab('posts');" href="#posts" class="a-posts">Posts</a>
		</li>
		<li class="tab_link_core tab_topics">
			<a onclick="profile.load_tab('topics');" href="#temas" class="a-temas">Temas</a>
		</li>
		<li class="tab_link_core tab_images">
			<a onclick="profile.load_tab('images');" href="#imagenes" class="a-imagenes">Imágenes</a>
		</li>
		<li class="tab_link_core tab_follows">
			<a onclick="profile.load_tab('follows');" href="#seguidores" class="a-seguidores">Seguidores</a>
		</li>
		<li class="tab_link_core tab_following">
			<a onclick="profile.load_tab('following');" href="#siguiendo" class="a-siguiendo">Siguiendo</a>
		</li>
		<li class="tab_link_core tab_comus">
			<a onclick="profile.load_tab('comus');" href="#comunidades" class="a-comunidades">Comunidades</a>
		</li>
		<li class="tab_link_core tab_medals">
			<a onclick="profile.load_tab('medals');" href="#medallas" class="a-medallas">Medallas</a>
		</li>
	</ul>
</div><?php }} ?>
