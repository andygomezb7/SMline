<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:23:41
         compiled from ".\themes\smline\Templates\i_mod\posts_aprobar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:295753f8c00de80f66-30180620%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8a721443f8fbd5050e45effe1073b9e68102e81c' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_mod\\posts_aprobar.tpl',
      1 => 1397570190,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '295753f8c00de80f66-30180620',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'posts_aprobar' => 0,
    'p' => 0,
    'web' => 0,
    'qu' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c00e04c424_18858345',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c00e04c424_18858345')) {function content_53f8c00e04c424_18858345($_smarty_tpl) {?>		<h2>Posts esperando aprobaci&oacute;n</h2>

		<p>No olvides eliminar los posts que no ser&aacute;n aprobados para removerlos de esta lista.</p>
		
		<br />
		
		<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="100%">
			<thead>
				<tr>
					<th>Cat.</th>
					<th>T&iacute;tulo</th>
					<th>Autor</th>
					<th>Fecha</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts_aprobar']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
						<a class="stip" title="Aprobar post" onclick="mod.approve('posts', <?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/power_on.png"></a>
						<a class="stip" title="Borrar post" onclick="mod.del('posts', <?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
);"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/delete_.png"></a>
						<a class="stip" title="Editar post" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/agregar-post?pid=<?php echo $_smarty_tpl->tpl_vars['p']->value['p_id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/editar.png"></a>
					</td>
				</tr>
				<?php } ?>
				<?php if (!$_smarty_tpl->tpl_vars['posts_aprobar']->value['list']) {?><tr><td colspan="6"><div id="error">No hay posts esperando aprobaci&oacute;n.</div></td></tr><?php }?>
				<tr>
					<td colspan="6">
						<form action="/mod" class="mod_buscar" name="search_u" method="get">
							<input type="text" class="input_text" name="qu" placeholder="Buscar posts..." value="<?php echo $_smarty_tpl->tpl_vars['qu']->value;?>
" autocomplete="off">
							<input type="hidden" name="do" value="posts_aprobar" />
							<a class="button_next" onclick="document.forms.search_u.submit()">Buscar</a>
						</form>
					</td>
				</tr>
			</tbody>
		</table>
		<?php if ($_smarty_tpl->tpl_vars['posts_aprobar']->value['list']) {?><?php echo $_smarty_tpl->tpl_vars['posts_aprobar']->value['pages'];?>
<?php }?>
			<?php }} ?>
