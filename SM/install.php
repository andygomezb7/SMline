<?php
ob_start(); 
// INICIO
define('UNTARGETED', TRUE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', FALSE);
require'../PHP/libs/functions.php';
// VARIABLES PRINCIPALES
$sm['version'] = 'SMLine 1.1.2 Prime';
$sm['action'] = 'Instalaci&oacute;n';
$web_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
$web_url .= '://'. $_SERVER['HTTP_HOST']. $_SERVER['PHP_SELF'];
$sm['url'] = $web_url.'';
$sm['paso'] = intval($_GET['paso']);
$sm['licencia'] = '<strong>'.$sm['version'].'</strong> es un software libre, puede ser distribuido o modificado siempre y cuando los derechos de autor sean respetados y tenga su <strong>Copyright</strong> siempre presente y visible. La empresa desarrolladora de este sofware (<strong>SMLine</strong>) no se hace responsable del mal uso que se le pueda dar al software que fue creado con finalidades educaticas y emprendedoras.';
$sm['finish_message'] = '<strong>'.$sm['version'].'</strong> fue instalado correctamente en tu sitio, ya puedes empezar a disfrutar de esta nueva experiencia que llega a ti gracias al <a href="http://smline.net" target="_blank">equipo de SMLine</a> y a su desarrollador';
$sm['finish_message'] .= ' <a href="https://www.facebook.com/cristian.anzola.35" target="_blank">David Anzola</a>. Recuerda visitar el <a href="http://smline.net" target="_blank">foro</a> donde encontrar&aacute;s actualizaciones y nuevas funciones para tu web y en donde siempre ser&aacute;s bienvenido.<br /><br />Haz click en finalizar y posteriormente <strong class="del_files">elimina este archivo</strong> y todo el contenido de la carpeta <strong>SM</strong> desde tu servidor FTP para evitar inconvenientes.<br /><br />&iexcl;Gracias por instalar SMline!';

function back_paso($paso){
	$dire = urldecode($_SERVER["PHP_SELF"]. $web_url."?paso=".$paso);
	header("Location: $dire");
	exit();
}

?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?= $sm['version'] ?> - <?= $sm['action'] ?></title>
		<link href="../SM/style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div class="install_content">
			<div class="left_menu">
				<div class="menu_head">
					Pasos
				</div>
				<div class="menu_list<?php if($sm['paso'] == 0) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>">Licencia de uso</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 1) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=1">Permisos de escritura</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 2) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=2">Importar base de datos</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 3) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=3">Detalles del sitio</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 4) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=4">Administrador</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 5) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=5">Bienvenido</a>
				</div>
			</div>
			
			<div class="install_main">
				<?php if($sm['paso'] == 0){ ?>
				<h2>Licencia de uso</h2>
				<p><?= $sm['licencia'] ?></p>
				<div class="foot_buttons">
					<a class="button_next" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']+1) ?>">Acepto la licencia</a>
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
				<h2>Permisos de escritura</h2>
				<p>Aseg&uacute;rate de que los directorios <strong>avatar</strong>, <strong>PHP/cache</strong>, <strong>thumbs/comus</strong>, <strong>thumbs/images</strong> y <strong>thumbs/posts</strong> tengan permisos 777, y que el archivo <strong>mysqli_start.php</strong> tenga permisos 666. Puedes editar los permisos desde tu FTP.</p>
				
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
					<h2>Ingresa los datos de conexi&oacute;n SQL</h2>
					
					<?php if($_POST['server']){
							$mysqli = new mysqli($_POST['server'], $_POST['user'], $_POST['pass'], $_POST['db']);
							if(!$mysqli->connect_errno){
								$mysqli->query("set names 'utf8'");
								
								$config = file_get_contents('../mysqli_start.php');
								$config = str_replace(array('SM_server', 'SM_user', 'SM_pass', 'SM_db'), array($_POST['server'], $_POST['user'], $_POST['pass'], $_POST['db']), $config);
								file_put_contents('../mysqli_start.php',$config);
								include('SM-DB.php');
								$continue = true;
								foreach($SM_DB as $val){
									$mysqli->query($val);
									//if($mysqli->error) die($mysqli->error);
									if($mysqli->error) $continue = false;
								}
								
								
								if($continue == true) back_paso(3);
							}
							$orroroso = $mysqli->connect_errno ? $mysqli->connect_errno : $mysqli->error;
						}
					?>
					
					<?php if($orroroso){ ?>
						<div class="item-info error"><?php if($mysqli->connect_errno): ?>Tus datos de conexi&oacute;n son incorrectos <?php endif; ?>(<?=$orroroso?>)</div>
					<?php }else{ ?>
						<div class="item-info">Puedes crear tu base de datos, usuario y contrase&ntilde;a desde tu Cpanel o desde PHPMyAdmin.</div>
					<?php } ?>
					
					<p>
					
					<span class="form_label">Servidor</span>
					<input type="text" class="input_text" name="server" placeholder="Ej: localhost" tabindex="0" value="<?=$_POST['server']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Base de datos</span>
					<input type="text" class="input_text" name="db" placeholder="Nombre de tu base de datos" tabindex="1" value="<?=$_POST['db']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Usuario</span>
					<input type="text" class="input_text" name="user" placeholder="Usuario de la base de datos" tabindex="2" value="<?=$_POST['user']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Contrase&ntilde;a</span>
					<input type="password" class="input_text" name="pass" placeholder="Password del usuario" tabindex="3" value="<?=$_POST['pass']?>">

					</p>
					<div class="foot_buttons">
						<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
						<a class="button_next" onclick="document.forms.sm_install.submit()">Siguiente</a>
					</div>
				</form>
				<?php } ?>
				
				
				
				<?php if($sm['paso'] == 3){ 
						require'../mysqli_start.php';
						$query = $mysqli->query('SELECT a_id FROM activity');
						if($mysqli->connect_errno || $mysqli->error) back_paso(2);
						if($_POST['title'] && $_POST['url'] && $_POST['slogan']){
							$mysqli->query('UPDATE web_settings SET title = \''.$_POST['title'].'\', slogan =  \''.$_POST['slogan'].'\', url =  \''.$_POST['url'].'\'');
							back_paso(4);
						}
				?>
				<form action="<?= $sm['url'] ?>?paso=<?= $sm['paso'] ?>" method="post" name="sm_install">
					<h2>Detalles del sitio</h2>
					<p>
					
					<span class="form_label">Nombre</span>
					<input type="text" class="input_text" name="title" placeholder="Nombre de este sitio web" tabindex="0" value="<?=$_POST['title']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Slogan</span>
					<input type="text" class="input_text" name="slogan" placeholder="Lema de este sitio web" tabindex="1" value="<?=$_POST['slogan']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">URL</span>
					<input type="text" class="input_text" name="url" placeholder="URL de este sitio web" tabindex="2" value="<?= $web_url ?>">

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
						if($_POST['user'] && $_POST['pass'] && $_POST['email']){
							$key = substr(md5(sha1($_POST['pass']).'SMLine'), 0, 35);
							$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
							$mysqli->query('INSERT INTO users (u_nick, u_pass, u_email, u_rank, u_sex, u_points_ava, u_date, u_last_ip, u_country, u_status) VALUES (\''.$_POST['user'].'\', \''.$key.'\', \''.$_POST['email'].'\', \'1\', \'0\', \'10\', \''.time().'\', \''.$ip.'\', \'CO\', \'1\')');
							$uid = $mysqli->insert_id;
							$mysqli->query('INSERT INTO users_accounts (u_id, u_day, u_month, u_year) VALUES (\''.$uid.'\', \'3\', \'3\', \'1996\')');
							$mysqli->query('INSERT INTO users_stats (u_id) VALUES (\''.$uid.'\')');
							$mysqli->query('UPDATE web_stats SET members = members + 1 WHERE w_type = \'GLO\'');
							
							back_paso(5);
						}
				?>
				<form action="<?= $sm['url'] ?>?paso=<?= $sm['paso'] ?>" method="post" name="sm_install">
					<h2>Datos de administrador</h2>
					<p>
					
					<span class="form_label">Nick</span>
					<input type="text" class="input_text" name="user" placeholder="Ingresa tu nombre de usuario" tabindex="0" value="<?=$_POST['user']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">E-mail</span>
					<input type="text" class="input_text" name="email" placeholder="Ingresa tu email" tabindex="1" value="<?=$_POST['email']?>">
					
					<div class="form_separador"></div>
					
					<span class="form_label">Contrase&ntilde;a</span>
					<input type="password" class="input_text" name="pass" placeholder="Ingresa tu contrase&ntilde;a deseada" tabindex="2" value="<?=$_POST['pass']?>">

					</p>
					<div class="foot_buttons">
						<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
						<a class="button_next" onclick="document.forms.sm_install.submit()">Siguiente</a>
					</div>
				</form>
				<?php } ?>
				
				<?php if($sm['paso'] == 5){
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