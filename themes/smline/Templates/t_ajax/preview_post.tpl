<div id="preview" style="font-size: 13px; line-height: 1.4em; width: 750px; overflow-y: auto; text-align: left;">{$post_body}</div>
{literal}
<script type="text/javascript">
$(window).bind(
	'resize',
	function(){
		$('#preview').height((document.documentElement.clientHeight - 200) + 'px');
	}
);
$(window).trigger('resize');
</script>
{/literal}