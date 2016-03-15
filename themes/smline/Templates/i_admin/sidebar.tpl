<ul class="smartec_menu">
	<li class="asm_home{if $do == ''} active{/if}">
		<a href="{$web.url}/admin">Inicio</a>
	</li>
	{if $user->permits.ecds}
	<li class="asm_settings{if $do == 'settings'} active{/if}">
		<a href="{$web.url}/admin?do=settings">Configuraciones</a>
	</li>
	{/if}
	{if $user->permits.etds}
	<li class="asm_themes{if $do == 'themes'} active{/if}">
		<a href="{$web.url}/admin?do=themes">Temas</a>
	</li>
	{/if}
	{if $user->permits.aebn}
	<li class="asm_news{if $do == 'news'} active{/if}">
		<a href="{$web.url}/admin?do=news">Noticias</a>
	</li>
	{/if}
	{if $user->permits.ebp}
	<li class="asm_ads{if $do == 'ads'} active{/if}">
		<a href="{$web.url}/admin?do=ads">Banners</a>
	</li>
	{/if}
	{if $user->permits.aebli}
	<li class="asm_links{if $do == 'links'} active{/if}">
		<a href="{$web.url}/admin?do=links">Links de interés</a>
	</li>
	{/if}
	{if $user->permits.aeu}
	<li class="asm_users{if $do == 'users'} active{/if}">
		<a href="{$web.url}/admin?do=users">Usuarios</a>
	</li>
	{/if}
	{if $user->permits.aebc}
	<li class="asm_cats{if $do == 'cats'} active{/if}">
		<a href="{$web.url}/admin?do=cats">Categorias</a>
	</li>
	{/if}
	{if $user->permits.aebm}
	<li class="asm_medals{if $do == 'medals'} active{/if}">
		<a href="{$web.url}/admin?do=medals">Medallas</a>
	</li>
	{/if}
	{if $user->permits.aebr}
	<li class="asm_ranks{if $do == 'ranks'} active{/if}">
		<a href="{$web.url}/admin?do=ranks">Rangos</a>
	</li>
	{/if}
	{if $user->permits.abpc}
	<li class="asm_censored{if $do == 'censored'} active{/if}">
		<a href="{$web.url}/admin?do=censored">Censuras</a>
	</li>
	{/if}
	{if $user->permits.abib}
	<li class="asm_blocked{if $do == 'blocked'} active{/if}">
		<a href="{$web.url}/admin?do=blocked">Bloqueos</a>
	</li>
	{/if}
	{if $user->permits.acm}
	<li class="asm_mps{if $do == 'mps'} active{/if}">
		<a href="{$web.url}/admin?do=mps">Mensajes</a>
	</li>
	{/if}
	{if $user->permits.acp}
	<li class="asm_posts{if $do == 'posts'} active{/if}">
		<a href="{$web.url}/admin?do=posts">Posts</a>
	</li>
	{/if}
	{if $user->permits.acf}
	<li class="asm_gallery{if $do == 'gallery'} active{/if}">
		<a href="{$web.url}/admin?do=gallery">Imágenes</a>
	</li>
	{/if}
	{if $user->permits.as}
	<li class="asm_stats{if $do == 'stats'} active{/if}">
		<a href="{$web.url}/admin?do=stats">Estadísticas</a>
	</li>
	{/if}
</ul>