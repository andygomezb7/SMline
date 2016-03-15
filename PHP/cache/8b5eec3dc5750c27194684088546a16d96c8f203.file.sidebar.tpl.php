<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:21
         compiled from ".\themes\smline\Templates\i_admin\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2763953f7b505a07c14-04244433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b5eec3dc5750c27194684088546a16d96c8f203' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\sidebar.tpl',
      1 => 1400987753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2763953f7b505a07c14-04244433',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'do' => 0,
    'web' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b505af60c2_85747637',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b505af60c2_85747637')) {function content_53f7b505af60c2_85747637($_smarty_tpl) {?><ul class="smartec_menu">
	<li class="asm_home<?php if ($_smarty_tpl->tpl_vars['do']->value=='') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin">Inicio</a>
	</li>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['ecds']) {?>
	<li class="asm_settings<?php if ($_smarty_tpl->tpl_vars['do']->value=='settings') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=settings">Configuraciones</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['etds']) {?>
	<li class="asm_themes<?php if ($_smarty_tpl->tpl_vars['do']->value=='themes') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=themes">Temas</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aebn']) {?>
	<li class="asm_news<?php if ($_smarty_tpl->tpl_vars['do']->value=='news') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=news">Noticias</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['ebp']) {?>
	<li class="asm_ads<?php if ($_smarty_tpl->tpl_vars['do']->value=='ads') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=ads">Banners</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aebli']) {?>
	<li class="asm_links<?php if ($_smarty_tpl->tpl_vars['do']->value=='links') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=links">Links de interés</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aeu']) {?>
	<li class="asm_users<?php if ($_smarty_tpl->tpl_vars['do']->value=='users') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=users">Usuarios</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aebc']) {?>
	<li class="asm_cats<?php if ($_smarty_tpl->tpl_vars['do']->value=='cats') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=cats">Categorias</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aebm']) {?>
	<li class="asm_medals<?php if ($_smarty_tpl->tpl_vars['do']->value=='medals') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=medals">Medallas</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['aebr']) {?>
	<li class="asm_ranks<?php if ($_smarty_tpl->tpl_vars['do']->value=='ranks') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=ranks">Rangos</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['abpc']) {?>
	<li class="asm_censored<?php if ($_smarty_tpl->tpl_vars['do']->value=='censored') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=censored">Censuras</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['abib']) {?>
	<li class="asm_blocked<?php if ($_smarty_tpl->tpl_vars['do']->value=='blocked') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=blocked">Bloqueos</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['acm']) {?>
	<li class="asm_mps<?php if ($_smarty_tpl->tpl_vars['do']->value=='mps') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=mps">Mensajes</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['acp']) {?>
	<li class="asm_posts<?php if ($_smarty_tpl->tpl_vars['do']->value=='posts') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=posts">Posts</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['acf']) {?>
	<li class="asm_gallery<?php if ($_smarty_tpl->tpl_vars['do']->value=='gallery') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=gallery">Imágenes</a>
	</li>
	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['user']->value->permits['as']) {?>
	<li class="asm_stats<?php if ($_smarty_tpl->tpl_vars['do']->value=='stats') {?> active<?php }?>">
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/admin?do=stats">Estadísticas</a>
	</li>
	<?php }?>
</ul><?php }} ?>
