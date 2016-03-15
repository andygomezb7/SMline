{include file='includes/header.tpl'}

<div id="main-col" style="margin-right:5px;">

{if $m_action == 'redactar' || $m_action == 'write'}
	{include file='i_mensajes/write.tpl'}
{elseif $m_action == 'read'}
	{include file='i_mensajes/read.tpl'}
{else}
	{include file='i_mensajes/home_content.tpl'}
{/if}

</div>

<div id="sidebar">
	{include file='i_mensajes/general_sidebar.tpl'}
</div>

{include file='includes/footer.tpl'}