<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class user{
	var $uid = 0;
	var $info = array();
	var $nick = '';
	var $permits = array();
	var $rank = array();
	var $notis = 0;
	var $mps = 0;

	function read(){
		global $mysqli, $web;
		$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
		$cookie = secure($_COOKIE[$cookie_name]);
		if($cookie){
			/*
			// Desde PHP 5.3.0 ( Gasta menos recursos )
			$key_3 = str_replace('_', '', strstr($cookie, '__'))+5915;
			$part_1 = strstr($cookie, '__', true);
			$key_2 = str_replace('_', '', strstr($part_1, '_'));
			$key_1 = strstr($part_1, '_', true);
			$query = $mysqli->query('SELECT s_user FROM sessions WHERE s_user = \''.$key_1.'\' AND s_key = \''.$key_2.'\' AND s_date = \''.$key_3.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			*/
			//=> Antes De PHP 5.3.0 ( Gasta mas recursos )
			$key_3 = str_replace('_', '', strstr($cookie, '__'))+5915;
			$part_1 = explode('__', $cookie);
			$key_2 = str_replace('_', '', strstr($part_1[0], '_'));
			$key_1 = explode('_', $part_1[0]);
			$key_1 = $key_1[0];
			$query = $mysqli->query('SELECT s_user FROM sessions WHERE s_user = \''.$key_1.'\' AND s_key = \''.$key_2.'\' AND s_date = \''.$key_3.'\' LIMIT 1') or die($mysqli->error);
			$data = $query->fetch_assoc();
			if($data){
				$query = $mysqli->query('SELECT u.u_id, u.u_nick, u.u_rank, u.u_status, u.u_points_ava, u.u_update_points, u.u_last_avatar, s.*, ac.u_options FROM users AS u LEFT JOIN users_stats AS s ON u.u_id = s.u_id LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id WHERE u.u_id = \''.$data['s_user'].'\' LIMIT 1');
				$data = $query->fetch_assoc();
				$data['options'] = unserialize($data['u_options']);
				$this->info = $data;
				$this->uid = $data['u_id'];
				$this->nick = $data['u_nick'];
				if($data['u_points_ava'] > 10) $this->info['u_points_ava'] = 10;
				$query_permits = $mysqli->query('SELECT * FROM users_ranks WHERE r_id =  \''.intval($data['u_rank']).'\' LIMIT 1');
				$data_permits = $query_permits->fetch_assoc();
				$this->rank = $data_permits;
				$this->info['flood'] = time()-$this->rank['r_flood'];
				$this->permits = unserialize($data_permits['r_permits']);
				
				$sql_notifica = $mysqli->query('SELECT n_date FROM notifications WHERE n_user_to = \''.$this->uid.'\' AND n_view != \'2\'');
				$this->notis = $sql_notifica->num_rows;
				$sql_mps = $mysqli->query('SELECT m.mp_id FROM (SELECT mp_id FROM mps_replies WHERE rp_to = \''.$this->uid.'\' AND rp_view != \'2\' ORDER BY rp_id DESC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id WHERE m.mp_del_to = \'0\' AND m.mp_del_from = \'0\' GROUP BY m.mp_id');
				$this->mps = $sql_mps->num_rows;
			}
		}else{
			if(!$mysqli->query('SELECT s_user FROM sessions WHERE s_ip = \''.$_SERVER['REMOTE_ADDR'].'\' LIMIT 1')->num_rows){
				$time = time();
				$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
				$cookie_time = 60*60*24*7*12*10;
				$key_1 = 0;
				$key_2 = substr(sha1(md5($time).'SMLine'), 0, 15);
				$key_3 = $time-5915;
				$key = $key_1.'_'.$key_2.'__'.$key_3;
				if($mysqli->query('INSERT INTO sessions (s_key, s_user, s_ip, s_date, s_update, s_remember) VALUES (\''.$key_2.'\', \'0\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.$time.'\', \''.$time.'\', \'0\')')){
					$host = parse_url($web['url']);
					$host = str_replace('www.', '' , strtolower($host['host']));
					$this_domain = ($host == 'localhost') ? '' : '.' . $host;
					setcookie($cookie_name, $key, (time() + $cookie_time), '/', $this_domain);
				}
			}
				
		}
	}
	
	function sm_update(){
		global $mysqli, $web;
		if($this->uid){
			$mysqli->query('UPDATE users SET u_last_active = \''.time().'\' WHERE u_id = \''.$this->uid.'\'');
			// ACTUALIZAMOS LOS PUNTOS x DAR
			$next_update = time()-(60*60*$web['points_update']);
			if($data['u_update_points'] < $next_update){
				$mysqli->query('UPDATE users SET u_update_points = \''.time().'\', u_points_ava = \''.$this->rank['r_pxd'].'\' WHERE u_id = \''.$this->uid.'\'');
			}
			// ACTUALIZAMOS MEDALLAS CADA 24 HRS
				$next_medals = time()-(60*60*24);
				if($this->info['u_update_medals'] < $next_medals){
					$this->check_medals();
					$mysqli->query('UPDATE users_stats SET u_update_medals = \''.time().'\' WHERE u_id = \''.$this->uid.'\'');
				}
				$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
				if($this->info['u_last_ip'] != $ip) $mysqli->query('UPDATE users SET u_last_ip = \''.$ip.'\' WHERE u_id = \''.$this->uid.'\'');
		}
		$data_sess = $this->get_session();
		if($data_sess['s_id']){
			$mysqli->query('UPDATE sessions SET s_update = '.time().' WHERE s_id = \''.$data_sess['s_id'].'\' LIMIT 1');
		}
	}
	
	function get_session(){
		global $mysqli, $web;
		$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
		$cookie = secure($_COOKIE[$cookie_name]);
		if($cookie){
			$key_3 = str_replace('_', '', strstr($cookie, '__'))+5915;
			$part_1 = strstr($cookie, '__', true);
			$key_2 = str_replace('_', '', strstr($part_1, '_'));
			$key_1 = strstr($part_1, '_', true);
			$query = $mysqli->query('SELECT s_user, s_id FROM sessions WHERE s_user = \''.$key_1.'\' AND s_key = \''.$key_2.'\' AND s_date = \''.$key_3.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			if($data) return $data;
			else return false;
		}else return false;
	}
	
	function delete_session(){
		global $mysqli, $web;
		$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
		$session = $this->get_session();
		if($session){
			$mysqli->query('DELETE FROM sessions WHERE s_id = \''.intval($session['s_id']).'\' LIMIT 1');
			$host = parse_url($web['url']);
				$host = str_replace('www.', '' , strtolower($host['host']));
				$this_domain = ($host == 'localhost') ? '' : '.' . $host;
			setcookie($cookie_name, '', (time() - 999*999), '/', $this_domain);
		}
	}
	
	function check_medals(){
		global $mysqli;
		
		$q_medals = $mysqli->query('SELECT m_id, m_cant, m_rank, m_type FROM admin_medals');
		while($row = $q_medals->fetch_assoc()){
			if($this->info['u_points'] >= $row['m_cant'] && $row['m_type'] == 1) $this->insert_medal($row['m_id']);
			if($row['m_type'] == 2){
				$q_dados = $mysqli->query('SELECT COUNT(v_val) AS total FROM votes WHERE v_user = \''.$this->uid.'\' AND v_type = \'1\'');
				$data_dados = $q_dados->fetch_assoc();
				$puntos_dados = $data_dados['total'];
				if($puntos_dados >= $row['m_cant']) $this->insert_medal($row['m_id']);
			}
			if($this->info['u_posts'] >= $row['m_cant'] && $row['m_type'] == 3) $this->insert_medal($row['m_id']);
			if($this->info['u_topics'] >= $row['m_cant'] && $row['m_type'] == 4) $this->insert_medal($row['m_id']);
			if($this->info['u_images'] >= $row['m_cant'] && $row['m_type'] == 5) $this->insert_medal($row['m_id']);
			if($this->info['u_comments'] >= $row['m_cant'] && $row['m_type'] == 6) $this->insert_medal($row['m_id']);
			if($this->info['u_replies'] >= $row['m_cant'] && $row['m_type'] == 7) $this->insert_medal($row['m_id']);
			if($row['m_type'] == 8){
				$q_icomments = $mysqli->query('SELECT c_type FROM comments WHERE c_user = \''.$this->uid.'\' AND (c_type = \'3\' OR c_type = \'4\')');
				$images_comments = $q_icomments->num_rows;
				if($images_comments >= $row['m_cant']) $this->insert_medal($row['m_id']);
			}
			if($this->info['u_follows'] >= $row['m_cant'] && $row['m_type'] == 9) $this->insert_medal($row['m_id']);
			if($this->rank['r_id'] == $row['m_rank'] && $row['m_type'] == 10) $this->insert_medal($row['m_id']);
		}
	}
	
	function insert_medal($m_id){
		global $mysqli;
		$i_get = $mysqli->query('SELECT ma_id FROM admin_medals_assign WHERE m_id = \''.$m_id.'\' AND ma_user = \''.$this->uid.'\'');
		if(empty($i_get->num_rows)){
			$mysqli->query('INSERT INTO admin_medals_assign (m_id, ma_user, ma_date) VALUES(\''.$m_id.'\', \''.$this->uid.'\', \''.time().'\')');
			$mysqli->query('INSERT INTO notifications (n_type, n_type_id, n_user_from, n_user_to, n_date) VALUES (\'45\', \''.$m_id.'\', \'0\', \''.$this->uid.'\', \''.time().'\')');
		}
	}
	
	function is_online($uid){
		global $mysqli, $web;
		$online_time = time() - (60*$web['user_online']);
		$query = $mysqli->query('SELECT u_id, u_online FROM users WHERE u_id = \''.$uid.'\' AND u_last_active > \''.$online_time.'\'');
		if($query->num_rows) return true;
		else return false;
	}
	
	function user_exist($uid){
		global $mysqli;
		$query = $mysqli->query('SELECT u_id FROM users WHERE u_id =  \''.$uid.'\'');
		$exist = $query->num_rows;
		return $exist;
	}
	
	function get_nick($uid){
		global $mysqli;
		$query = $mysqli->query('SELECT u_nick FROM users WHERE u_id =  \''.$uid.'\'');
		$data = $query->fetch_assoc();
		return $data['u_nick'];
	}
	
	function get_uid($nick){
		global $mysqli;
		$query = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_nick) =  \''.strtolower($nick).'\'');
		$data = $query->fetch_assoc();
		return $data['u_id'];
	}
	
	function follow($uid){
		global $mysqli, $activity, $notifica;
		if($this->info['u_flood_follow'] > $this->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
		if(!$this->user_exist($uid)) return '0: El usuario no existe o fue eliminado';
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$this->uid.'\' AND f_type_id = \''.$uid.'\' AND f_type = \'1\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['f_type'])){
            if($this->uid == $uid) return '0: No puedes seguirte a ti mismo';
			if($mysqli->query('INSERT INTO follows (f_type, f_type_id, f_user, f_date) VALUES (\'1\', \''.$uid.'\', \''.$this->uid.'\', \''.time().'\')')){
				$mysqli->query('UPDATE users_stats SET u_follows = u_follows + 1 WHERE u_id = \''.$uid.'\'');
				$mysqli->query('UPDATE users_stats SET u_following = u_following + 1 WHERE u_id = \''.$this->uid.'\'');
				$mysqli->query('UPDATE users_stats SET u_flood_follow = \''.time().'\' WHERE u_id = \''.$this->uid.'\'');
				$activity->insert(13, $uid, $this->uid);
				$notifica->insert(13, $uid, $uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Ya est&aacute; en tu lista de seguidores';
	}
	
	function unfollow($uid){
		global $mysqli, $activity;
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$this->uid.'\' AND f_type_id = \''.$uid.'\' AND f_type = \'1\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['f_type']){
			if($mysqli->query('DELETE FROM follows WHERE f_type = \'1\' AND f_user = \''.$this->uid.'\' AND f_type_id = \''.$uid.'\' LIMIT 1')){
				$mysqli->query('UPDATE users_stats SET u_follows = u_follows - 1 WHERE u_id = \''.$uid.'\'');
				$mysqli->query('UPDATE users_stats SET u_following = u_following - 1 WHERE u_id = \''.$this->uid.'\'');
				$activity->delete(13, $uid, $this->uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: No est&aacute; en tu lista de seguidores';
	}
	
	function is_following($type, $type_id){
		global $mysqli;
		switch($type){
			case 'user':
				$type = 1;
			break;
			case 'post':
				$type = 2;
			break;
			case 'image':
				$type = 3;
			break;
			case 'comu':
				$type = 4;
			break;
			case 'topic':
				$type = 5;
			break;
			default:
				$type = 1;
			break;
		}
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$this->uid.'\' AND f_type_id = \''.$type_id.'\' AND f_type = \''.$type.'\' LIMIT 1');
		$is_following = $query->num_rows;
		return $is_following;
	}
	
	function cerrar($user_id = 0, $all_sessions = false){
		global $mysqli, $web;
		$user_id = empty($user_id) ? $this->uid : $user_id;
		if($user_id != $this->uid){
			$query = $mysqli->query('DELETE FROM sessions WHERE s_user = \''.$user_id.'\' LIMIT 1');
			return '1: OKAY';
		}
		$cookie_name = 'LS_'.substr(md5($web['url']), 0, 6);
		$cookie = secure($_COOKIE[$cookie_name]);
		if($cookie && $user_id){
			$key_3 = str_replace('_', '', strstr($cookie, '__'))+5915;
			$part_1 = strstr($cookie, '__', true);
			$key_2 = str_replace('_', '', strstr($part_1, '_'));
			$key_1 = strstr($part_1, '_', true);
			$query = $mysqli->query('SELECT s_id, s_user FROM sessions WHERE s_user = \''.$key_1.'\' AND s_key = \''.$key_2.'\' AND s_date = \''.$key_3.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			if($data){
				$mysqli->query('UPDATE users SET u_online = \'0\' WHERE u_id = \''.$user_id.'\'');
				$mysqli->query('DELETE FROM sessions WHERE s_id = \''.intval($data['s_id']).'\' LIMIT 1');
				if($all_sessions) $mysqli->query('DELETE FROM sessions WHERE s_user = \''.intval($data['s_user']).'\'');
				$host = parse_url($web['url']);
				$host = str_replace('www.', '' , strtolower($host['host']));
				$this_domain = ($host == 'localhost') ? '' : '.' . $host;
				setcookie($cookie_name, '', (time() - 999*999), '/', $this_domain);
				return '1: Software by <b>SMline</b>';
			}else return '0: Al parecer no te encuentras logueado';
		}else return '0: Al parecer ya no est&aacute;s logueado';
	}
	
	function banned($uid){
		global $mysqli, $web, $user;
		if(empty($user->permits['su'])) return '0: No tienes permisos para esto';
		$query_u = $mysqli->query('SELECT u_rank, u_status FROM users WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data_u = $query_u->fetch_assoc();
		if($data_u['u_status'] == 3 || empty($data_u)) return '0: Este usuario ya se encuentra suspendido';
		else if($user->info['u_rank'] > 1 && $data_u['u_rank'] <= 2 && $user->uid > 1) return '0: No puedes suspender a usuarios con un rango mayor o igual al tuyo';
		else if($user->uid == $uid) return '0: Si est&aacute;s cansado de la web, dile a un admin que te banee';
		// VARIABLES
		$b_reason = secure($_POST['razon_desc']);
		$b_duration_type = secure($_POST['duration']);
		$b_total_val = secure($_POST['total_val']);
		$b_times = array(0, 3600, 86400);
		//
		if($b_duration_type == 0) $b_end = 0;
		else $b_end = time()+($b_times[$b_duration_type]*$b_total_val);
		// INSERTAMOS
		$mysqli->query('INSERT INTO users_bans (ub_user, ub_reason, ub_mod, ub_date, ub_end) VALUES (\''.$uid.'\', \''.$b_reason.'\', \''.$user->uid.'\', \''.time().'\', \''.$b_end.'\')');
		$mysqli->query('UPDATE users SET u_status = \'3\' WHERE u_id = \''.$uid.'\' LIMIT 1');
		$end_msj = $b_end == 0 ? 'nunca' : date('d/m/Y h:i:s A', $b_end);
		return '1: Usuario suspendido correctamente hasta <b>'.$end_msj.'</b>';
	}
	
	function unbanned($uid){
		global $mysqli, $web, $user;
		if(empty($user->permits['ru'])) return '0: No tienes permisos para esto';
		$query_u = $mysqli->query('SELECT u_rank, u_status FROM users WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data_u = $query_u->fetch_assoc();
		if($data_u['u_status'] != 3 || empty($data_u)) return '0: Este usuario no se encuentra suspendido';
		$query_s = $mysqli->query('SELECT ub_id, ub_mod FROM users_bans WHERE ub_user = \''.$uid.'\' LIMIT 1');
		$data_s = $query_s->fetch_assoc();
		//if($user->info['u_rank'] == 1 || $data_s['ub_mod'] == $user->uid){
		if($data_s['ub_mod'] == $user->uid){
			$mysqli->query('DELETE FROM users_bans WHERE ub_id = \''.$data_s['ub_id'].'\' LIMIT 1');
			$mysqli->query('UPDATE users SET u_status = \'1\' WHERE u_id = \''.$uid.'\' LIMIT 1');
			return '1: Usuario reactivado correctamente';
		}else return '0: Solo puedes reactivar usuarios que tu mismo suspendas';
	}
	
	function send_report($tid, $type){
		global $mysqli, $user;
		//VARIABLES
		$reason = secure($_POST['reason']);
		$last_report = time()-(60*5); // 5 minutos
		if(es_nulo($reason)) return '0: Ingresa la raz&oacute;n o especificaci&oacute;n';
		switch($type){
			case 'post':
				$query = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$tid.'\' LIMIT 1');
				if(!$query->num_rows) return '0: El post que quieres reportar no existe';
				$data = $query->fetch_assoc();
				if($data['p_user'] == $user->uid) return '0: No puedes reportar tus propios posts';
				$re_text = 'un mismo post';
				$type = 1;
			break;
			case 'imagen':
				$query = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$tid.'\' LIMIT 1');
				if(!$query->num_rows) return '0: La imagen que quieres reportar no existe';
				$data = $query->fetch_assoc();
				if($data['i_user'] == $user->uid) return '0: No puedes reportar tus propias im&aacute;genes';
				$re_text = 'una misma imagen';
				$type = 2;
			break;
			case 'tema':
				$query = $mysqli->query('SELECT t_user FROM comus_topics WHERE t_id = \''.$tid.'\' LIMIT 1');
				if(!$query->num_rows) return '0: El tema que quieres reportar no existe';
				$data = $query->fetch_assoc();
				if($data['t_user'] == $user->uid) return '0: No puedes reportar tus propios temas';
				$re_text = 'un mismo tema';
				$type = 3;
			break;
			case 'mensaje':
				$query = $mysqli->query('SELECT mp_user FROM mps WHERE mp_id = \''.$tid.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
				if(!$query->num_rows) return '0: El mensaje que quieres reportar no te pertenece';
				$data = $query->fetch_assoc();
				if($data['mp_user'] == $user->uid) return '0: No puedes reportar tus propios mensajes';
				$re_text = 'un mismo mensaje';
				$type = 4;
			break;
			case 'usuario':
				$query = $mysqli->query('SELECT u_id FROM users WHERE u_id = \''.$tid.'\' LIMIT 1');
				if(!$query->num_rows) return '0: El usuario que quieres reportar no existe';
				$data = $query->fetch_assoc();
				if($data['u_id'] == $user->uid) return '0: No puedes reportarte a ti mismo';
				$re_text = 'un mismo usuario';
				$type = 5;
			break;
			case 'comunidad':
				$query = $mysqli->query('SELECT comu_admin FROM comus WHERE comu_id = \''.$tid.'\' LIMIT 1');
				if(!$query->num_rows) return '0: La comunidad que quieres reportar no existe';
				$data = $query->fetch_assoc();
				if($data['comu_admin'] == $user->uid) return '0: No puedes reportar tus propias comunidades';
				$re_text = 'una misma comunidad';
				$type = 6;
			break;
			default:
				return '0: Powered by SMline.Net';
			break;
		}
		$query_r = $mysqli->query('SELECT r_id FROM reports WHERE r_user = \''.$user->uid.'\' AND r_date > \''.$last_report.'\' LIMIT 1');
		if($query_r->num_rows) return '0: No puedes reportar tantas veces seguidas, int&eacute;ntalo de nuevo en unos minutos';
		$query_r2 = $mysqli->query('SELECT r_id FROM reports WHERE r_user = \''.$user->uid.'\' AND r_type = \''.$type.'\' AND r_type_id = \''.$tid.'\' LIMIT 1');
		if($query_r2->num_rows) return '0: No puedes reportar '.$re_text.' m&aacute;s de una vez';
		// INSERTAMOS
		$mysqli->query('INSERT INTO reports (r_type, r_type_id, r_user, r_reason, r_date) VALUES (\''.$type.'\', \''.$tid.'\', \''.$user->uid.'\', \''.$reason.'\', \''.time().'\')');
		return '1: Reporte enviado a moderaci&oacute;n correctamente';
	}
	
	function setting($set, $uid){
		global $mysqli;
		$query = $mysqli->query('SELECT u_options FROM users_accounts WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$result = unserialize($data['u_options']);
		
		if($result[$set] == 0) return 1;
		else if($result[$set] == 1){
			$me_sigue = $mysqli->query('SELECT f_type FROM follows WHERE f_type = \'1\' AND f_user = \''.$uid.'\' AND f_type_id = \''.$this->uid.'\' LIMIT 1');
			if($me_sigue->num_rows == 1) return 1;
			else return 2;
		}else return false;
	}

	function set_block($uid){
		global $mysqli;
		if(!$this->user_exist($uid)) return '0: El usuario que quieres bloquear no existe';
		$query = $mysqli->query('SELECT b_id FROM users_blocks WHERE b_user = \''.$this->uid.'\' AND b_to_user = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['b_id'])){
            if($this->uid == $uid) return '0: No puedes bloquearte a ti mismo';
			if($mysqli->query('INSERT INTO users_blocks (b_user, b_to_user) VALUES (\''.$this->uid.'\', \''.$uid.'\')')){
				return '1: Usuario bloqueado correctamente';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Este usuario ya se encuentra bloqueado';
	}
	
	function set_unblock($uid){
		global $mysqli;
		if(!$this->user_exist($uid)) return '0: El usuario que quieres bloquear no existe';
		$query = $mysqli->query('SELECT b_id FROM users_blocks WHERE b_user = \''.$this->uid.'\' AND b_to_user = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!empty($data['b_id'])){
            if($this->uid == $uid) return '0: No puedes desbloquearte a ti mismo';
			if($mysqli->query('DELETE FROM users_blocks WHERE b_id = \''.$data['b_id'].'\' LIMIT 1')){
				return '1: Usuario desbloqueado correctamente';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Este usuario no se encuentra bloqueado';
	}
	
	function i_block($uid){
		global $mysqli;
		$query_block = $mysqli->query('SELECT b_id FROM users_blocks WHERE b_to_user = \''.$this->uid.'\' AND b_user = \''.$uid.'\' LIMIT 1');
		if($query_block->num_rows) return true;
		else return false;
	}
	
	function get_users(){
		global $mysqli;
		// VARIABLES
		$_GET['order'] = secure($_GET['order']);
		if($_GET['order'] == 'nombre') $order = 'ORDER BY u.u_nick ASC';
		elseif($_GET['order'] == 'registro') $order = 'ORDER BY u.u_date DESC';
		else $order = 'ORDER BY u.u_last_active DESC';
		$limit = 12;
		$page = intval($_GET['page']);
		if(empty($page)){
			$start = 0;
			$page = 1;
		}else $start = ($page - 1) * $limit;
		
		// SQL PRINCIPAL
		$query = $mysqli->query('SELECT u.u_id, u.u_nick, u.u_last_avatar, u.u_country, u.u_last_active, u.u_date, u.u_sex, s.u_posts, s.u_points, ac.u_bio, r.r_image, r.r_name FROM users AS u LEFT JOIN users_stats AS s ON s.u_id = u.u_id LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank WHERE u.u_status = \'1\' '.$order.' LIMIT '.$start.', '.$limit) or die($mysqli->error);
		while($row = $query->fetch_assoc()) $data['list'][] = $row;
		
		// SQL TOTAL
		$query_total = $mysqli->query('SELECT u_id FROM users WHERE u_status = \'1\'');
		$data['total'] = $query_total->num_rows;
		
		// GET URL
		$pagina_url = '?order='.secure($_GET['order']).'&';
		
		// PAGINACION
		if($data['total'] > $limit) $data['pages'] = pagination($page, $data['total'], $limit, $pagina_url, true);
		
		// DATOS
		$data['start'] = ($page * $limit) - ($limit - 1);
		$data['end'] = ($page * $limit);
		
		// RECOMENDADOS
		$query = $mysqli->query('SELECT u.u_nick, u.u_id, u.u_last_avatar, (s.u_follows + s.u_points + s.u_comments + (s.u_posts * 4)) AS total FROM users AS u LEFT JOIN users_stats AS s ON s.u_id = u.u_id ORDER BY total DESC LIMIT 60');
		$i = 1;
		$u[1] = rand(1, 15);
		$u[2] = rand(16, 30);
		$u[3] = rand(31, 45);
		$u[4] = rand(46, 60);
		while($row = $query->fetch_assoc()){
			if($i == $u[1] || $i == $u[2] || $i == $u[3] || $i == $u[4]) $data['recomendados'][] = $row;
			$i++;
		}
		
		// RESULTADO
		return $data;
	}
}
?>