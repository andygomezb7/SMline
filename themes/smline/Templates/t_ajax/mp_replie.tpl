1: 
				<div id="mp-rpta-id-{$rp_data.0}" class="list-comment clearfix">
					<div class="floatL">
						<a href="{$web.url}/{$user->nick}">
							<img src="{$web.avatar}/{$user->uid}_50.jpg?{$user->info.u_last_avatar}" class="avatar-2"/>
						</a>
					</div>
					<div class="floatR c-body">
						<span class="dialog-comment"></span>
						<div class="comment-info">
							<a href="{$web.url}/{$user->nick}" class="hovercard" uid="{$user->uid}"><b>{$user->nick}</b></a>
							 <span class="stip" title="{$rp_data.2|date_format:"%d/%m/%Y %I:%M %p"}">Hace un instante</span>
						 </div>
						<div class="comment-body">{$rp_data.1}</div>
					</div>
				</div>