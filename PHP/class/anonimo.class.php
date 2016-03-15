<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class anon{
	function login($nick, $pass, $rem){
		global $mysqli, $web, $user;
		if(empty($nick) || empty($pass)) return '0: Faltan datos';
		if(filter_var($nick, FILTER_VALIDATE_EMAIL)){
			$user_data = $mysqli->query('SELECT u_id, u_nick, u_pass, u_status FROM users WHERE LOWER(u_email) = \''.strtolower($nick).'\' LIMIT 1')->fetch_assoc();
			$nick = $user_data['u_nick'];
		}else{
			$user_data = $mysqli->query('SELECT u_id, u_pass, u_status FROM users WHERE LOWER(u_nick) = \''.strtolower($nick).'\' LIMIT 1')->fetch_assoc();
		}
		if(empty($user_data)) return '0: Datos no v&aacute;lidos';
		$pass = substr(md5(sha1($pass).'SMLine'), 0, 35);
		if($pass == $user_data['u_pass']){
			if($user_data['u_status'] == 2) return '0: No haz activado la cuenta, revisa tu correo o haz click en reenviar email de validaci&oacute;n';
			if($user_data['u_status'] == 3){
				//=> BANEADO
				// LO DEJAMOS LOGUIAR :3
			}
			//=> VARIABLES DE SEGURIDAD
			$time = time();
			$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
			$cookie_time = 60*60*24*7*12*10;
			$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
			$key_1 = $user_data['u_id'];
			$key_2 = substr(sha1(md5($time).'SMLine'), 0, 15);
			$key_3 = $time-5915;
			$key = $key_1.'_'.$key_2.'__'.$key_3;
			$user->delete_session();
			if($mysqli->query('INSERT INTO sessions (s_key, s_user, s_ip, s_date, s_update, s_remember) VALUES (\''.$key_2.'\', \''.$key_1.'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.$time.'\', \''.$time.'\', \''.$rem.'\')')){
				$mysqli->query('UPDATE users SET u_online = \'1\' WHERE u_id = \''.$key_1.'\'');
				$host = parse_url($web['url']);
				$host = str_replace('www.', '' , strtolower($host['host']));
				$this_domain = ($host == 'localhost') ? '' : '.' . $host;
				setcookie($cookie_name, $key, (time() + $cookie_time), '/', $this_domain);
				return '1: Redireccionando...';
			}else return '0: No se pudo completar la operaci&oacute;n';
		}else return '0: Datos no v&aacute;lidos';
	}

}
?>