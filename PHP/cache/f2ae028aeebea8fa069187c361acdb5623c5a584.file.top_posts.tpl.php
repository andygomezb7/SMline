<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:02
         compiled from ".\themes\smline\Templates\i_tops\top_posts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2044053f8c022c37c74-68675636%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f2ae028aeebea8fa069187c361acdb5623c5a584' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_tops\\top_posts.tpl',
      1 => 1399043147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2044053f8c022c37c74-68675636',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'posts_puntos' => 0,
    'i' => 0,
    'p' => 0,
    'web' => 0,
    'posts_favoritos' => 0,
    'posts_seguidores' => 0,
    'posts_comentarios' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c022d510b6_32900542',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c022d510b6_32900542')) {function content_53f8c022d510b6_32900542($_smarty_tpl) {?><div class="box box-top">	<div class="box_title">Posts con más puntos</div>		<div class="box_body list_element">		<?php if (!$_smarty_tpl->tpl_vars['posts_puntos']->value) {?><div class="emptyData">Nada por aqu&iacute;</div><?php }?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['posts_puntos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['p']->key;
?>		<div class="list-element">			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>			<i class="icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,28);?>
</a>			<span class="value"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_puntos'];?>
</span>		</div>		<?php } ?>	</div></div><div class="box box-top">	<div class="box_title">Posts con más favoritos</div>		<div class="box_body list_element">		<?php if (!$_smarty_tpl->tpl_vars['posts_favoritos']->value) {?><div class="emptyData">Nada por aqu&iacute;</div><?php }?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['posts_favoritos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['p']->key;
?>		<div class="list-element">			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>			<i class="icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,28);?>
</a>			<span class="value"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_favs'];?>
</span>		</div>		<?php } ?>	</div></div><div class="box margin-top-5 box-top">	<div class="box_title">Posts con más seguidores</div>		<div class="box_body list_element">		<?php if (!$_smarty_tpl->tpl_vars['posts_seguidores']->value) {?><div class="emptyData">Nada por aqu&iacute;</div><?php }?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['posts_seguidores']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['p']->key;
?>		<div class="list-element">			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>			<i class="icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,28);?>
</a>			<span class="value"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_follows'];?>
</span>		</div>		<?php } ?>	</div></div><div class="box margin-top-5 box-top">	<div class="box_title">Posts con más comentarios</div>		<div class="box_body list_element">		<?php if (!$_smarty_tpl->tpl_vars['posts_comentarios']->value) {?><div class="emptyData">Nada por aqu&iacute;</div><?php }?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['posts_comentarios']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['p']->key;
?>		<div class="list-element">			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>			<i class="icon" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
" style="background: url(<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
) no-repeat;"></i>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,28);?>
</a>			<span class="value"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_comments'];?>
</span>		</div>		<?php } ?>	</div></div><?php }} ?>
