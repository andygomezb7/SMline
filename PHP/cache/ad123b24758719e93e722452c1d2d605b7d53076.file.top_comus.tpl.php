<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\i_communities\home\top_comus.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2399553f8c031a4b017-02740997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad123b24758719e93e722452c1d2d605b7d53076' => 
    array (
      0 => '.\\themes\\smline\\Templates\\i_communities\\home\\top_comus.tpl',
      1 => 1398819396,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2399553f8c031a4b017-02740997',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'top_comus' => 0,
    'i' => 0,
    'web' => 0,
    'c' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031aacab2_88368551',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031aacab2_88368551')) {function content_53f8c031aacab2_88368551($_smarty_tpl) {?><div class="box margin-top-5">
 $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['top_comus']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['c']->key => $_smarty_tpl->tpl_vars['c']->value) {
$_smarty_tpl->tpl_vars['c']->_loop = true;
 $_smarty_tpl->tpl_vars['i']->value = $_smarty_tpl->tpl_vars['c']->key;
?>
</span>
/comunidades/<?php echo $_smarty_tpl->tpl_vars['c']->value['comu_seo'];?>
/" title="<?php echo $_smarty_tpl->tpl_vars['c']->value['comu_name'];?>
"><?php echo substr($_smarty_tpl->tpl_vars['c']->value['comu_name'],0,28);?>
</a>
</span>
/tops/comunidades">Ver más</a>