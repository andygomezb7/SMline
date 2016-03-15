<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:44
         compiled from ".\themes\smline\Templates\i_mod\posts_eliminados.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2420853f8c010c08c88-63161001%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f5f94c6a5eb045a7acebf913e1882f4f02741fcb' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_mod\\posts_eliminados.tpl',
      1 => 1397610283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2420853f8c010c08c88-63161001',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'posts_eliminados' => 0,
    'p' => 0,
    'web' => 0,
    'qu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c010ceb5c2_08623227',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c010ceb5c2_08623227')) {function content_53f8c010ceb5c2_08623227($_smarty_tpl) {?>		<h2>Posts eliminados</h2>
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Cat.</th>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Publicado</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts_eliminados']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
?>
				<tr id="post-<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
">
					<td>
						<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/cats/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_img'];?>
" class="stip" title="<?php echo $_smarty_tpl->tpl_vars['p']->value['c_name'];?>
"/>
					</td>
					<td>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/posts/<?php echo $_smarty_tpl->tpl_vars['p']->value['c_seo'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
/<?php echo seo($_smarty_tpl->tpl_vars['p']->value['p_title']);?>
.html" target="_blank"><?php echo $_smarty_tpl->tpl_vars['p']->value['p_title'];?>
</a>
					</td>
					<td>
						<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/<?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
"><?php echo $_smarty_tpl->tpl_vars['p']->value['u_nick'];?>
</a>
					</td>
					<td><?php echo hace($_smarty_tpl->tpl_vars['p']->value['p_date']);?>
</td>
					<td class="admin_actions">
						<a class="stip" title="Reactivar post" onclick="mod.reac('posts', <?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/ok.png"></a>
						<a class="stip" title="Pasarlo a revisi&oacute;n" onclick="mod.revise('posts', <?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/reply.png"></a>
						<a class="stip" title="Editar post" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/agregar-post?pid=<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/editar.png"></a>
					</td>
				</tr>
				<?php } ?>
				<?php if (!$_smarty_tpl->tpl_vars['posts_eliminados']->value['list']) {?><tr><td colspan="6"><div id="error">No hay posts eliminados.</div></td></tr><?php }?>
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar posts..." value="<?php echo $_smarty_tpl->tpl_vars['qu']->value;?>
" autocomplete="off">
							<input type="hidden" name="do" value="posts_eliminados" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		<?php if ($_smarty_tpl->tpl_vars['posts_eliminados']->value['list']) {?><?php echo $_smarty_tpl->tpl_vars['posts_eliminados']->value['pages'];?>
<?php }?>
			<?php }} ?>
