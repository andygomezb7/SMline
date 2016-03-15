<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:25:35
         compiled from ".\themes\smline\Templates\i_profile\side_medals.tpl" */ ?>
<?php /*%%SmartyHeaderCode:439853f7b54f159e14-49268102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e8b09262f1765d148e1c34530814ce4ac7ca0232' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_profile\\side_medals.tpl',
      1 => 1398879902,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '439853f7b54f159e14-49268102',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'u_info' => 0,
    'list_medals' => 0,
    'web' => 0,
    'm' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b54f17d0a8_16322855',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b54f17d0a8_16322855')) {function content_53f7b54f17d0a8_16322855($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['u_info']->value['u_medals']) {?>
<div class="box box_autor margin-top-5">
	<div class="box_title">Medallas<span class="title_right_info"><?php echo $_smarty_tpl->tpl_vars['u_info']->value['u_medals'];?>
</span></div>
	<div class="box_body">
		<div class="profile_side_lists clearfix">
			<?php  $_smarty_tpl->tpl_vars['m'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['m']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list_medals']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['m']->key => $_smarty_tpl->tpl_vars['m']->value) {
$_smarty_tpl->tpl_vars['m']->_loop = true;
?>
				<img src="<?php echo $_smarty_tpl->tpl_vars['web']->value['icons'];?>
/medals/<?php echo $_smarty_tpl->tpl_vars['m']->value['m_image'];?>
" class="stip" title="<?php echo $_smarty_tpl->tpl_vars['m']->value['m_title'];?>
" />
			<?php } ?>
		</div>
		<div class="box_more">
			<a href="#medallas" onclick="profile.load_tab('medals');">Ver más</a>
		</div>
	</div>
</div>
<?php }?><?php }} ?>
