
	<div class="breadcrump clearfix">
		<li class="first"><a href="{$web.url}/mensajes">Mensajes</a></li>
		<li>Redactar</li>
		<li class="last"></li>
	</div>
	<div class="box">
		<div class="box_title">Redactar mensaje</div>
		<div class="box_body" style="position: relative;">
			
			<div id="error" class="newmp_error" style="display:none"></div>
			
			<ul class="clearfix write_mp">
				<li class="list_item">
					<label for="mp_to">Para</label>
					<input type="text" tabindex="1" id="mp_to" class="inp_text " name="mp_to" value="{$mp_to}" autocomplete="off">
				</li>
				
				<li class="list_item">
					<label for="mp_subject">Asunto</label>
					<input type="text" tabindex="2" id="mp_subject" class="inp_text" name="mp_subject" placeholder="(Sin asunto)" value="" autocomplete="off">
				</li>
				
				<li class="list_item mp_body">
					<label for="mp_body">Mensaje</label>
					<textarea tabindex="3" id="mp_body" class="inp_text" name="mp_body" autocomplete="off"></textarea>
				</li>
				
				{if $user->permits.cm}
				<li class="list_item mp_body">
					<script type="text/javascript">
						{literal}
						$.getScript("http://www.google.com/recaptcha/api/js/recaptcha_ajax.js", function(){
							Recaptcha.create('6LdHQvASAAAAAMvSKMC43DPFdr1fBTf3oKtPrUwq', 'recaptcha_ajax', {
								theme:'custom', lang:'es', tabindex:'13', custom_theme_widget: 'recaptcha_ajax',
								callback: function(){
									
								}
							});
						});
						{/literal}
					</script>
					
					<label for="recaptcha_response_field">Código de la imagen <a onclick="Recaptcha.reload();" class="stip" title="Cambiar imagen"><img src="{$web.img}/icons/reboot.png" width="12px" height="12px" /></a></label>
					<div id="recaptcha_image"></div>
					<input type="text" tabindex="4" id="recaptcha_response_field" class="inp_text" name="recaptcha_response_field" value="" style="margin-left: 125px;">
				</li>
				{/if}
			</ul>
			
			<hr />
			<center>
				<input type="button" class="button_1 b_ok" value="Enviar mensaje" onclick="mps.send($(this));"/>
			</center>
			
		</div>
	</div>
