<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\i_home\top_posts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1559253f7af4e828839-09570194%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c0d4ea3e1f62744a84f44cc92c421e92dbd9a2a' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_home\\top_posts.tpl',
      1 => 1398819371,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1559253f7af4e828839-09570194',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'top_posts' => 0,
    'i' => 0,
    'web' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e85b4c4_09524207',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e85b4c4_09524207')) {function content_53f7af4e85b4c4_09524207($_smarty_tpl) {?><div class="box margin-top-5">	<div class="box_title">Top posts</div>		<div class="box_filter filter_posts clearfix">		<a onclick="tops_filter('posts', 1, 'ho')" class="f_p_ho">Hoy</a>		<a onclick="tops_filter('posts', 2, 'ay')" class="f_p_ay">Ayer</a>		<a onclick="tops_filter('posts', 3, 'se')" class="f_p_se">Semana</a>		<a onclick="tops_filter('posts', 4, 'me')" class="f_p_me">Mes</a>		<a onclick="tops_filter('posts', 5, 'hi')" class="f_p_hi active">Histórico</a>	</div>		<div class="box_body list_element top_posts">		<?php if (!$_smarty_tpl->tpl_vars['top_posts']->value) {?><div class="emptyData">No hay posts en este rango de tiempo</div><?php }?>		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['p']->key;
?>		<div class="list-element">			<span class="number-list"><?php echo $_smarty_tpl->tpl_vars['i']->value+1;?>
</span>			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['p']->value['p_title'],0,28);?>
</a>			<span class="value"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_puntos'];?>
</span>		</div>		<?php } ?>		<div class="box_more">			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/tops">Ver más</a>		</div>	</div></div><?php }} ?>
