<?php
ob_start(); 
// => GENERAR CONTRASEÑAS DE LOS USUARIOS NUEVAS Y ENVIARSELAS VIA EMAIL

// => ---Asegurate que tu servidor acepte la función "mail()" (enviar correos)---

// INICIO
define('UNTARGETED', TRUE);
define('TS_HEADER', TRUE);
error_reporting(E_ALL ^ E_WARNING ^ E_NOTICE);
ini_set('display_errors', FALSE);
include'../mysqli_start.php';

$query['web_settings'] = $mysqli->query('SELECT web.* FROM web_settings AS web WHERE web.w_type = \'GLO\'');
$web = $query['web_settings']->fetch_assoc();

require'../PHP/libs/functions.php';
// VARIABLES PRINCIPALES
$sm['version'] = 'SMLine 1.1.2 Prime';
$sm['action'] = 'Generar passwords nuevas';
$web_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
$web_url .= '://'. $_SERVER['HTTP_HOST'];
$sm['url'] = $web_url.'/SM/repass.php';
$sm['paso'] = intval($_GET['paso']);
$sm['precauciones'] = 'Antes de generar passwords nuevas, ten en cuenta estos puntos:';
$sm['precauciones_puntos']['ok'] = array(
	'Los usuarios recibir&aacute;n su password nueva v&iacute;a email.',
	'No habr&aacute; necesidad de que cada usuario intete recuperar su password v&iacute;a email.',
	);
$sm['precauciones_puntos']['error'] = array(
	'Si tu servidor no tiene activada la función "mail()", los correos a los usuarios jam&aacute;s llegar&aacute;.',
	'Si tu servidor es gratuito, es muy probable que este generador de contrase&ntilde;as no funcione.',
	'Si este generador de contrase&ntilde;as no te funciona, deber&aacute;s resetear las passwords de los usuarios manualmente, así mismo deberás enviar un correo a los usuarios uno por uno indic&aacute;ndoles sus nuevas contrase&ntilde;as.',
	);

$sm['finish_message'] = 'Los correos han sido enviados a todos los usuarios con su nueva contrase&ntilde;a, gracias por contar con <a href="http://smline.net" target="_blank">SMline</a>!';

function back_paso($paso){
	$dire = urldecode($web_url."/SM/repass.php?paso=".$paso);
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
					<a href="<?= $sm['url'] ?>?paso=1">Enviar correos</a>
				</div>
				<div class="menu_list<?php if($sm['paso'] == 2) echo ' active' ?>">
					<a href="<?= $sm['url'] ?>?paso=2">Finalizaci&oacute;n</a>
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
				
				if($sm['paso'] == 1){ ?>
				<h2>Enviar correos</h2>
				<p>Todos los usuarios de <strong><?=$web['title']?></strong> recibir&aacute;n un correo con su nueva password que se generar&aacute; autom&aacute;ticamente antes de enviar el correo, ten en cuenta que la password de cada usuario ser&aacute; distinta a las dem&aacute;s.</p>
				
				<br />
				
				
				
				
				<div class="foot_buttons">
					<a class="button_prev" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']-1) ?>">Anterior</a>
					<a class="button_next" href="<?= $sm['url'] ?>?paso=<?= ($sm['paso']+1) ?>"<?php if($error): ?> onclick="return false;" style="opacity: 0.3;"<?php endif; ?>>Generar passwords y enviar correos</a>
				</div>
				<?php } ?>
				
				<?php if($sm['paso'] == 2){
					
					$query = $mysqli->query('SELECT u_id, u_email, u_nick FROM users WHERE u_pass = \'sml\'');
					while($row = $query->fetch_assoc()){
						$pass = substr(md5(time()-99), 0, 8);
						$newPW = substr(md5(sha1($pass).'SMLine'), 0, 35);
						$mysqli->query('UPDATE users SET u_pass = \''.$newPW.'\' WHERE u_id = \''.$row['u_id'].'\' LIMIT 1');
							$email_to = $data['u_email'];
							$email_subject = $web['title'].' - Tu contrase&ntilde;a ha sido reseteada';
							$email_body = '<div style="background:#0f7dc1;padding:10px;font-family:Arial, Helvetica,sans-serif;color:#000">';
							$email_body .= '<h1 style="color:#FFFFFF; font-weight:bold; font-size:30px;">'.$web['title'].'</h1>';
							$email_body .= '<div style="background:#FFF;padding:10px;font-size:14px">';
							$email_body .= '<h2 style="font-family:Arial, Helvetica,sans-serif;color:#000;font-size:22px">Hola '.$row['u_nick'].'.</h2>';
							$email_body .= '<p>Recibe un cordial saludo, la presente es para anunciarte el cambio de versi&oacute;n en <strong>'.$web['title'].'</strong>, esto afect&oacute; tu y las contrase&ntilde;as de los usuarios que no puedieron acceder a su cuenta, por tal motivo te hemos generado una nueva password para ingresar a tu cuenta, al ingresar a esta podr&aacute;s cambiar tu contrase&ntilde;a por la que desees.</p>';
							$email_body .= '<p>Te recordamos tus datos</p>';
							$email_body .= '<p>Nick: '.$row['u_nick'].'<br />Nueva contrase&ntilde;a: '.$pass.'</p>';
							$email_body .= '<p>Te pedimos disculpas por los incovenientes, un fuerte abrazo!.<br />Att: Equipo de <strong>'.$web['title'].'</strong></p>';
							$email_body .= '</div>';
							$email_body .= '</div>';
							$sender = $web['title']." <no-reply@".str_replace('www.', '', $web['url']).">";
							$email_headers = "MIME-Version: 1.0"."\n";
							$email_headers .= "Content-type: text/html; charset=utf-8"."\n";
							$email_headers .= "Content-Transfer-Encoding: 8bit"."\n";
							$email_headers .= "From: $sender"."\n";
							$email_headers .= "Return-Path: $sender"."\n";
							$email_headers .= "Reply-To: $sender\n";
								if(mail($email_to, $email_subject, $email_body, $email_headers)){
									
								}else die('Este servidor no puede enviar correos :(');
					
					}
				?>
				<h2>Finalizaci&oacute;n</h2>
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