<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\reco_comu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1666253f8c031c71d19-36002203%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89798619a84f212eaf450fc25e59f07d9ed0114e' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\reco_comu.tpl',
      1 => 1396136809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1666253f8c031c71d19-36002203',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'popular_comu' => 0,
    'web' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031cd37b6_43028435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031cd37b6_43028435')) {function content_53f8c031cd37b6_43028435($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['popular_comu']->value['comu_id']) {?>
<div class="box margin-top-5">
	<div class="box_title">Comunidad destacada</div>
	<div class="box_body list_element">
		<center>
		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_seo'];?>
/">
			<img class="big-avatar" src="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/thumbs/comus/t_<?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_id'];?>
.jpg?<?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_last_image'];?>
" alt="Ir a la comunidad" title="Ir a la comunidad <?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_name'];?>
">
		</a>

		<a href="<?php echo $_smarty_tpl->tpl_vars['web']->value['url'];?>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_seo'];?>
/" class="popular-comu-a"><?php echo $_smarty_tpl->tpl_vars['popular_comu']->value['comu_name'];?>
</a>

		</center>
	</div>
</div>
<?php }?><?php }} ?>
