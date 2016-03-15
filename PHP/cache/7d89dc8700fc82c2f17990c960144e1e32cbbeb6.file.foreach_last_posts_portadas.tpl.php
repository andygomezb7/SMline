<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:35:29
         compiled from ".\themes\smline\Templates\i_home\foreach_last_posts_portadas.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1741653f7b7a19c6273-92991673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7d89dc8700fc82c2f17990c960144e1e32cbbeb6' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\foreach_last_posts_portadas.tpl',
      1 => 1401317406,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1741653f7b7a19c6273-92991673',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b7a1a4ee14_98453753',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b7a1a4ee14_98453753')) {function content_53f7b7a1a4ee14_98453753($_smarty_tpl) {?><div class="list-element-port clearfix">
	<div class="post-head">
		<a class="post-title stip" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
" <?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']!=1) {?>style="<?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']==0) {?>color:red<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['p_status']==2) {?>color:indigo<?php }?>"<?php }?>><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,40);?>
</a>
		<?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']!=1) {?>
		<a class="stip floatR" title="Este post se encuentra <?php if ($_smarty_tpl->tpl_vars['p']->value['p_status']==0) {?>eliminado<?php } elseif ($_smarty_tpl->tpl_vars['p']->value['p_status']==2) {?>en revisión<?php }?>">
			<i class="icon info nm"></i>
		</a>
		<?php } else { ?>
		<i class="stip icon"" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="float: right;margin: 0;background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>
		<?php }?>
	</div>
	<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" class="floatL"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/thumbs/posts/t_<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
.jpg?<?php echo $_smarty_tpl->tpl_vars['p']->value['p_update'];?>
" class="img-src"></a>
	<div class="post-right">
		<li class="list-post-stat">
			<i class="icon coins"></i><b><?php echo $_smarty_tpl->tpl_vars['p']->value['p_puntos'];?>
</b> puntos
		</li>
		<li class="list-post-stat">
			<i class="icon hits"></i><b><?php echo $_smarty_tpl->tpl_vars['p']->value['p_hits'];?>
</b> visitas
		</li>
		<li class="list-post-stat">
			<i class="icon comments"></i><b><?php echo $_smarty_tpl->tpl_vars['p']->value['p_comments'];?>
</b> comentarios
		</li>
		<?php if ($_smarty_tpl->tpl_vars['p']->value['p_sticky']) {?>
		<li class="list-post-stat">
			<i class="icon sticky floatR" title="Sticky"></i><?php if ($_smarty_tpl->tpl_vars['p']->value['p_sticky']==2) {?>Patrocinado<?php } else { ?>Sticky<?php }?>
		</li>
		<?php }?>
		<div style="margin-top: -5px;">
			<span class="post-date"><?php echo hace($_smarty_tpl->tpl_vars['p']->value['p_date']);?>
</span>
			<span class="post-date">Por @<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
</a></span>
		</div>
	</div>
</div><?php }} ?>
