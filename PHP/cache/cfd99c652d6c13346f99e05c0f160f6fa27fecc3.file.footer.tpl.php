<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 15:59:58
         compiled from ".\themes\smline\Templates\includes\footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2310153f7af4e9ce690-34913108%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cfd99c652d6c13346f99e05c0f160f6fa27fecc3' => 
    array (
      0 => '.\\themes\\smline\\Templates\\includes\\footer.tpl',
      1 => 1397667427,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2310153f7af4e9ce690-34913108',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7af4e9edaa0_95733283',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7af4e9edaa0_95733283')) {function content_53f7af4e9edaa0_95733283($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\xampp\\htdocs\\PHP\\libs\\plugins\\modifier.date_format.php';
?>			</div>
		</div>
		<div id="menu_3">
			<div id="wrapper">
				<div class="floatL">
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/ayuda">Ayuda</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/protocolo">Protocolo</a></li>
					<li><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/terminos-y-condiciones">T&eacute;rminos y condiciones</a></li>
				</div>
				<div class="floatR">
					<span><a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/"><?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
</a> &copy; <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['web']->value['time'],"%Y");?>
 - Software by <a href="http://smline.net/">SMLine</a></span>
				</div>
			</div>
		</div>
		<div class="notification-board right bottom"></div>
	</body>
</html><?php }} ?>
