<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\recent_comus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:482453f8c031b06848-28453433%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5bf6bb5e4effae413be614bf1a9798791bc1ae9d' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\recent_comus.tpl',
      1 => 1398819481,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '482453f8c031b06848-28453433',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'recent_comus' => 0,
    'web' => 0,
    'c' => 0,
    'c_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031b4cd59_09360478',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031b4cd59_09360478')) {function content_53f8c031b4cd59_09360478($_smarty_tpl) {?><div class="box margin-top-5">
	<div class="box_title">Comunidades recientes</div>
	<div class="box_body list_element">
		<?php if (!$_smarty_tpl->tpl_vars['recent_comus']->value) {?><div class="emptyData">No hay comunidades nuevas</div><?php }?>
		<?php  $_smarty_tpl->tpl_vars['c'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['c']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['recent_comus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
?>
		<div class="list-element">
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['c']->value['comu_seo'];?>
/"><?php echo $_smarty_tpl->tpl_vars['c']->value['comu_name'];?>
</a>
		</div>
		<?php } ?>
		<div class="box_more">
			<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/crear">Crea la tuya</a>
		</div>
	</div>
</div>
<?php echo $_smarty_tpl->tpl_vars['c_action']->value;?>
<?php }} ?>
