<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class states{

	function import($return = false, $urlin = null, $type){
		$type = empty($type) ? secure($_POST['type']) : secure($type);
		$url = empty($urlin) ? secure($_POST['url']) : secure($urlin);
		if(empty($url)) return '0: No haz ingresado la url';
		if(strlen($url) > 500) return '0: La url ingresada es demasiado larga';
		switch($type){
			case 'img':
				$data = getimagesize($url);
				$min_w = 130;
				$min_h = 130;
				$max_w = 1024;
				$max_h = 1024;
				if(empty($data[0])) return '0: La url ingresada no existe o no es una imagen v&aacute;lida';
				elseif($data[0] < $min_w || $data[1] < $min_h) return '0: Tu foto debe tener un tama&ntilde;o superior a 130x130 pixeles';
				elseif($data[0] > $max_w || $data[1] > $max_h) return '0: Tu foto debe tener un tama&ntilde;o menor a 1024x1024 pixeles';
				else{
					if($return == false) return '1: <div class="s_import"><center><img class="i_img" src="'.secure($url).'"/></center></div>';
					else return array('URL' => $url);
				}
			break;
			case 'vid':
				$video_id = explode('watch?v=',$url);
				if(!is_array($video_id)) return '0: La direcci&oacute;n del video no es v&aacute;lida';
				$video_id = substr($video_id[1],0,11);
				if(strlen($video_id) != 11) return '0: La direcci&oacute;n del video no es v&aacute;lida';
				$data = @get_meta_tags('http://www.youtube.com/watch?v='.$video_id);
				if(empty($data['title'])) return '0: La URL contiene un ID de video incorrecto o el video ha sido eliminado';
				else{
					if($return == false) return '1: <div class="s_import"><center><div class="video_player"><img class="i_img" src="http://img.youtube.com/vi/'.$video_id.'/mqdefault.jpg"/><i class="player_icon"></i><span class="vid_title" style="top: 0;left: 1px;">'.$data['title'].'</span></div></center></div>';
					else return array('ID' => $video_id, 'title' => $data['title']);
				}
			break;
			default:
				return '0: El campo type es obligatorio.';
			break;
		}
	}
	
	function send(){
		global $user, $mysqli, $activity, $notifica;
		$to_user = (intval($_POST['to_user']) == 0) ? $user->uid : $_POST['to_user'];
		$body =  secure($_POST['body']);
		$url = secure($_POST['url']);
		$type = secure($_POST['type']);
		if($to_user != $user->uid){
			// CONFIG DEL REMITENTE
			$user_config = $user->setting('escribir', $to_user);
			if($user_config != 1){
				$user_nick = $user->get_nick($to_user);
				if($user_config == 2) return '0: Solo usuarios que '.$user_nick.' sigue, pueden escribirle en su muro';
				else return '0: '.$user_nick.' no permite que nadie escriba en su muro';
			}
			//BLOQUEADO
			if($user->i_block($to_user)) die('0: '.$user->get_nick($to_user).' te ha bloqueado, no puedes escribir en su muro');
		}
		if($user->info['u_flood_state'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(!$user->user_exist($to_user)) return '0: El usuario al que le intentas comentar no existe';
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		switch($type){
			case 'sta':
				if(es_nulo($body)) return '0: Tu publicaci&oacute;n debe tener al menos una letra';
				if($mysqli->query('INSERT INTO states (s_user, s_to_user, s_body, s_date, s_type, s_adj, s_ip) VALUES (\''.$user->uid.'\', \''.$to_user.'\', \''.$body.'\', \''.time().'\', \'1\', \''.$url.'\', \''.$_SERVER['REMOTE_ADDR'].'\')')){
					$new_id = $mysqli->insert_id;
					$activity->insert(26, $new_id, $user->uid);
					$notifica->insert(26, $new_id, $to_user);
					$mysqli->query('UPDATE web_stats SET states = states + 1');
					return '1: ';
				}
			break;
			case 'img':
				$check = $this->import(true, $adj, 'img');
				if(substr($check,0,1) == '0') return $check;
				if($mysqli->query('INSERT INTO states (s_user, s_to_user, s_body, s_date, s_type, s_adj, s_ip) VALUES (\''.$user->uid.'\', \''.$to_user.'\', \''.$body.'\', \''.time().'\', \'2\', \''.$url.'\', \''.$_SERVER['REMOTE_ADDR'].'\')')){
					$new_id = $mysqli->insert_id;
					$activity->insert(26, $new_id, $user->uid);
					$notifica->insert(26, $new_id, $to_user);
					$mysqli->query('UPDATE web_stats SET states = states + 1');
					return '1: ';
				}
			break;
			case 'vid':
				$check = $this->import(true, $adj, 'vid');
				if(substr($check,0,1) == '0') return $check;
				if($mysqli->query('INSERT INTO states (s_user, s_to_user, s_body, s_date, s_type, s_adj, s_adj_title, s_ip) VALUES (\''.$user->uid.'\', \''.$to_user.'\', \''.$body.'\', \''.time().'\', \'3\', \''.$check['ID'].'\', \''.$check['title'].'\', \''.$_SERVER['REMOTE_ADDR'].'\')')){
					$new_id = $mysqli->insert_id;
					$activity->insert(26, $new_id, $user->uid);
					$notifica->insert(26, $new_id, $to_user);
					$mysqli->query('UPDATE web_stats SET states = states + 1');
					return '1: ';
				}
			break;
		}
	}
	
	function like($sid, $type){
		global $mysqli, $user, $notifica, $activity;
		$type = $type == 0 ? 0 : 1;
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no es real';
		if(empty($user->uid)) return '0: Reg&iacute;strate para realizar esta acci&oacute;n';
		$query['status'] = $mysqli->query('SELECT s_id, s_user FROM states WHERE s_id = \''.$sid.'\' AND s_status = \'1\' LIMIT 1');
		$data['status'] = $query['status']->fetch_assoc();
		if(empty($data['status']['s_id'])) return '0: El estado se encuentra eliminado o no existe';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'8\' AND v_type_id = \''.$sid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		
		switch($type){
			case '0':
				if(empty($data['vote']['v_id'])) return '2: No es posible votar a un mismo estado m&aacute;s de una vez';
				$mysqli->query('UPDATE states SET s_likes = s_likes - \'1\' WHERE s_id = \''.$sid.'\'');
				$mysqli->query('DELETE FROM votes WHERE v_id = \''.$data['vote']['v_id'].'\'');
				$activity->delete(30, $sid, $user->uid);
				return '1: DISLIKE!!!';
			break;
			case '1':
				if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un mismo estado m&aacute;s de una vez';
				$mysqli->query('UPDATE states SET s_likes = s_likes + \'1\' WHERE s_id = \''.$sid.'\'');
				$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'8\', \''.$sid.'\', \'1\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
				$notifica->insert(30, $sid, $data['status']['s_user']);
				$activity->insert(30, $sid, $user->uid);
				return '1: LIKE!!!';
			break;
		}
	}
	
	function like_comment($cid, $type){
		global $mysqli, $user, $notifica, $activity;
		$type = $type == 0 ? 0 : 1;
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no es real';
		if(empty($user->uid)) return '0: Reg&iacute;strate para realizar esta acci&oacute;n';
		$query['com'] = $mysqli->query('SELECT c_id, c_user FROM comments WHERE c_id = \''.$cid.'\' AND c_status = \'1\' LIMIT 1');
		$data['com'] = $query['com']->fetch_assoc();
		if(empty($data['com']['c_id'])) return '0: El comentario se encuentra eliminado o no existe';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'7\' AND v_type_id = \''.$cid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		
		switch($type){
			case '0':
				if(empty($data['vote']['v_id'])) return '2: No es posible votar a un comentario m&aacute;s de una vez';
				$mysqli->query('UPDATE comments SET c_votos = c_votos - \'1\' WHERE c_id = \''.$cid.'\'');
				$mysqli->query('DELETE FROM votes WHERE v_id = \''.$data['vote']['v_id'].'\'');
				$activity->delete(31, $cid, $user->uid);
				return '1: DISLIKE!!!';
			break;
			case '1':
				if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un mismo comentario m&aacute;s de una vez';
				$mysqli->query('UPDATE comments SET c_votos = c_votos + \'1\' WHERE c_id = \''.$cid.'\'');
				$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'7\', \''.$cid.'\', \'1\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
				$notifica->insert(31, $cid, $data['com']['c_user']);
				$activity->insert(31, $cid, $user->uid);
				return '1: LIKE!!!';
			break;
		}
	}
	
	function comment(){
		global $mysqli, $user, $notifica, $activity;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment']);
		$sid = intval($_POST['sid']);
		if(es_nulo($body)) die('0: Ingresa un comentario');
		$query = $mysqli->query('SELECT s_id, s_user, s_to_user FROM states WHERE s_id = \''.$sid.'\' LIMIT 1');
		if($query->num_rows == 0) die('0: El estado que buscas no existe');
		$data = $query->fetch_assoc();
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// BLOQUEADO
		if($user->i_block($data['s_user'])) die('0: '.$user->get_nick($data['s_user']).' te ha bloqueado, no puedes comentar sus estados');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->smiles($body);
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date) VALUES (\'8\', \''.$sid.'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\')');
		$new_id = $mysqli->insert_id;
		$mysqli->query('UPDATE web_stats SET states_comments = states_comments + 1');
		$mysqli->query('UPDATE states SET s_comments = s_comments + 1 WHERE s_id = \''.$sid.'\'');
		$mysqli->query('UPDATE users_stats SET u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		//
		$activity->insert(28, $new_id, $user->uid);
		$notifica->insert(28, $new_id, $data['s_to_user'], $sid);
		if($data['s_user'] != $data['s_to_user']) $notifica->insert(28, $new_id, $data['s_user'], $sid);
		$commenters_sql = $mysqli->query('SELECT c.* FROM comments AS c WHERE c_type = \'8\' AND c.c_type_id = \''.$sid.'\'');
		while($row = $commenters_sql->fetch_assoc()){
			if(empty($data_us[$row['c_user']]) && $data['s_to_user'] != $row['c_user'] && $data['s_user'] != $row['c_user']) $notifica->insert(29, $new_id, $row['c_user'], $sid);
			$data_us[$row['c_user']] = true;
		}
		return array($new_id, $bbcode->special_codes($body_bb), time(), $data);
	}
	
	function show_comments($sid){
		global $mysqli, $user;
		$query_s = $mysqli->query('SELECT s.s_id, s.s_user, s.s_to_user, u_nick, u_last_avatar FROM states AS s LEFT JOIN users AS u ON u.u_id = s.s_to_user WHERE s.s_id = \''.$sid.'\' LIMIT 1') or die($mysqli->error);
		$result['status'] = $query_s->fetch_assoc();
		$query_c = $mysqli->query('SELECT c.*, u.u_nick, u.u_id, u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c_type = \'8\' AND c.c_type_id = \''.$sid.'\' ORDER BY c.c_id ASC');
		$i = 1;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query_c->fetch_assoc()){
			if($i > 2){
				$query_like_c = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'7\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
				$data_like_c = $query_like_c->fetch_assoc();
				$data[$i] = $row;
				$data[$i]['c_body'] = $bbcode->smiles($row['c_body']);
				if(!empty($data_like_c)) $data[$i]['like'] = 1;
			}
			$i++;
		}
		$result['list'] = $data;
		return $result;
	}
	
	function del_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_user, c_type_id FROM comments WHERE c_type = \'8\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$query_s = $mysqli->query('SELECT s_user, s_to_user FROM states WHERE s_id = \''.$data['c_type_id'].'\' LIMIT 1');
		$data_s = $query_s->fetch_assoc();
		// NO EXISTE
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['bc'] && $user->uid != $data['c_user'] && $user->uid != $data_s['s_user'] && $user->uid != $data_s['s_to_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		// TIENE PERMISOS?
		if(!$user->permits['bcp'] && !$user->permits['bc']) return '0: Tu rango no te permite eliminar tus comentarios';
		$activity->delete(28, $cid, $user->uid);
		$mysqli->query('DELETE FROM comments WHERE c_type = \'8\' AND c_id = \''.$cid.'\'');
		$mysqli->query('UPDATE web_stats SET states_comments = states_comments - \'1\'');
		$mysqli->query('UPDATE states SET s_comments = s_comments - \'1\' WHERE s_id = \''.$data['c_type_id'].'\'');
		return '1: El comentario fue eliminado con exito';
	}
	
		
	function del_state($sid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT s_id, s_user, s_likes, s_comments, s_to_user FROM states WHERE s_id = \''.$sid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		// NO EXISTE
		if(!$query->num_rows) return '0: El estado que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['be'] && $user->uid != $data['s_user'] && $user->uid != $data['s_to_user']) return '0: Este estado no te pertenece, no lo puedes eliminar';
		// TIENE PERMISOS?
		if(!$user->permits['bep'] && !$user->permits['be']) return '0: Tu rango no te permite eliminar estados';
		$activity->delete(26, $sid, $user->uid);
		$mysqli->query('DELETE FROM states WHERE s_id = \''.$sid.'\'');
		// LIBERAMOS ESPACIO DE LA DB
		if($data['s_likes']) $mysqli->query('DELETE FROM votes WHERE v_type = \'8\' AND v_type_id = \''.$sid.'\'');
		if($data['s_comments']) $mysqli->query('DELETE FROM comments WHERE c_type = \'8\' AND c_type_id = \''.$sid.'\'');
		$mysqli->query('UPDATE web_stats SET states = states - \'1\'');
		return '1: El estado fue eliminado con exito';
	}
	
	function get_edit($sid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT s_id, s_user, s_likes, s_comments, s_to_user, s_body FROM states WHERE s_id = \''.$sid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		// NO EXISTE
		if(!$query->num_rows) return '0: El estado que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['ee'] && $user->uid != $data['s_user']) return '0: Este estado no te pertenece, no lo puedes eliminar';
		// TIENE PERMISOS?
		if(!$user->permits['eep'] && !$user->permits['ee']) return '0: Tu rango no te permite eliminar estados';
		return '1: '.$data['s_body'];
	}
	
	function save_state($sid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT s_id, s_user, s_likes, s_comments, s_to_user, s_body FROM states WHERE s_id = \''.$sid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$state = secure($_POST['state']);
		if(es_nulo($state)) return '0: No haz ingresado nada';
		// NO EXISTE
		if(!$query->num_rows) return '0: El estado que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['ee'] && $user->uid != $data['s_user']) return '0: Este estado no te pertenece, no lo puedes eliminar';
		// TIENE PERMISOS?
		if(!$user->permits['eep'] && !$user->permits['ee']) return '0: Tu rango no te permite eliminar estados';
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$mysqli->query('UPDATE states SET s_body = \''.$state.'\' WHERE s_id = \''.$sid.'\' LIMIT 1');
		return '1: '.$bbcode->smiles($state);
	}
}
?>