<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:04
         compiled from ".\themes\smline\Templates\i_search\results.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1424053f7b4f48a45f0-51906096%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d0567cad9f11ec68dc4022697910a8fd93f0a94' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_search\\results.tpl',
      1 => 1398282208,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1424053f7b4f48a45f0-51906096',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    's_filtros' => 0,
    'q' => 0,
    'web' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b4f48fe392_17807783',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b4f48fe392_17807783')) {function content_53f7b4f48fe392_17807783($_smarty_tpl) {?><div class="box">
	<div class="box_title"><?php echo $_smarty_tpl->tpl_vars['s_filtros']->value['total'];?>
 resultados de "<h1><?php echo $_smarty_tpl->tpl_vars['q']->value;?>
</h1>"</div>
	<div class="box_body all_filters" style="position: relative;">
		
		<div class="list-header clearfix">
			<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['s_filtros']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
			<div class="thread clearfix">
				<a class="author-avatar" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
">
					<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['avatar'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_id'];?>
_32.jpg?<?php echo $_smarty_tpl->tpl_vars['p']->value['u_last_avatar'];?>
">
				</a>
				<div class="info">
					<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" class="topic-title">
						<?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>

					</a>
					<span>
						Por <a class="nick" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
</a> <?php echo hace($_smarty_tpl->tpl_vars['p']->value['p_date'],true);?>

					</span>
				</div>
				<div class="topic-stats">
					<div class="button-action-s">
						<i class="smarticon new_comment"></i>
						<div class="action-number">
							<span><?php echo $_smarty_tpl->tpl_vars['p']->value['p_comments'];?>
</span>
						</div>
					</div>
					<div class="button-action-s">
						<i class="smarticon vote"></i>
						<div class="action-number">
							<span><?php echo $_smarty_tpl->tpl_vars['p']->value['p_puntos'];?>
</span>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		
		<?php if ($_smarty_tpl->tpl_vars['s_filtros']->value['list']) {?><?php echo $_smarty_tpl->tpl_vars['s_filtros']->value['pages'];?>

		<?php } else { ?>
		<div id="error">No encontramos resultados relacionados con tu b&uacute;squeda :(</div>
		<?php }?>
	</div>
</div><?php }} ?>
