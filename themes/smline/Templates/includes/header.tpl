<!-- WWW.SMARTEC.NET - SCRIPT -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>{$page.title}</title>
		{if $page.meta.description}<meta content="{$page.meta.description}" name="description">
		{else}<meta content="{$web.descripcion}" name="description">{/if}
		{if $page.meta_tags}<meta content="{$page.meta_tags}" name="keywords">
		{else}<meta content="{$web.tags}" name="keywords">{/if}
		{if $page.meta.title}<meta content="{$page.meta.title}" name="title">{/if}
		{foreach from=$page.meta_dc item=val key=name}
		<meta property="dc:{$name}" content="{$val}">
		{/foreach}
		{foreach from=$page.meta item=val key=name}
		<meta property="og:{$name}" content="{$val}">
		{/foreach}
		<link rel="shortcut icon" href="{$web.img}/favicon.ico" type="image/x-icon">
		<link href="{$web.css}/global.css" rel="stylesheet" type="text/css">
		{if !$user->uid}<link href="{$web.css}/anonimo.css" rel="stylesheet" type="text/css">
		{else}<link href="{$web.css}/user.css" rel="stylesheet" type="text/css">{/if}
		<script src="{$web.js}/jquery.min.js" type="text/javascript"></script>
		<script src="{$web.js}/jquery.js" type="text/javascript"></script>
		<script src="{$web.js}/global.js" type="text/javascript"></script>
		{if $user->permits['gomod'] || $user->permits['goadmin']}<script src="{$web.js}/moderar.js" type="text/javascript"></script>
		<link href="{$web.css}/admin.css" rel="stylesheet" type="text/css">{/if}
		{if $page.css|is_array}
			{foreach from=$page.css item=css}
				<link href="{$web.css}/{$css}.css" rel="stylesheet" type="text/css">
			{/foreach}
		{elseif $page.css}<link href="{$web.css}/{$page.css}.css" rel="stylesheet" type="text/css">{/if}
		{if !$user->uid}<script src="{$web.js}/anonimo.js" type="text/javascript"></script>
		{else}<script src="{$web.js}/user.js" type="text/javascript"></script>
		{/if}
		{if $page.js|is_array}
			{foreach from=$page.js item=js}
				<script src="{$web.js}/{$js}.js" type="text/javascript"></script>
			{/foreach}
		{elseif $page.js}<script src="{$web.js}/{$page.js}.js" type="text/javascript"></script>{/if}
		<script type="text/javascript">
		{literal}
		var global_data = {
		{/literal}
			theme: '{$web.theme}',
			site_title: '{$web.title}',
			live_timeout: '{$web.live_timeout}000',
			nots: '{$user->notis}',
			mps: '{$user->mps}',
			user_key:'{$user->uid}',
			user_nick:'{$user->nick}',
			post_id:'{$post.p_id}',
			img_id:'{$image.i_id}',
			topic_id:'{$topic.t_id}',
			img:'{$web.img}',
			url:'{$web.url}',
			title: '{$page.title|html_entity_decode}',
			avatar_update: '{$user->info.u_last_avatar}',
			sounds: '{$user->info.options.n_sounds}',
		{literal}
		};
		{/literal}
		</script>
		{if $web.live && $user->uid}<script src="{$web.js}/live.js" type="text/javascript"></script>
		<link href="{$web.css}/live.css" rel="stylesheet" type="text/css">{/if}
		</head>
		<body>
		<div id="sounds"></div>
		<div id="mask"></div>
		<div id="mydialog"></div>
		{include file='includes/menu.tpl'}
		<div id="header">
			<div id="wrapper">
				<a href="{$web.url}/" id="logo" title="{$web.slogan}"></a>
				<form class="search" action="/buscar" name="search" method="get">
					<input type="text" class="inp_text" name="q" placeholder="Buscar algo..." value="{$q}">
					<input type="button" onclick="searched();" class="search_button">
				</form>
			</div>
		</div>
		{include file='includes/sub-menu.tpl'}
		<div id="wrapper">
			<div id="content" class="clearfix">
