<?php /* Smarty version Smarty-3.1.15, created on 2014-08-23 11:24:17
         compiled from ".\themes\smline\Templates\communities.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3036753f8c0317590e5-25827989%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c0c9f8d402670d654c43eb7605c49306bfbe0e4' => 
    array (
      0 => '.\\themes\\smline\\Templates\\communities.tpl',
      1 => 1398894006,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3036753f8c0317590e5-25827989',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'c_action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.15',
  'unifunc' => 'content_53f8c031837ba3_68997502',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53f8c031837ba3_68997502')) {function content_53f8c031837ba3_68997502($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('includes/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php if ($_smarty_tpl->tpl_vars['c_action']->value=='crear') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/crear.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='edit-comu') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/editar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='view-comu') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/breadcrump.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<div id="sidebar">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/search.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/staff.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/last_members.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/last_comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/popular_topics.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div id="main-col" style="margin-left:5px;">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/topics.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div><?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='add-topic') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/add-topic.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='edit-topic') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/edit-topic.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='view-topic') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/breadcrump.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	<div id="sidebar">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/author.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div id="main-col" style="margin-left:5px;">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/comu_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/content.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/related.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<div class="publi-right">		<?php echo $_smarty_tpl->getSubTemplate ('i_banners/300.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		</div>		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/topic/comments.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div><?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='admin-members') {?>		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/admin_members_bread.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<div id="sidebar">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/last_members.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div id="main-col" style="margin-left:5px;">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/comu/admin_members.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='mis-comunidades') {?>	<div id="main-col" style="margin-right:5px;">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/mis_comus_main.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div id="sidebar">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/mis_comus_sidebar.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div><?php } elseif ($_smarty_tpl->tpl_vars['c_action']->value=='historial') {?>	<?php echo $_smarty_tpl->getSubTemplate ('i_communities/historial.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php } else { ?>	<div class="home_left">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/last_topics.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div class="home_center">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/stats.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/last_replies.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/top_comus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/recent_comus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div>	<div class="home_right">		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/alert_comus.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_communities/home/reco_comu.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
		<?php echo $_smarty_tpl->getSubTemplate ('i_banners/160.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
	</div><?php }?><?php echo $_smarty_tpl->getSubTemplate ('includes/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
