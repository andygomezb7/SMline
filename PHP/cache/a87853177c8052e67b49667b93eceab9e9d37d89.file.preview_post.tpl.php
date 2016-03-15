<?php /* Smarty version Smarty-3.1.15, created on 2014-08-22 16:17:26
         compiled from ".\themes\smline\Templates\t_ajax\preview_post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1417553f7b3666f7955-09626052%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a87853177c8052e67b49667b93eceab9e9d37d89' => 
    array (
      0 => '.\\themes\\smline\\Templates\\t_ajax\\preview_post.tpl',
      1 => 1394925320,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1417553f7b3666f7955-09626052',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'post_body' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f7b3667322e5_83563122',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f7b3667322e5_83563122')) {function content_53f7b3667322e5_83563122($_smarty_tpl) {?><div id="preview" style="font-size: 13px; line-height: 1.4em; width: 750px; overflow-y: auto; text-align: left;"><?php echo $_smarty_tpl->tpl_vars['post_body']->value;?>
</div>

<script type="text/javascript">
$(window).bind(
	'resize',
	function(){
		$('#preview').height((document.documentElement.clientHeight - 200) + 'px');
	}
);
$(window).trigger('resize');
</script>
<?php }} ?>
