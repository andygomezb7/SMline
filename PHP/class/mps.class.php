<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class mps{

	function send_mp(){
		global $mysqli, $user;
		// PERMISOS
		if(empty($user->permits['em'])) return '0: Tu rango no te permite enviar mensajes a este usuario';
		
		// FLOOD
		if($user->info['u_flood_mp'] > (time() - 60)) return '0: No puedes enviar tantos mensajes seguidos, espera unos minutos e int&eacute;ntalo de nuevo';
		
		// VARIABLES
		$mp_to = secure($_POST['mp_to']);
		$mp_uid = $user->get_uid($mp_to);
		$mp_subject = empty($_POST['mp_subject']) ? '(sin asunto)' : secure($_POST['mp_subject']);
		$mp_body = secure($_POST['mp_body']);
		$mp_ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		
		// REMITENTE
		if(es_nulo($mp_to)) return '0: Ingresa un remitente v&aacute;lido';
		else if(es_nulo($mp_uid)) return '0: El usuario que buscas, no existe';
		else if($mp_uid == $user->uid) return '0: No puedes enviarte mensajes a ti mismo';
		// CUERPO
		else if(es_nulo($mp_body)) return '0: Ingresa el mensaje a enviar';
		
		// RECAPTCHA
		if($user->permits['cm']){
			require'PHP/libs/recaptchalib.php';
			$recaptcha = secure($_POST['recaptcha_response_field']);
			$recaptcha_2 = secure($_POST['recaptcha_challenge_field']);
			$robot = recaptcha_check_answer(PRIVATE_KEY, $mp_ip, $recaptcha_2, $recaptcha);		
			if(!$robot->is_valid) return '0: El c&oacute;digo de seguridad no es v&aacute;lido';
		}
		
		// MAXIMO DE MENSAJES
		if($user->permits['emm']){
			$hora = time()-(60*60);
			$query_mps = $mysqli->query('SELECT mp_id FROM mps WHERE mp_user = \''.$user->uid.'\' AND mp_date > \''.$hora.'\'');
			if($query_mps->num_rows > $user->permits['emm']) return '0: Tu rango no te permite enviar mas mensajes por el momento, int&eacute;ntalo de nuevo m&aacute;s tarde';
		}
		
		// CONFIG DEL REMITENTE
		$user_config = $user->setting('mensajes', $mp_uid);
		if($user_config != 1){
			if($user_config == 2) return '0: '.$mp_to.' recibe mensajes &uacute;nicamente de usarios que sigue';
			else return '0: '.$mp_to.' no recibe mensajes de nadie';
		}
		
		//BLOQUEADO
		if($user->i_block($mp_uid)) return '0: '.$mp_to.' te ha bloqueado, no puedes enviarle mensajes';
		
		// INSERTAMOS
		$mysqli->query('INSERT INTO mps (mp_user, mp_to, mp_subject, mp_date, mp_update, mp_ip) VALUES (\''.$user->uid.'\', \''.$mp_uid.'\', \''.$mp_subject.'\', \''.time().'\', \''.time().'\', \''.$mp_ip.'\')');
		$mp_id = $mysqli->insert_id;
		
		// EN RESPUESTAS
		$mysqli->query('INSERT INTO mps_replies (mp_id, rp_user, rp_to, rp_body, rp_date, rp_ip) VALUES (\''.$mp_id.'\', \''.$user->uid.'\', \''.$mp_uid.'\', \''.$mp_body.'\', \''.time().'\', \''.$mp_ip.'\')');
		
		// ACTUALIZAR FLOOD
		$mysqli->query('UPDATE users_stats SET u_flood_mp =  \''.time().'\' WHERE u_id = \''.$user->uid.'\' LIMIT 1');
		return '1: MP enviado';
	}
	
	function send_replie(){
		global $mysqli, $user;		
		// FLOOD
		if($user->info['u_flood_mp'] > $user->info['flood']) die('0: No puedes enviar tantos mensajes seguidos, espera unos minutos e int&eacute;ntalo de nuevo');
		
		// VARIABLES
		$mp_id = intval($_POST['mp_id']);
		$mp_body = secure($_POST['mp_body']);
		$mp_ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		
		// DATOS MP
		$query = $mysqli->query('SELECT mp_id, mp_user, mp_to, mp_del_to, mp_del_from FROM mps WHERE mp_id = \''.$mp_id.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
		$data_mp = $query->fetch_assoc();
		
		// SOY PARTE DE LA CONVERSACION?
		if(empty($data_mp['mp_id'])) die('0: El mensaje que buscas no existe'.$_POST['mp_id']);
		
		$mp_uid = $data_mp['mp_user'] != $user->uid ? $data_mp['mp_user'] : $data_mp['mp_to'];
		
		// CUERPO
		if(es_nulo($mp_body)) die('0: Ingresa al respuesta a enviar');
		
		// MP BORRADO
		if($data_mp['mp_del_to'] || $data_mp['mp_del_from']) die('0: El remitente de este mensaje ha suprimido esta conversaci&oacute;n');
		
		//BLOQUEADO
		if($user->i_block($mp_uid)) die('0: '.$user->get_nick($mp_uid).' te ha bloqueado, no puedes enviarle respuestas');
		
		// 
		$mysqli->query('UPDATE mps SET mp_update = \''.time().'\' WHERE mp_id = \''.$mp_id.'\' LIMIT 1');
		
		// EN RESPUESTAS
		$mysqli->query('INSERT INTO mps_replies (mp_id, rp_user, rp_to, rp_body, rp_date, rp_ip) VALUES (\''.$mp_id.'\', \''.$user->uid.'\', \''.$mp_uid.'\', \''.$mp_body.'\', \''.time().'\', \''.$mp_ip.'\')');
		$rp_id = $mysqli->insert_id;
		
		// ACTUALIZAR FLOOD
		$mysqli->query('UPDATE users_stats SET u_flood_mp =  \''.time().'\' WHERE u_id = \''.$user->uid.'\' LIMIT 1');
		
		// LIBS
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$rp_bbody = $bbcode->start($mp_body);
		return array($rp_id, $rp_bbody, time());
	}
	
	function mps_data(){
		global $mysqli, $user;
		// CONSULTAS
		$data['recibidos'] = $mysqli->query('SELECT mp_id FROM mps WHERE mp_del_to = \'0\' AND mp_to = \''.$user->uid.'\'')->num_rows;
		$data['enviados'] = $mysqli->query('SELECT mp_id FROM mps WHERE mp_del_from = \'0\' AND mp_user = \''.$user->uid.'\'')->num_rows;
		$data['eliminados'] = $mysqli->query('SELECT mp_id FROM mps WHERE (mp_del_to = \'1\' AND mp_to = \''.$user->uid.'\') OR (mp_del_from = \'1\' AND mp_user = \''.$user->uid.'\')')->num_rows;
		return $data;
	}
	
	function generate($type, $start = 0, $limit = 15){
		global $mysqli, $user;
		$start = $start * $limit;
		switch($type){
			case 'live':
				$time_live = time()-60;
				$query = $mysqli->query('SELECT r.rp_id, r.rp_user, r.rp_body, r.rp_date, m.mp_subject, m.mp_id, u.u_nick, u.u_last_avatar FROM mps_replies AS r LEFT JOIN mps AS m ON m.mp_id = r.mp_id LEFT JOIN users AS u ON u.u_id = r.rp_user WHERE r.rp_to = \''.$user->uid.'\' AND r.rp_view = \'0\' AND r.rp_date > \''.$time_live.'\' GROUP BY m.mp_id ORDER BY r.rp_id DESC');
				while($row = $query->fetch_assoc()){
					$data[] = $row;
					$mysqli->query('UPDATE mps_replies SET rp_view = \'1\' WHERE rp_id = \''.$row['rp_id'].'\'');
				}
			break;
			case 'monitor':
				$query = $mysqli->query('SELECT m.mp_subject, m.mp_id, m.mp_user, u.u_nick, u.u_last_avatar, sub.* FROM (SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies WHERE rp_to = \''.$user->uid.'\' ORDER BY rp_id DESC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN users AS u ON u.u_id = sub.rp_user WHERE m.mp_del_to = \'0\' AND m.mp_del_from = \'0\' GROUP BY m.mp_id ORDER BY sub.rp_date DESC LIMIT '.$start.', '.$limit);
				$i = 0;
				while($row = $query->fetch_assoc()){
					$data[$i] = $row;
					$data[$i]['rp_body'] = get_meta_description($row['rp_body']);
					if($row['rp_view'] != 2) $mysqli->query('UPDATE mps_replies SET rp_view = \'2\' WHERE rp_id = \''.$row['rp_id'].'\'');
					$i++;
				}
			break;
			case 'recibidos':
				$page = intval($_GET['page']);
				if(empty($page)){
					$start = 0;
					$page = 1;
				}else $start = ($page - 1) * $limit;
				$query = $mysqli->query('SELECT m.mp_subject, m.mp_id, m.mp_user, u.u_id, u.u_nick, u.u_last_avatar, sub.* FROM (SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies WHERE rp_to = \''.$user->uid.'\' ORDER BY rp_id DESC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE m.mp_del_to = \'0\' AND m.mp_to = \''.$user->uid.'\' GROUP BY m.mp_id ORDER BY sub.rp_date DESC LIMIT '.$start.', '.$limit);
				$i = 0;
				while($row = $query->fetch_assoc()){
					$data['list'][$i] = $row;
					$data['list'][$i]['rp_body'] = get_meta_description($row['rp_body']);
					if($row['rp_view'] != 2) $mysqli->query('UPDATE mps_replies SET rp_view = \'2\' WHERE rp_id = \''.$row['rp_id'].'\'');
					$i++;
				}
				$query_total = $mysqli->query('SELECT mp_id FROM mps WHERE mp_del_to = \'0\' AND mp_to = \''.$user->uid.'\'');
				$data['pages'] = $this->mps_pages($page, $query_total->num_rows, $limit);
			break;
			case 'enviados':
				$page = intval($_GET['page']);
				if(empty($page)){
					$start = 0;
					$page = 1;
				}else $start = ($page - 1) * $limit;
				$query = $mysqli->query('SELECT m.mp_subject, m.mp_id, m.mp_user, u.u_id, u.u_nick, u.u_last_avatar, sub.* FROM (SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies WHERE rp_user = \''.$user->uid.'\' ORDER BY rp_id DESC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN users AS u ON u.u_id = m.mp_to WHERE m.mp_del_from = \'0\' AND m.mp_user = \''.$user->uid.'\' GROUP BY m.mp_id ORDER BY sub.rp_date DESC LIMIT '.$start.', '.$limit);
				$i = 0;
				while($row = $query->fetch_assoc()){
					$data['list'][$i] = $row;
					$data['list'][$i]['rp_body'] = get_meta_description($row['rp_body']);
					$i++;
				}
				$query_total = $mysqli->query('SELECT mp_id FROM mps WHERE mp_del_from = \'0\' AND mp_user = \''.$user->uid.'\'');
				$data['pages'] = $this->mps_pages($page, $query_total->num_rows, $limit);
			break;
			case 'eliminados':
				$page = intval($_GET['page']);
				if(empty($page)){
					$start = 0;
					$page = 1;
				}else $start = ($page - 1) * $limit;
				$query = $mysqli->query('SELECT m.mp_subject, m.mp_id, m.mp_user, u.u_id, u.u_nick, u.u_last_avatar, sub.* FROM (SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies ORDER BY rp_id DESC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE (mp_del_to = \'1\' AND mp_to = \''.$user->uid.'\') OR (mp_del_from = \'1\' AND mp_user = \''.$user->uid.'\') GROUP BY m.mp_id ORDER BY sub.rp_date DESC LIMIT '.$start.', '.$limit);
				$i = 0;
				while($row = $query->fetch_assoc()){
					$data['list'][$i] = $row;
					$data['list'][$i]['rp_body'] = get_meta_description($row['rp_body']);
					$i++;
				}
				$query_total = $mysqli->query('SELECT mp_id FROM mps WHERE (mp_del_to = \'1\' AND mp_to = \''.$user->uid.'\') OR (mp_del_from = \'1\' AND mp_user = \''.$user->uid.'\')');
				$data['pages'] = $this->mps_pages($page, $query_total->num_rows, $limit);
			break;
			default:
				return '0: Error 404';
			break;
		}
		return $data;
	}
	
	function mps_pages($page, $total, $max){
		global $web;
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Siguiente" href="?page='.($page - 1).'">&#171;</a>';
		$total_pages = ceil($total / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" href="?page='.$i.'">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" href="?page='.($page + 1).'">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
	function read_mp($mp_id){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT m.mp_id, m.mp_user, m.mp_to, m.mp_del_to, m.mp_del_from, m.mp_subject, m.mp_date, u.u_nick, u.u_id, u.u_last_avatar FROM mps AS m LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE m.mp_id = \''.$mp_id.'\' AND (m.mp_user = \''.$user->uid.'\' OR m.mp_to = \''.$user->uid.'\') LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return 'Este mensaje no existe o no te pertenece';
		
		// IS DELETE?
		if(($data['mp_del_to'] == 2 && $user->uid == $data['mp_to']) || ($data['mp_del_from'] == 2 && $user->uid == $data['mp_user'])) return 'El mensaje que buscas ya no existe';
		
		// LIBS
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		
		// RESPUESTAS
		$query_replies = $mysqli->query('SELECT r.rp_id, r.rp_user, r.rp_body, r.rp_date, r.rp_view, u.u_nick, u.u_last_avatar FROM mps_replies AS r JOIN users AS u ON u.u_id = r.rp_user WHERE r.mp_id = \''.$data['mp_id'].'\' ORDER BY r.rp_id ASC');
		$i = 0;
		while($row = $query_replies->fetch_assoc()){
			$data['replies'][$i] = $row;
			$data['replies'][$i]['rp_body'] = $bbcode->start($row['rp_body']);
			if($row['rp_read'] == 0) $mysqli->query('UPDATE mps_replies SET rp_read = \'1\', rp_view = \'2\' WHERE rp_id = \''.$row['rp_id'].'\' LIMIT 1');
			$i++;
		}
		
		// RETORNAMOS EL RESULTADO
		return $data;
	}
	
	function del_mp($mp_id, $type){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT mp_id, mp_user, mp_to, mp_del_to, mp_del_from FROM mps WHERE mp_id = \''.$mp_id.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: El mensaje que buscas no te pertenece';
		
		// QUIEN LO BORRA
		$type = empty($type) ? 1 : 2;
		$user_del = $data['mp_user'] == $user->uid ? 'mp_del_from' : 'mp_del_to';
		$user_no_del = $data['mp_user'] != $user->uid ? 'mp_del_from' : 'mp_del_to';
		
		// BORRAR DEFINITVAMENTE
		if($data[$user_no_del] == 2 && $type == 2){
			// BORRAR MP
			$mysqli->query('DELETE FROM mps WHERE mp_id = \''.$data['mp_id'].'\' LIMIT 1');
			// BORRAR RESPUESTAS
			$mysqli->query('DELETE FROM mps_replies WHERE mp_id = \''.$data['mp_id'].'\'');
		}

		$mysqli->query('UPDATE mps SET '.$user_del.' = \''.$type.'\' WHERE mp_id = \''.$data['mp_id'].'\' LIMIT 1');
		
		// RESULTADO
		return '1: Mp is del';
	}
	
	function restaurar_mp($mp_id){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT mp_id, mp_user, mp_to, mp_del_to, mp_del_from FROM mps WHERE mp_id = \''.$mp_id.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: El mensaje que buscas no te pertenece';
		
		// QUIEN LO RESTAURA
		$user_del = $data['mp_user'] == $user->uid ? 'mp_del_from' : 'mp_del_to';
		$mysqli->query('UPDATE mps SET '.$user_del.' = \'0\' WHERE mp_id = \''.$data['mp_id'].'\' LIMIT 1');
		
		// RESULTADO
		return '1: La conversaci&oacute;n fue restaurada exitosamente';
	}
	
	function is_noread($mp_id){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT mp_id, mp_user FROM mps WHERE mp_id = \''.$mp_id.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: El mensaje que buscas no te pertenece';

		if($data['mp_user'] == $user->uid) return '0: No puedes marcar como no le&iacute;dos mensajes enviados por t&iacute;';
		
		$mysqli->query('UPDATE mps_replies SET rp_read = \'0\' WHERE mp_id = \''.$data['mp_id'].'\' AND rp_to = \''.$user->uid.'\' ORDER BY rp_id DESC LIMIT 1');
		
		// RESULTADO
		return '1: Okay';
	}
	
	function is_read($mp_id){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT mp_id, mp_user FROM mps WHERE mp_id = \''.$mp_id.'\' AND (mp_user = \''.$user->uid.'\' OR mp_to = \''.$user->uid.'\') LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: El mensaje que buscas no te pertenece';
		
		if($data['mp_user'] == $user->uid) return '0: No puedes marcar como le&iacute;dos mensajes enviados por t&iacute;';
		
		$mysqli->query('UPDATE mps_replies SET rp_read = \'1\' WHERE mp_id = \''.$data['mp_id'].'\' AND rp_to = \''.$user->uid.'\' ORDER BY rp_id DESC LIMIT 1');
		
		// RESULTADO
		return '1: Okay';
	}
	
}
?>