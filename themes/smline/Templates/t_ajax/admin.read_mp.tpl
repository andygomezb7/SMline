1: 
	<div class="box readMessage" style="width: 725px;max-height: 630px;">
		
		<div class="box_body" style="position: relative;">
		
			<h1 class="post_title mpSubject">{$data_mp.mp_subject}</h1>
			
			<div class="rps-list">
				{foreach from=$data_mp.replies item=r}
				<div id="mp-rpta-id-{$r.rp_id}" class="list-comment clearfix">
					<div class="floatL">
						<a href="{$web.url}/{$r.u_nick}"><img src="{$web.avatar}/{$r.rp_user}_50.jpg?{$r.u_last_avatar}" class="avatar-2"/></a>
					</div>
					<div class="floatR c-body">
						<span class="dialog-comment"></span>
						<div class="comment-info">
							<a href="{$web.url}/{$r.u_nick}" class="hovercard" uid="{$r.rp_user}"><b>{$r.u_nick}</b></a>
							 <span class="stip" title="{$r.rp_date|date_format:"%d/%m/%Y %I:%M %p"}">{$r.rp_date|hace}</span>
						 </div>
						<div class="comment-body">{$r.rp_body}</div>
					</div>
				</div>
				{/foreach}
			</div>
			
		</div>
	</div>