<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:02
         compiled from ".\themes\smline\Templates\i_tops\sidebar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3256153f8c022dc2543-55659587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7bbec619f79ac78778d1f5bc27a14da63c9e658d' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_tops\\sidebar.tpl',
      1 => 1397092587,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3256153f8c022dc2543-55659587',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'filter' => 0,
    't_action' => 0,
    'cats' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c022e85a70_11897929',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c022e85a70_11897929')) {function content_53f8c022e85a70_11897929($_smarty_tpl) {?><div class="box">
	<div class="box_title">Filtrar tops</div>
	<div class="box_body all_filters" style="position: relative;">
		
		<span class="fil_tit">Periodo...</span>
		<div class="fil_list list_order_search">
			<li class="list_fil<?php if (!$_smarty_tpl->tpl_vars['filter']->value['date']||$_smarty_tpl->tpl_vars['filter']->value['date']==5) {?> active<?php }?>">
				<a href="?date=0&cat=<?php echo $_smarty_tpl->tpl_vars['filter']->value['cat'];?>
">Hist&oacute;rico</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['filter']->value['date']==1) {?> active<?php }?>">
				<a href="?date=1&cat=<?php echo $_smarty_tpl->tpl_vars['filter']->value['cat'];?>
">Hoy</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['filter']->value['date']==2) {?> active<?php }?>">
				<a href="?date=2&cat=<?php echo $_smarty_tpl->tpl_vars['filter']->value['cat'];?>
">Ayer</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['filter']->value['date']==3) {?> active<?php }?>">
				<a href="?date=3&cat=<?php echo $_smarty_tpl->tpl_vars['filter']->value['cat'];?>
">&Uacute;ltima semana</a>
			</li>
			<li class="list_fil<?php if ($_smarty_tpl->tpl_vars['filter']->value['date']==4) {?> active<?php }?>">
				<a href="?date=4&cat=<?php echo $_smarty_tpl->tpl_vars['filter']->value['cat'];?>
">&Uacute;ltimo mes</a>
			</li>
		</div>
		
		<?php if ($_smarty_tpl->tpl_vars['t_action']->value!='usuarios') {?>
		
		<hr />
		
		<span class="fil_tit">Categor&iacute;as</span>
		<div class="fil_list">
			<li class="list_fil active">
				<select class="inp_text" onchange="location.href='?date=<?php echo $_smarty_tpl->tpl_vars['filter']->value['date'];?>
&cat='+$(this).val();">
				<option selected="selected" value="">Seleccionar categor&iacute;a</option>
				<option value="0">Todas las categor&iacute;as</option>
				<optgroup label="-"></optgroup>
				<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cats']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
				<option value="<?php echo $_smarty_tpl->tpl_vars['c']->value['c_id'];?>
"<?php if ($_smarty_tpl->tpl_vars['filter']->value['cat']==$_smarty_tpl->tpl_vars['c']->value['c_id']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['c']->value['c_name'];?>
</option>
				<?php } ?>
			</select>
			</li>
		</div>
		
		<?php }?>
		
	</div>
</div><?php }} ?>
