<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class reg{
	function check($nick, $email){
		global $mysqli;
		$type = $nick?'nick':'email';
		$query = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_nick) = \''.strtolower($nick).'\' OR  LOWER(u_email) = \''.strtolower($email).'\'');
		if($query->num_rows) return '0: El '.$type.' ya se encuentra en uso';
		else return '1: ';
	}
	
	function send(){
		global $mysqli, $web, $activity, $notifica;
		$error = array();
		$nick = secure($_POST['r_nick']);
		$email = secure($_POST['r_email']);
		$pass = secure($_POST['r_pass']);
		$pais = strtoupper(substr(secure($_POST['r_pais']), 0, 2));
		$sexo = intval($_POST['r_sexo']);
		$dia = intval($_POST['r_dia']);
		$mes = intval($_POST['r_mes']);
		$ano = intval($_POST['r_ano']);
		$recaptcha = secure($_POST['recaptcha_response_field']);
		$recaptcha_2 = secure($_POST['recaptcha_challenge_field']);
		$query['user'] = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_nick) = \''.strtolower($nick).'\'');
		$query['email'] = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_email) = \''.strtolower($email).'\'');
		$pages_list = array('admin', 'mod', 'posts', 'comunidades', 'imagenes', 'miembros', 'tops', 'registro', 'cuenta', 'favoritos', 'borradores', 'monitor', 'mensajes', 'mi', 'historial', 'agregar-post', 'protocolo', 'terminos-y-condiciones', 'ayuda', 'buscar', 'recover', 'pages');
		//=> BLOQUEOS
		$email_server = explode('@', $email);
		$query_lock_server = $mysqli->query('SELECT l_id FROM admin_locks WHERE l_type = \'2\' AND LOWER(l_lock) = \''.strtolower($email_server[1]).'\'');
		$query_lock_nick = $mysqli->query('SELECT l_id FROM admin_locks WHERE l_type = \'3\' AND LOWER(l_lock) = \''.strtolower($nick).'\'');
		//=> NICK
		if(empty($nick)) $error[] = array('k' => 'i_nick', 'd' => 'No haz ingresado el nick');
		elseif(strlen($nick) < 3 || strlen($nick) > 16) $error[] = array('k' => 'i_nick', 'd' => 'Este campo debe tener entre 3 y 16 caracteres');
		elseif(!preg_match('/^[-_a-zA-Z0-9]+$/i', $nick)) $error[] = array('k' => 'i_nick', 'd' => 'Solo caracteres alfanum&eacute;ricos y guiones');
		elseif($query['user']->num_rows) $error[] = array('k' => 'i_nick', 'd' => 'El nick ya se encuentra en uso');
		elseif(in_array($nick, $pages_list)) $error[] = array('k' => 'i_nick', 'd' => 'Este nick no se encuentra disponible');
		elseif($query_lock_nick->num_rows) $error[] = array('k' => 'i_nick', 'd' => 'Este nick no est&aacute; permitido');
		//=> EMAIL
		if(empty($email)) $error[] = array('k' => 'i_email', 'd' => 'Nos haz ingresado el email');
		elseif(strlen($email) > 40) $error[] = array('k' => 'i_email', 'd' => 'El email es muy largo');
		elseif($query_lock_server->num_rows) $error[] = array('k' => 'i_email', 'd' => 'Este servidor de correos no est&aacute; permitido');
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) $error[] = array('k' => 'i_email', 'd' => 'El email no es v&aacute;lido');
		elseif($query['email']->num_rows) $error[] = array('k' => 'i_email', 'd' => 'El email ya se encuentra en uso');
		//=> CONTRASEÑA
		if(empty($pass)) $error[] = array('k' => 'i_pass', 'd' => 'Nos haz ingresado la contrase&ntilde;a');
		elseif(strlen($pass) < 6 || strlen($pass) > 20) $error[] = array('k' => 'i_pass', 'd' => 'Este campo debe tener entre 6 y 20 caracteres');
		elseif($pass == $nick) $error[] = array('k' => 'i_pass', 'd' => 'Esta password no es segura');
		//=> PAIS
		include'PHP/libs/datos.php';
		if(empty($array_data['paises'][$pais])) $error[] = array('k' => 'i_pais', 'd' => 'El pais seleccionado no existe');
		//=> SEXO
		if($sexo != 0 && $sexo != 1) $error[] = array('k' => 'i_sexo', 'd' => 'El sexo seleccionado no existe');
		//=> NACIMIENTO
		$date_permit = (date('Y') - $web['min_age']); //=> Desde 12 años
		$date_max = (date('Y') - 113); //=> Hasta 113 años
		if($dia > 31 || $dia < 1) $error[] = array('k' => 'i_dia', 'd' => 'El d&iacute; no es v&aacute;lido');
		if($mes > 12 || $mes < 1) $error[] = array('k' => 'i_mes', 'd' => 'El mes no es v&aacute;lido');
		if($ano > $date_permit || $ano < $date_max) $error[] = array('k' => 'i_ano', 'd' => 'Debes ser mayor de '.$web['min_age'].' a&ntilde;os');
		//=> RECAPTCHA
		if(empty($recaptcha)) $error[] = array('k' => 'recaptcha_response_field', 'd' => 'Ingresa el c&oacute;digo de seguridad');
		require'PHP/libs/recaptchalib.php';
		$robot = recaptcha_check_answer(PRIVATE_KEY, $_SERVER["REMOTE_ADDR"], $recaptcha_2, $recaptcha);		
		if(!$robot->is_valid) $error[] = array('k' => 'recaptcha_response_field', 'd' => 'El c&oacute;digo de seguridad no es v&aacute;lido');
		$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		//=>
		$query_lock_ip = $mysqli->query('SELECT l_id FROM admin_locks WHERE l_type = \'1\' AND l_lock = \''.$ip.'\'');
		if($query_lock_ip->num_rows)return json(array('data' => 'Por alguna raz&oacute;n tu registro en '.$web['title'].' ha sido restringido, te pedimos leer el <a href="'.$web['url'].'/protocolo">protocolo</a> para evitar nuevas restricciones.<br /><br /><center><a class="button_1" href="'.$web['url'].'">Ir al inicio</a></center>', 'title' => 'Registro restringido'));
		if(count($error) > 0) return json($error);
		else{
			if(!empty($web['active_user'])) $status = 2;
			else $status = 1;
			$quot = "'";
			$key = substr(md5(sha1($pass).'SMLine'), 0, 35);
			$mysqli->query('INSERT INTO users (u_nick, u_pass, u_email, u_rank, u_sex, u_points_ava, u_date, u_last_ip, u_country, u_status) VALUES (\''.$nick.'\', \''.$key.'\', \''.$email.'\', \'3\', \''.$sexo.'\', \'0\', \''.time().'\', \''.$ip.'\', \''.$pais.'\', \''.$status.'\')');
			$uid = $mysqli->insert_id;
			$mysqli->query('INSERT INTO users_accounts (u_id, u_day, u_month, u_year) VALUES (\''.$uid.'\', \''.$dia.'\', \''.$mes.'\', \''.$ano.'\')');
			$mysqli->query('INSERT INTO users_stats (u_id) VALUES (\''.$uid.'\')');
			$mysqli->query('UPDATE web_stats SET members = members + 1 WHERE w_type = \'GLO\'');
			
			if($web['welcome']){
				$sexo_x = $sexo == 0 ? 'o' : 'a';
				$replaces_y = array('[nick]', '[f_o_m]', '[web]');
				$replaces_x = array($nick, $sexo_x, $web['title']);
				$web['welcome_message'] = str_replace($replaces_y, $replaces_x, $web['welcome_message']);
				if($mysqli->query('INSERT INTO states (s_user, s_to_user, s_body, s_date, s_type, s_adj, s_ip) VALUES (\''.$web['user_robot'].'\', \''.$uid.'\', \''.$web['welcome_message'].'\', \''.time().'\', \'1\', \'\', \''.$_SERVER['REMOTE_ADDR'].'\')')){
					$new_idp = $mysqli->insert_id;
					$activity->insert(26, $new_idp, $web['user_robot']);
					$notifica->insert(26, $new_idp, $uid, 0, $web['user_robot']);
					$mysqli->query('UPDATE web_stats SET states = states + 1');
				}
			}
			
			if(!empty($web['active_user'])){
				$time = time();
				$key = $time+$time;
				$key3 = $time-573;
				$code = substr(md5($time.$uid.$email), 0, 20);
				$link = $web['url'].'/recover?type=act&key='.$key.'&key2='.($time+200).'&key3='.sha1($key3).'&code='.$code;
				$email_to = $email;
				$email_subject = $web['title'].' - Paso final para activar tu cuenta';
				$email_body = '<div style="background:#0f7dc1;padding:10px;font-family:Arial, Helvetica,sans-serif;color:#000">';
				$email_body .= '<h1 style="color:#FFFFFF; font-weight:bold; font-size:30px;">'.$web['title'].'</h1>';
				$email_body .= '<div style="background:#FFF;padding:10px;font-size:14px">';
				$email_body .= '<h2 style="font-family:Arial, Helvetica,sans-serif;color:#000;font-size:22px">Hola '.$nick.'</h2>';
				$email_body .= '<p style="font-family:Arial, Helvetica,sans-serif;color:#000">&iexcl;Te damos la bienvenida a '.$web['title'].'!</p>';
				$email_body .= '<p>Para finalizar con el proceso de registro, confirma tu direcci&oacute;n de email accediendo a <a href="'.$link.'">'.$link.'</a>';
				$email_body .= '</p><br /> <br />';
				$email_body .= '<p>Posteriormente podr&aacute;s acceder a tu cuenta con los siguientes datos:</p>';
				$email_body .= '<p>Usuario: '.$nick.' <br /> Contrase&ntilde;a: '.$pass.'</p><br />';
				$email_body .= '<p>Antes de empezar a interactuar con la comunidad, te recomendamos que visites el <a target="_blank" href="'.$web['url'].'/protocolo">Protocolo</a> del sitio.</p>';
				$email_body .= '<p>Esperamos que disfrutes enormemente tu visita.</p>';
				$email_body .= '<p>&iexcl;Te damos la bienvenida a Muchas gracias!</p>';
				$email_body .= '<p>Staff de '.$web['title'].'.</p>';
				$email_body .= '<div style="border-top:#CCC solid 1px;padding:10px 0">';
				$email_body .= '<span style="color:#666;font-size:11px">';
				$email_body .= '<center>El staff de <strong>'.$web['title'].'</strong></center>';
				$email_body .= '</span>';
				$email_body .= '</div>';
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
					$mysqli->query('INSERT INTO emails (e_user, e_email, e_code, e_key, e_ip, e_type, e_date) VALUES (\''.$uid.'\', \''.$email.'\', \''.$code.'\', \''.$key3.'\', \''.$ip.'\', \'3\', \''.$time.'\')');
					return json(array('data' => 'Hola <b>'.$nick.'</b>, gracias por registrarte en '.$web['title'].', te hemos enviado en correo a <b>'.$email_to.'</b> con el paso final para acceder a tu cuenta, si en los pr&oacute;ximos minutos no lo encuentras en tu bandeja de entrada, por favor, revisa tu carpeta de correo no deseado, es posible que se haya filtrado.<br /> <br />&iexcl;Muchas gracias!', 'title' => 'Falta un paso final'));
				}
			}else{
				require'PHP/class/anonimo.class.php';
				$anon = new anon;
				$anon->login($nick, $pass, true);
				return json(array('data' => 'Hola <b>'.$nick.'</b>, gracias por registrarte en '.$web['title'].', tu cuenta ha sido activada autom&aacute;ticamente, podr&aacute;s disfrutar de esta comunidad inmediatamente, recuerda leer el <a href="'.$web['url'].'/protocolo">protocolo</a>.<br /><br /><center><a class="button_1 b_ok" href="'.$web['url'].'/cuenta">Configurar mi cuenta</a></center>', 'title' => 'Enhorabuena'));
			}
			
		}
	}
}
?>