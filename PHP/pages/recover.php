<?php
$smarty_page = 'recover';
$page['css'] = 'recover';
$page['title'] = $web['title'].' - '.$web['slogan'];

if($user->uid){
	header('location: /');
	$smarty->assign('error', array('Oops!', 'Ya estas registrado', 'Ir al inicio', '/'));
	$smarty->assign('page', array('title' => $web['title'].' - Error'));
	$smarty->display('error.tpl');
	die;
}

$type = secure($_GET['type']);
$code = substr(secure($_GET['code']), 0, 20);
$key = intval($_GET['key']);
$key2 = intval($_GET['key2']);
$key3 = intval($_GET['key3']);

if($type == 'act'){
	$query = $mysqli->query('SELECT id, e_user, e_email, e_code, e_key, e_type, e_date FROM emails WHERE e_code = \''.$code.'\' AND e_date = \''.($key2-200).'\' AND e_type = \'3\' LIMIT 1');
	$data = $query->fetch_assoc();
	if($data['e_user'] && $key == ($data['e_date']*2) && $key3 == sha1($data['e_key'])){
		$mysqli->query('UPDATE users SET u_status = \'1\' WHERE u_id = \''.$data['e_user'].'\' LIMIT 1');
		$mysqli->query('DELETE FROM emails WHERE id = \''.$data['id'].'\' LIMIT 1');
		$smarty->assign('error', array('Listo!', 'Hola <strong>'.$user->get_nick($data['e_user']).'</strong>, tu cuenta ha sido activada correctamente, ya puedes identificarte.', 'Identificarme', 'javascript:anonimo.show_login();'));
		$smarty->assign('page', array('title' => $web['title'].' - Activar cuenta'));
		$smarty->display('error.tpl');
		die;
	}else{
		$smarty->assign('error', array('Oops!', 'La petici&oacute;n que buscas no existe. Por favor intenta reenviarla.', 'Ir al inicio', '/'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
}elseif($type == 'rec'){
	$query = $mysqli->query('SELECT id, e_user, e_email, e_code, e_key, e_type, e_date FROM emails WHERE e_code = \''.$code.'\' AND e_date = \''.($key2-200).'\' AND e_type = \'2\' LIMIT 1');
	$data = $query->fetch_assoc();
	if($data['e_user'] && $key == ($data['e_date']*2) && $key3 == sha1($data['e_key'])){
		$pass = substr(md5(time()-99), 0, 8);
		$newPW = substr(md5(sha1($pass).'SMLine'), 0, 35);
		$mysqli->query('UPDATE users SET u_pass = \''.$newPW.'\' WHERE u_id = \''.$data['e_user'].'\' LIMIT 1');
		$mysqli->query('DELETE FROM emails WHERE id = \''.$data['id'].'\' LIMIT 1');
				$email_to = $data['e_email'];
				$email_subject = $web['title'].' - Datos para ingresar a tu cuenta';
				$email_body = '<div style="background:#0f7dc1;padding:10px;font-family:Arial, Helvetica,sans-serif;color:#000">';
				$email_body .= '<h1 style="color:#FFFFFF; font-weight:bold; font-size:30px;">'.$web['title'].'</h1>';
				$email_body .= '<div style="background:#FFF;padding:10px;font-size:14px">';
				$email_body .= '<h2 style="font-family:Arial, Helvetica,sans-serif;color:#000;font-size:22px">Hola nuevamente.</h2>';
				$email_body .= '<p><strong>'.$web['title'].'</strong> te envia una nueva contrase&ntilde;a para ingresar a tu cuenta:</p>';
				$email_body .= '<p>Nick: '.$user->get_nick($data['e_user']).'<br />Contrase&ntilde;a: '.$pass.'</p>';
				$email_body .= '<p>Gracias por realizar este proceso de recuperaci&oacute;n de cuenta.<br />Att: Equipo de <strong>'.$web['title'].'</strong></p>';
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
					$smarty->assign('error', array('Listo!', 'Hola <strong>'.$user->get_nick($data['e_user']).'</strong>, te hemos enviado nuevamente un correo con tus nuevos datos para identificarte.', 'Identificarme', 'javascript:anonimo.show_login();'));
					$smarty->assign('page', array('title' => $web['title'].' - Recuperar mi cuenta'));
					$smarty->display('error.tpl');
				}
		die;
	}else{
		$smarty->assign('error', array('Oops!', 'La petici&oacute;n que buscas no existe. Por favor intenta reenviarla.', 'Ir al inicio', '/'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
}else{
	$email = secure($_POST['email']);
	if($email){
		$scode = secure($_POST['recaptcha_response_field']);
		$scode2 = secure($_POST['recaptcha_challenge_field']);
		require'PHP/libs/recaptchalib.php';
		$robot = recaptcha_check_answer('6LdHQvASAAAAADBKFRROyYyN58FkXluGPm1Nb-7o', $_SERVER['REMOTE_ADDR'], $scode2, $scode);		
		if(!$robot->is_valid) $send_error = 'El c&oacute;digo de seguridad no es correcto';
		else{
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$user_data = $mysqli->query('SELECT u_id, u_nick, u_email FROM users WHERE LOWER(u_email) = \''.strtolower($email).'\' LIMIT 1')->fetch_assoc();
				$nick = $user_data['u_nick'];
				$email = $user_data['u_email'];
				$datoes = 'correo';
			}else{
				$user_data = $mysqli->query('SELECT u_id, u_nick, u_email FROM users WHERE LOWER(u_nick) = \''.strtolower($email).'\' LIMIT 1')->fetch_assoc();
				$nick = $user_data['u_nick'];
				$email = $user_data['u_email'];
				$datoes = 'nick';
			}
			if(empty($nick)) $send_error = 'El '.$datoes.' que ingresaste, no existe en '.$web['title'];
			else {
				$uid = $user_data['u_id'];
				$time = time();
				$key = $time+$time;
				$key3 = $time-573;
				$code = substr(md5($time.$uid.$email), 0, 20);
				$link = $web['url'].'/recover?type=rec&key='.$key.'&key2='.($time+200).'&key3='.sha1($key3).'&code='.$code;
				$email_to = $email;
				$email_subject = $web['title'].' - Recuperar tu cuenta';
				$email_body = '<div style="background:#0f7dc1;padding:10px;font-family:Arial, Helvetica,sans-serif;color:#000">';
				$email_body .= '<h1 style="color:#FFFFFF; font-weight:bold; font-size:30px;">'.$web['title'].'</h1>';
				$email_body .= '<div style="background:#FFF;padding:10px;font-size:14px">';
				$email_body .= '<h2 style="font-family:Arial, Helvetica,sans-serif;color:#000;font-size:22px">Hola '.$nick.'</h2>';
				$email_body .= '<p>Para recuperar tu cuenta en '.$web['title'].', ingresa al siguiente enlace: <a href="'.$link.'">'.$link.'</a></p>';
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
					$mysqli->query('INSERT INTO emails (e_user, e_email, e_code, e_key, e_ip, e_type, e_date) VALUES (\''.$uid.'\', \''.$email.'\', \''.$code.'\', \''.$key3.'\', \''.$ip.'\', \'2\', \''.$time.'\')');
					$smarty->assign('error', array('Correo enviado!', 'Te hemos enviado un correo con las instrucciones para recuperar tu cuenta. El correo puede tardar hasta 10 minutos en llegar.', 'Ir al inicio', '/'));
					$smarty->assign('page', array('title' => $web['title']));
					$smarty->display('error.tpl');
					die;
				}
			}
		}
	}
	if($send_error){
		$smarty->assign('error', array('Oops!', $send_error, 'Volver', '/recover'));
		$smarty->assign('page', array('title' => $web['title'].' - Error'));
		$smarty->display('error.tpl');
		die;
	}
}

$smarty->assign('page', $page);
?>