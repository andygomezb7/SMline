<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:04
         compiled from ".\themes\smline\Templates\i_search\filter.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3088353f7b4f47aa5c6-42461914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6c60c8c06aa90cbdd0488962fcf1f022fc74dbb' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_search\\filter.tpl',
      1 => 1398283417,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3088353f7b4f47aa5c6-42461914',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    's_data' => 0,
    'web' => 0,
    'cats' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b4f48757f3_12545833',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b4f48757f3_12545833')) {function content_53f7b4f48757f3_12545833($_smarty_tpl) {?><div class="box">
	<div class="box_title">Filtrar posts</div>
	<div class="box_body all_filters" style="position: relative;">
		<span class="fil_tit">Ordenar por...</span>
		<div class="fil_list list_order_search">
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['order']=='') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=">Relevancia</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['order']=='puntos') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=puntos">Puntos</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['order']=='fecha') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=fecha">Fecha</a>
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Filtrar por...</span>
		<div class="fil_list list_as_search">
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['as']=='') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
">Títulos</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['as']=='body') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=body&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
">Contenidos</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['s_data']->value['as']=='tags') {?> active<?php }?>">
				<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=tags&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
">Tags</a>
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Por autor...</span>
		<div class="fil_list">
			<li class="list_fil active">
				<input type="text" class="inp_text" name="by_author" value="<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
" placeholder="Ingresa el usuario">
				<input type="button" class="button_1 b_ok" value="Ir &#187;" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['cat'];?>
&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author='+$('input[name=by_author]').val()+'&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
'" style="width: auto;float: right;">
			</li>
		</div>
		
		<hr />
		
		<span class="fil_tit">Categorias</span>
		<div class="fil_list">
			<li class="list_fil active">
				<select class="inp_text" onchange="location.href='<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/buscar?q=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['q'];?>
&cat='+$(this).val()+'&as=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['as'];?>
&author=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['author'];?>
&order=<?php echo $_smarty_tpl->tpl_vars['s_data']->value['order'];?>
'">
				<option selected="selected" value="">Seleccionar categoría</option>
				<option value="0">Todas las categorías</option>
				<optgroup label="-"></optgroup>
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['s_data']->value['cat']==$_smarty_tpl->tpl_vars['c']->value['c_id']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>
				<?php } ?>
			</select>
			</li>
		</div>
		
	</div>
</div><?php }} ?>
