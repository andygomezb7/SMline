<?php
ob_start(); 
// INICIO
define('UNTARGETED', TRUE);
define('TS_HEADER', TRUE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', FALSE);
require'../PHP/libs/functions.php';
// VARIABLES PRINCIPALES
$sm['version'] = 'SMLine 1.1.2 Prime';
$sm['action'] = 'Migrar de PHPost a '.$sm['version'];
$web_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
$web_url .= '://'. $_SERVER['HTTP_HOST'];
$sm['url'] = $web_url.'/SM/phpost.php';
$sm['paso'] = intval($_GET['paso']);
$sm['precauciones'] = 'Antes de migrar de <strong>PHPost Risus</strong> a <strong>'.$sm['version'].'</strong>, ten en cuenta los siguientes puntos:';
$sm['precauciones_puntos']['ok'] = array(
	'Hacer un respaldo de todos los archivos de tu sitio web, tanto FTP como base de datos.',
	'Aseg&uacute;rate desinstalar mods y parches de tu sitio para evitar inconvenientes.',
	'Al importar todos tus datos de PHPost a SMline, tu sitio web ser&aacute; mucho m&aacute;s optimo.',
	);
$sm['precauciones_puntos']['error'] = array(
	'Las passwords de los usuarios se reseter&aacute;n (este punto tiene soluci&oacute;n).',
	'Datos como, fotos, configuraciones de administraci&oacute;n y moderaci&oacute;n, configuraciones de perfil se reseter&aacute;n.',
	);

$sm['finish_message'] = 'Tu web fue migrada a <strong>'.$sm['version'].'</strong> correctamente, ya puedes empezar a disfrutar de esta experiencia que llega a ti gracias al <a href="http://smline.net" target="_blank">equipo de SMLine</a> y a su desarrollador';
$sm['finish_message'] .= ' <a href="https://www.facebook.com/cristian.anzola.35" target="_blank">David Anzola</a>. Recuerda visitar el <a href="http://smline.net" target="_blank">foro</a> donde encontrar&aacute;s actualizaciones y nuevas funciones para tu web y en donde siempre ser&aacute;s bienvenido.<br /><br />Haz click en finalizar y posteriormente <strong class="del_files">elimina este archivo</strong> y todo el contenido de la carpeta <strong>SM</strong> desde tu servidor FTP para evitar inconvenientes.<br /><br />&iexcl;Gracias por instalar SMline!';

function back_paso($paso){
	$dire = urldecode($web_url."/SM/phpost.php?paso=".$paso);
	header("Location: $dire");
	exit();
}


?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?= $sm['version'] ?> - <?= $sm['action'] ?></title>
		<link href="<?=$web_url?>/SM/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="install_content">
			<div class="left_menu">
				<div class="menu_head">
					Pasos
				</div>
				<div class="menu_list<?php if($sm['paso'] == 0) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>">Precauciones</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 1) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=1">Archivos y permisos</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 2) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=2">Importar datos</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 3) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=3">Administrador</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 4) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=4">Bienvenido</a>
				</div>
			</div>
			
			<div class="install_main">
				<?php if($sm['paso'] == 0){ ?>
				<h2>Precauciones</h2>
				<p>
					<?= $sm['precauciones'] ?>
					<div class="puntos_precaucion">
						<?php foreach($sm['precauciones_puntos']['ok'] AS $punto){ ?>
							<div class="puntos_list">
								<img src="<?=$web_url?>/SM/img/ok.png" /> <?= $punto ?>
							</div>
						<?php } ?>
						<?php foreach($sm['precauciones_puntos']['error'] AS $punto){ ?>
							<div class="puntos_list">
								<img src="<?=$web_url?>/SM/img/error.png" /> <?= $punto ?>
							</div>
						<?php } ?>
					</div>
				</p>
				<div class="foot_buttons">
					<a class="button_next" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']+1) ?>">Siguiente</a>
				</div>
				<?php } ?>
				
				
				<?php 
				$files_permits = array(
					'avatar' => 777,
					'PHP/cache' => 777,
					'thumbs/comus' => 777,
					'thumbs/images' => 777,
					'thumbs/posts' => 777,
					'mysqli_start.php' => 666
				);

				foreach($files_permits AS $key => $val){
					$estado_ok[$key] = substr(sprintf('%o', fileperms('../'.$key)), -3);
					if($estado_ok[$key] != $val && $sm['paso'] > 1) back_paso(1);
				}

				if($sm['paso'] == 1){ ?>
				<h2>Archivos y permisos</h2>
				<p>Elimina desde tu FTP, todos los archivos y directorios que pertenecen a PHPost Risus, excepto el archivo <strong>config.inc.php</strong> que es necesario para importar los datos.<br /><br />Aseg&uacute;rate de que todos los archivos de <strong><?= $sm['version'] ?></strong> est&eacute;n en tu FTP y que tengan los permisos correspondientes: Los directorios <strong>avatar</strong>, <strong>PHP/cache</strong>, <strong>thumbs/comus</strong>, <strong>thumbs/images</strong> y <strong>thumbs/posts</strong> con permisos 777, y el archivo <strong>mysqli_start.php</strong> con permisos 666. Puedes editar los permisos desde tu FTP.</p>
				
				<br />
				
				<table cellpadding="0" cellspacing="0" border="0" class="admin_table" width="250" align="center">
					<thead>
						<tr>
							<th colspan="2">Estados de los archivo</th>
						</tr>
					</thead>
					<tbody>
					
						<?php
						foreach($files_permits AS $key => $val){
						?>
						<tr class="Tleft">
							<td>
								<?= $key ?>
							</td>
							<td>
								<?php if($estado_ok[$key] == $val){ ?>
								<span class="status_ok">Ok</span>
								<?php }else{
									$error = TRUE;
								?>
								<span class="status_error">Sin permisos</span>
								<?php } ?>
							</td>
						</tr>
						<?php
						}
						?>
						<tr>
							<th colspan="2"><center><a href="<?= $sm['url'] ?>?paso=<?= $sm['paso'] ?>">Comprobar de nuevo</a></center></th>
						</tr>
					</tbody>
				</table>
				
				
				<div class="foot_buttons">
					<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
					<a class="button_next" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']+1) ?>"<?php if($error): ?> onclick="return false;" style="opacity: 0.3;"<?php endif; ?>>Siguiente</a>
				</div>
				<?php } ?>
				
				
				
				<?php if($sm['paso'] == 2){ ?>
				<form action="<?= $sm['url'] ?>?paso=<?= $sm['paso'] ?>" method="post" name="sm_install">
					<h2>Importar datos</h2>
					
					<?php 
						include'../config.inc.php';
						if ( ! defined('TSCookieName')) $mysqli_error2 = 'El archivo <strong>config.inc.php</strong> de tu web PHPost, es requerido para este proceso.';
						$mysqli = new mysqli($db['hostname'], $db['username'], $db['password'], $db['database']);
						if($_POST['importar']){
							$query = $mysqli->query('SELECT u_id FROM users');
							if(!$query->num_rows){
								// RESETEAR STATS
								$mysqli->query('UPDATE web_stats SET posts = 0, comments = 0, members = 0 WHERE w_type = \'GLO\'');
							
								// USUARIOS
								$default_pass = 'sml';
								$query = $mysqli->query('DELETE FROM users');
								$query = $mysqli->query('DELETE FROM users_stats');
								$query = $mysqli->query('DELETE FROM users_accounts');
								$query = $mysqli->query('ALTER TABLE users AUTO_INCREMENT = 1');
								$query = $mysqli->query('ALTER TABLE users_accounts AUTO_INCREMENT = 1');
								$query = $mysqli->query('SELECT user_id, user_name, user_email, user_rango, user_registro, user_lastactive, user_last_ip FROM u_miembros WHERE user_id != 1');
								if($mysqli->error) die('Error: '.$mysqli->error);
								while($row = $query->fetch_assoc()){
									
										$mysqli->query('INSERT INTO users (u_id, u_nick, u_pass, u_email, u_rank, u_sex, u_points_ava, u_date, u_last_ip, u_last_active, u_country, u_status) VALUES (\''.$row['user_id'].'\', \''.$row['user_name'].'\', \''.$default_pass.'\', \''.$row['user_email'].'\', \''.($row['user_rango'] > 3 ? 3 : $row['user_rango']).'\', \'0\', \''.$row['user_puntosxdar'].'\', \''.$row['user_registro'].'\', \''.$row['user_last_ip'].'\', \''.$row['user_lastactive'].'\', \'AR\', \'1\')') or die('Error: '.$mysqli->error);
										$uid = $mysqli->insert_id;
										$mysqli->query('INSERT INTO users_accounts (u_id, u_day, u_month, u_year) VALUES (\''.$uid.'\', \'3\', \'3\', \'1996\')') or die('Error: '.$mysqli->error);
										$mysqli->query('INSERT INTO users_stats (u_id) VALUES (\''.$uid.'\')') or die('Error: '.$mysqli->error);
										$mysqli->query('UPDATE web_stats SET members = members + 1 WHERE w_type = \'GLO\'') or die('Error: '.$mysqli->error);
										
								}
								
								// CATEGORIAS
								$query = $mysqli->query('DELETE FROM posts_cats');
								$query = $mysqli->query('ALTER TABLE posts_cats AUTO_INCREMENT = 1');
								$query = $mysqli->query('SELECT cid, c_nombre, c_seo, c_img FROM p_categorias');
								while($row = $query->fetch_assoc()){
								
									$mysqli->query('INSERT INTO posts_cats (c_id, c_name, c_seo, c_img) VALUES (\''.$row['cid'].'\', \''.$row['c_nombre'].'\', \''.$row['c_seo'].'\', \''.$row['c_img'].'\')');
								
								}
								
								// POSTS
								$query = $mysqli->query('DELETE FROM posts');
								$query = $mysqli->query('ALTER TABLE posts AUTO_INCREMENT = 1');
								$query = $mysqli->query('SELECT post_id, post_user, post_category, post_title, post_body, post_date, post_tags, post_sticky FROM p_posts WHERE post_status = \'0\'');
								
								while($row = $query->fetch_assoc()){
								
									if($row['post_id'] == 1){
										$row['post_title'] = 'Bienvenido a '.$sm['version'];
										$row['post_body'] = '[align=center][size=18]Este es el primer post de los miles que tendr&aacute; tu web  ;)  \r\n\r\nGracias por elegir a [url=http://smline.net]SMline[/url] como tu Link Sharing System.[/size][/align]';
										$row['post_tags'] = 'SMline, Prime, Importado, Script';
									}
									
									$mysqli->query('INSERT INTO posts (p_id, p_user, p_cat, p_title, p_body, p_date, p_tags, p_sticky) VALUES (\''.$row['post_id'].'\', \''.$row['post_user'].'\', \''.$row['post_category'].'\', \''.$row['post_title'].'\', \''.$row['post_body'].'\', \''.$row['post_date'].'\', \''.$row['post_tags'].'\', \''.$row['post_sticky'].'\')');
									$mysqli->query('UPDATE users_stats SET u_posts = u_posts + 1 WHERE u_id = \''.$row['post_user'].'\'');
									$mysqli->query('UPDATE web_stats SET posts = posts + 1 WHERE w_type = \'GLO\'');
								
								}
								
								
								// COMENTARIOS
								$query = $mysqli->query('DELETE FROM comments WHERE c_type = 1');
								$query = $mysqli->query('SELECT c_post_id, c_user, c_date, c_body FROM p_comentarios WHERE c_status = \'0\'');
								if($mysqli->error) die('Error: '.$mysqli->error);
								while($row = $query->fetch_assoc()){
									
									$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date) VALUES (\'1\', \''.$row['c_post_id'].'\', \''.$row['c_user'].'\', \''.$row['c_body'].'\', \''.$row['c_date'].'\')') or die('Error: '.$mysqli->error);
									$mysqli->query('UPDATE web_stats SET comments = comments + 1') or die('Error: '.$mysqli->error);
									$mysqli->query('UPDATE posts SET p_comments = p_comments + 1 WHERE p_id = \''.$row['c_post_id'].'\'') or die('Error: '.$mysqli->error);
									$mysqli->query('UPDATE users_stats SET u_comments = u_comments + 1 WHERE u_id = \''.$row['c_user'].'\'') or die('Error: '.$mysqli->error);
								
								}
								
								// CONFIGURACION
								$query = $mysqli->query('SELECT titulo, slogan, url FROM w_configuracion LIMIT 1');
								$data = $query->fetch_assoc();
								$mysqli->query('UPDATE web_settings SET title = \''.$data['titulo'].'\', slogan = \''.$data['slogan'].'\', url = \''.$data['url'].'\'');
								
								$q_admin = $mysqli->query('SELECT u_id FROM users WHERE u_rank = 1 LIMIT 1');
								$d_admin = $q_admin->fetch_assoc();
								
								// POSTS PASSWORDS RESETS
								$mysqli->query('INSERT INTO posts (p_user, p_cat, p_title, p_body, p_date, p_tags, p_sticky) VALUES (\''.$d_admin['u_id'].'\', \'1\', \'Contrase&ntilde;as de los usuarios reseteadas\', \'Un saludo cordial, la presente es para informar que las contrase&ntilde;as de todos los usarios de este sitio web han sido reseteadas debido al cambio de versi&oacute;n de este sitio web. Pueden recuperar su contrase&ntilde;a v&iacute;a email haciendo [url='.$data['url'].'/recover]clic aqu&iacute;[/url] &oacute; pueden ingresar a su cuenta colocando en nick su direcci&oacute;n de correo y en password su nombre de usuario, posteriormente deber&aacute;n cambiar sus contrase&ntilde;as por una segura.\', \''.time().'\', \'pass,reset,contras,recover\', \'2\')');
								$mysqli->query('UPDATE users_stats SET u_posts = u_posts + 1 WHERE u_id = \'1\'');
								$mysqli->query('UPDATE web_stats SET posts = posts + 1 WHERE w_type = \'GLO\'');
								
								// ELIMINAR TABLAS PHPOST
								$drop_tables = array('f_comentarios', 'w_visitas', 'f_fotos', 'f_votos', 'p_borradores', 'p_categorias', 'p_comentarios', 'p_favoritos', 'p_posts', 'p_votos'. 'u_actividad', 'u_avisos', 'u_bloqueos', 'u_follows', 'u_mensajes', 'u_miembros', 'u_nicks', 'u_monitor', 'u_muro', 'u_muro_adjuntos', 'u_muro_comentarios', 'u_muro_likes', 'u_perfil', 'u_portal', 'u_rangos', 'u_respuestas', 'u_sessions', 'u_suspension', 'w_afiliados', 'w_configuracion', 'w_denuncias', 'w_contacts', 'w_medallas', 'w_medallas_assign', 'w_historial', 'w_noticias', 'w_blacklist', 'w_badwords', 'w_stats', 'w_temas');
								
								foreach($drop_tables AS $table){
									$mysqli->query('DROP TABLE '.$table);
								}
								
								if($mysqli->error)die('0: '.$mysqli->error);
								
								back_paso(3);
							}else back_paso(3);
							
						}else{
							if(!$mysqli->connect_errno){
								$config = file_get_contents('../mysqli_start.php');
								$config = str_replace(array('SM_server', 'SM_user', 'SM_pass', 'SM_db'), array($db['hostname'], $db['username'], $db['password'], $db['database']), $config);
								file_put_contents('../mysqli_start.php',$config);
								
								$query = $mysqli->query('SELECT a_id FROM activity');
								if($mysqli->error){
									include('SM-DB.php');
									$continue = true;
									foreach($SM_DB as $val){
										$mysqli->query($val);
										if($mysqli->error) $continue = false;
									}
									if($continue == false) $mysqli_error = 'Ocurri&oacute; un error al crear las tablas de <strong>SMline</strong>.';
								}
								
							}else $mysqli_error = 'Tus datos no conexi&oacute;n configurados en el <strong>config.inc.php</strong> son incorrecto';
							$orroroso = $mysqli->connect_errno ? $mysqli->connect_errno : $mysqli->error;
						}
						
					?>
					
					<?php if($mysqli_error){ ?>
						<div class="item-info error"><?=$mysqli_error?> (<?=$orroroso?>)</div>
					<?php } ?>
					
					<?php if($mysqli_error2){ ?>
						<div class="item-info error"><?=$mysqli_error2?></div>
					<?php } ?>
					
					<p>
					
						El proceso de importar datos puede ser un poco demorado, se le pide tener paciencia para este paso.

					</p>
					<input type="hidden" name="importar" value="1" />
					
					<div class="foot_buttons">
						<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
						<a class="button_next"<?php if($mysqli_error2): ?> onclick="return false;" style="opacity: 0.3;"<?php endif; ?> onclick="document.forms.sm_install.submit()">Importar datos</a>
					</div>
				</form>
				<?php } ?>
				
				
				
				<?php if($sm['paso'] == 3){ 
						require'../mysqli_start.php';
						$query = $mysqli->query('SELECT a_id FROM activity');
						if($mysqli->connect_errno || $mysqli->error) back_paso(2);
						if($_POST['user'] && $_POST['pass'] && $_POST['email']){
							$key = substr(md5(sha1($_POST['pass']).'SMLine'), 0, 35);
							$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
							$mysqli->query('INSERT INTO users (u_nick, u_pass, u_email, u_rank, u_sex, u_points_ava, u_date, u_last_ip, u_country, u_status) VALUES (\''.$_POST['user'].'\', \''.$key.'\', \''.$_POST['email'].'\', \'1\', \'0\', \'10\', \''.time().'\', \''.$ip.'\', \'CO\', \'1\')');
							$uid = $mysqli->insert_id;
							$mysqli->query('INSERT INTO users_accounts (u_id, u_day, u_month, u_year) VALUES (\''.$uid.'\', \'3\', \'3\', \'1996\')');
							$mysqli->query('INSERT INTO users_stats (u_id) VALUES (\''.$uid.'\')');
							$mysqli->query('UPDATE web_stats SET members = members + 1 WHERE w_type = \'GLO\'');
							back_paso(4);
						}
				?>
				<form action="<?= $sm['url'] ?>?paso=<?= $sm['paso'] ?>" method="post" name="sm_install">
					<h2>Primer administrador</h2>
					<p>
					
					<span class="form_label">Nick</span>
					<input type="text" class="input_text" name="user" placeholder="Ingresa tu nombre de usuario" tabindex="0" value="<?=$_POST['user']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">E-mail</span>
					<input type="text" class="input_text" name="email" placeholder="Ingresa tu email" tabindex="1" value="<?=$_POST['email']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Contrase&ntilde;a nueva</span>
					<input type="password" class="input_text" name="pass" placeholder="Ingresa tu contrase&ntilde;a deseada" tabindex="2" value="<?=$_POST['pass']?>">

					</p>
					<div class="foot_buttons">
						<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
						<a class="button_next" onclick="document.forms.sm_install.submit()">Siguiente</a>
					</div>
				</form>
				<?php } ?>
				
				<?php if($sm['paso'] == 4){
					require'../mysqli_start.php';
					$query = $mysqli->query('SELECT a_id FROM activity');
					if($mysqli->connect_errno || $mysqli->error) back_paso(2);
				?>
				<h2>Bienvenido</h2>
				<p><?= $sm['finish_message'] ?></p>
				<div class="foot_buttons">
					<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
					<a class="button_next" href="<?= $web_url ?>">Finalizar</a>
				</div>
				<?php } ?>

			</div>
			
		</div>
		
		<div class="footer">
			<a href="http://smline.net" target="_blank">SMLine</a> &copy; 2014
		</div>
		
	</body>
</html>
<?php ob_end_flush(); ?> 