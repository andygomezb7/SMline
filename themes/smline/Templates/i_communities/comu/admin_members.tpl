<script>
var comu_id = {$comu.comu_id};
{literal}
$(document).ready(function(){
	admin_comu.load_members(comu_id, 'members', 1, 0)
});
{/literal}
</script>
<div class="filterBy clearfix">
	<div class="floatL">
		<input class="inp_text floatL" name="search" style="margin-right:10px;width: 220px;" type="text" value="">
		<a onclick="admin_comu.load_members({$comu.comu_id}, 'members', 1, 1)" class="button_3 floatL" role="button">Buscar</a>
	</div>
	<ul class="floatR">
		<li id="button_members" class="here" style="padding: 6px;"><a onclick="admin_comu.load_members({$comu.comu_id}, 'members', 1, 0)">Miembros</a></li>
		<li id="button_bans" class="" style="padding: 6px;"><a onclick="admin_comu.load_members({$comu.comu_id}, 'bans', 1, 0)">Suspendidos</a></li>
	</ul>
	<div style="clear:both"></div>
</div>

<div id="showResult" class="list">
	<center class="loading_members"><img src="/content/css/img/loading.gif"></center>
</div>