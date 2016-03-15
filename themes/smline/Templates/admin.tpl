
{include file='i_admin/admin_header.tpl'}

<div id="content" class="clearfix" style="padding: 0;border: 0;background: transparent;width: 1000px;">

<div id="sidebar" style="width: 200px;">
	{include file='i_admin/sidebar.tpl'}
</div>

<div id="main-col" class="admin-main" style="width: 798px;">
	{if $do == 'settings'}{include file='i_admin/settings.tpl'}
	{elseif $do == 'themes'}{include file='i_admin/themes.tpl'}
	{elseif $do == 'news'}{include file='i_admin/news.tpl'}
	{elseif $do == 'ads'}{include file='i_admin/ads.tpl'}
	{elseif $do == 'censored'}{include file='i_admin/censored.tpl'}
	{elseif $do == 'links'}{include file='i_admin/links.tpl'}
	{elseif $do == 'posts'}{include file='i_admin/posts.tpl'}
	{elseif $do == 'cats'}{include file='i_admin/cats.tpl'}
	{elseif $do == 'medals'}{include file='i_admin/medals.tpl'}
	{elseif $do == 'ranks'}{include file='i_admin/ranks.tpl'}
	{elseif $do == 'users'}{include file='i_admin/users.tpl'}
	{elseif $do == 'blocked'}{include file='i_admin/blocked.tpl'}
	{elseif $do == 'mps'}{include file='i_admin/mps.tpl'}
	{elseif $do == 'gallery'}{include file='i_admin/gallery.tpl'}
	{elseif $do == 'stats'}{include file='i_admin/stats.tpl'}
	{else}{include file='i_admin/main_home.tpl'}{/if}
	{include file='includes/admin_footer.tpl'}
</div>

</div>
</div>
<div class="notification-board right bottom"></div>
</body>
</html>