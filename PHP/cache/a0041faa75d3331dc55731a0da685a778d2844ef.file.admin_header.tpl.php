<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:24:21
         compiled from ".\themes\smline\Templates\i_admin\admin_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3173453f7b505930e66-13711717%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a0041faa75d3331dc55731a0da685a778d2844ef' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_admin\\admin_header.tpl',
      1 => 1401031147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3173453f7b505930e66-13711717',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page' => 0,
    'web' => 0,
    'css' => 0,
    'js' => 0,
    'user' => 0,
    'post' => 0,
    'image' => 0,
    'topic' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b5059c5582_55736046',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b5059c5582_55736046')) {function content_53f7b5059c5582_55736046($_smarty_tpl) {?><!-- WWW.SMARTEC.NET - ADMIN -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
</title>
		<link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
/favicon.ico" type="image/x-icon">
		<link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/global.css" rel="stylesheet" type="text/css">
		<link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/user.css" rel="stylesheet" type="text/css">
		<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/jquery.js" type="text/javascript"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/global.js" type="text/javascript"></script>
		<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/moderar.js" type="text/javascript"></script>
		<link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/admin.css" rel="stylesheet" type="text/css">
		<?php if (is_array($_smarty_tpl->tpl_vars['page']->value['css'])) {?>
			<?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['css']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['css']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value) {
$_smarty_tpl->tpl_vars['css']->_loop = true;
?>
				<link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
.css" rel="stylesheet" type="text/css">
			<?php } ?>
		<?php } elseif ($_smarty_tpl->tpl_vars['page']->value['css']) {?><link href="<?php echo $_smarty_tpl->tpl_vars['web']->value['css'];?>
/<?php echo $_smarty_tpl->tpl_vars['page']->value['css'];?>
.css" rel="stylesheet" type="text/css"><?php }?>
		<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/user.js" type="text/javascript"></script>
		<?php if (is_array($_smarty_tpl->tpl_vars['page']->value['js'])) {?>
			<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['js']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['page']->value['js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value) {
$_smarty_tpl->tpl_vars['js']->_loop = true;
?>
				<script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
.js" type="text/javascript"></script>
			<?php } ?>
		<?php } elseif ($_smarty_tpl->tpl_vars['page']->value['js']) {?><script src="<?php echo $_smarty_tpl->tpl_vars['web']->value['js'];?>
/<?php echo $_smarty_tpl->tpl_vars['page']->value['js'];?>
.js" type="text/javascript"></script><?php }?>
		<script type="text/javascript">
		
		var global_data = {
		
			theme: '<?php echo $_smarty_tpl->tpl_vars['web']->value['theme'];?>
',
			site_title: '<?php echo $_smarty_tpl->tpl_vars['web']->value['title'];?>
',
			live_timeout: '<?php echo $_smarty_tpl->tpl_vars['web']->value['live_timeout'];?>
000',
			nots: '<?php echo $_smarty_tpl->tpl_vars['user']->value->notis;?>
',
			mps: '<?php echo $_smarty_tpl->tpl_vars['user']->value->mps;?>
',
			user_key:'<?php echo $_smarty_tpl->tpl_vars['user']->value->uid;?>
',
			user_nick:'<?php echo $_smarty_tpl->tpl_vars['user']->value->nick;?>
',
			post_id:'<?php echo $_smarty_tpl->tpl_vars['post']->value['p_id'];?>
',
			img_id:'<?php echo $_smarty_tpl->tpl_vars['image']->value['i_id'];?>
',
			topic_id:'<?php echo $_smarty_tpl->tpl_vars['topic']->value['t_id'];?>
',
			img:'<?php echo $_smarty_tpl->tpl_vars['web']->value['img'];?>
',
			url:'<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
',
			title: '<?php echo $_smarty_tpl->tpl_vars['page']->value['title'];?>
',
			avatar_update: '<?php echo $_smarty_tpl->tpl_vars['user']->value->info['u_last_avatar'];?>
',
			sounds: '<?php echo $_smarty_tpl->tpl_vars['user']->value->info['options']['n_sounds'];?>
'
		
		};
		
		</script>
		</head>
		<body>
		<div id="mask"></div>
		<div id="mydialog"></div>
		<?php echo $_smarty_tpl->getSubTemplate ('includes/menu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div id="wrapper">
			

		
<?php }} ?>
