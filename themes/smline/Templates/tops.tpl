{include file='includes/header.tpl'}


<div id="main-col" style="width: 725px;">
{if $t_action == 'usuarios'}
	{include file='i_tops/top_users.tpl'}
{elseif $t_action == 'comunidades'}
	{include file='i_tops/top_comus.tpl'}
{else}
	{include file='i_tops/top_posts.tpl'}
{/if}
</div>

<div class="home_right">
	{include file='i_tops/sidebar.tpl'}
</div>

{include file='includes/footer.tpl'}