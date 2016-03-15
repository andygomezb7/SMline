{include file='includes/header.tpl'}

<div id="main-col">
	<div id="full-col">
		<div class="ct-data">
			<div class="title clearfix">
				<h2>Ayuda</h2>
			</div>
			<p>{$web.title} es un sitio web donde nuestra prioridad es el compartimiento de enlaces con contenido descargable y libre, estos enlaces los podemos encontrar en dos distintas secciones: en los posts y en las comunidades, en las cuales es muy sencillo interactual, ya sea comentando y calificando contenidos de parte de los usuarios y para los usuarios.</p>

			<ul class="anchor-list">
				<li><a href="#como-registrarse">1. ¿Cómo registrarse?</a></li>
				<li><a href="#como-acceder-a-mi-cuenta">2. ¿Cómo acceder a mi cuenta?</a></li>
				<li><a href="#como-publicar-o-compartir-algo">3. ¿Cómo publicar o compartir algo?</a></li>
			</ul>

			<a name="como-registrarse" class="anchor"></a>
			<h3>1. Cómo registrarse:</h3>
			<p>Para tener acceso a todas las funciones, secciones y privilegios de la comunidad, será necesario que cree una cuenta de usuario, cosa que le tomará unos minutos. Solo tiene que hacer clic en el botón "Crear cuenta" que se encuentra en la parte superior derecha de la pantalla e ingresar los datos que le pide el formulario y hacer clic en "Registrarme". Posteriormente recibirá un correo con el último paso para activar su cuenta.</p>
			
			<a name="como-acceder-a-mi-cuenta" class="anchor"></a>
			<h3>2. Cómo acceder a mi cuenta:</h3>
			<p>Si ya tiene cuenta de usuario, puede acceder a esta haciendo clic en el botón "Acceder" que se encuentra en la parte superior derecha de la pantalla, cuando cargue el formulario debe ingresar su nick (nombre de usuario) y su contraseña y posteriormente hacer clic en "Identificarme".</p>
			
			<a name="como-publicar-o-compartir-algo" class="anchor"></a>
			<h3>3. Cómo publicar o compartir algo:</h3>
			<p>{$web.title} cuenta con varias secciones en las cuales muchas de estas te permiten publicar ideas, ocurrencias o algo de tu interés.</p>
			
			<div class="blockquote">

				<h4>3.1. Publicar un post</h4>
				<p>Los posts te permiten compartir contenidos de tu interés y del interés de los demás usuarios. Para crear un post necesitas tener una idea principal sobre algún tema y un poco de imaginación para darle a tu post el estilo que quieras. Justo debajo del logo de {$web.title}, encontrarás "Agregar post", al hacer clic, te llevará a la sección para agregar un post, el título del tu post, es la corta descripción del contenido de tu post, el contenido del post, es el espacio para colocar tus ideas y tus intereses de una forma ordenada y si quieres decorativa, eso les gustará a los demás usuarios los cuales te premiarán con puntos.</p>
				
				<h4>3.2. Publicar un comentario</h4>
				<p>Los posts te permiten que opines sobre su contenido. Cuando ingreses en algún post, podrás opinar o comentar dirigiéndote a la parte inferior de la página, encontrarás un espacio para ingresar un comentario nuevo, cuando lo ingreses, haces clic en el botón "Enviar comentario". De la misma forma puedes responder comentarios de los demás usuarios haciendo clic en el botón responder comentario. También puedes comentar en los temas, imágenes y estados de los usuarios.</p>
				
				<h4>3.2. Publicar un estado</h4>
				<p>{$web.title} te permite expresar tus pensamientos o ánimos y para hacerlo es muy sencillo, solo te tienes que dirigir a tu perfil y buscas el recuadro que dice: "Comparte algo", haces clic e ingresas tu estado, posteriormente harás clic en "Enviar".</p>

			</div>

		</div>
	</div>
</div>

<div id="sidebar" class="list">
	<ul>
		<li><a class="active" href="{$web.url}/ayuda">Ayuda</a></li>
		<li><a href="{$web.url}/desarrolladores">Desarolladores</a></li>
		<li><a href="{$web.url}/terminos-y-condiciones">Términos y condiciones</a></li>
		<li><a href="{$web.url}/protocolo">Protocolo</a></li>
	</ul>
</div>

{include file='includes/footer.tpl'}