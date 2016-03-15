{include file='includes/header.tpl'}

<div id="alertmsg">
	<h1>{$error.0}</h1>
	<p>{$error.1}</p>
	<input type="button" class="button_1" value="{$error.2}" title="ir a pagina principal" onclick="location.href='{$error.3}'" role="button" aria-disabled="false">
</div>

{include file='includes/footer.tpl'}