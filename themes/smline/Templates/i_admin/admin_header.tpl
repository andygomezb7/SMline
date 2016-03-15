<!-- WWW.SMARTEC.NET - ADMIN -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>{$page.title}</title>
		<link rel="shortcut icon" href="{$web.img}/favicon.ico" type="image/x-icon">
		<link href="{$web.css}/global.css" rel="stylesheet" type="text/css">
		<link href="{$web.css}/user.css" rel="stylesheet" type="text/css">
		<script src="{$web.js}/jquery.min.js" type="text/javascript"></script>
		<script src="{$web.js}/jquery.js" type="text/javascript"></script>
		<script src="{$web.js}/global.js" type="text/javascript"></script>
		<script src="{$web.js}/moderar.js" type="text/javascript"></script>
		<link href="{$web.css}/admin.css" rel="stylesheet" type="text/css">
		{if $page.css|is_array}
			{foreach from=$page.css item=css}
				<link href="{$web.css}/{$css}.css" rel="stylesheet" type="text/css">
			{/foreach}
		{elseif $page.css}<link href="{$web.css}/{$page.css}.css" rel="stylesheet" type="text/css">{/if}
		<script src="{$web.js}/user.js" type="text/javascript"></script>
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
			title: '{$page.title}',
			avatar_update: '{$user->info.u_last_avatar}',
			sounds: '{$user->info.options.n_sounds}'
		{literal}
		};
		{/literal}
		</script>
		</head>
		<body>
		<div id="mask"></div>
		<div id="mydialog"></div>
		{include file='includes/menu.tpl'}
		<div id="wrapper">
			

		
