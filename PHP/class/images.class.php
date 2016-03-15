<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class img{

	function upload($file, $name, $width, $height, $start_width, $start_height, $type, $qwidth, $qheight, $directory = '/thumbs/'){
		$tipo = substr(strtolower($file),-3);
		switch($tipo){
			case 'pjpeg':
			case 'jpeg':
			case 'jpg':
				$original = imagecreatefromjpeg($file);
			break;
			case 'gif':
				$original = imagecreatefromgif($file);
			break;
			case 'png':
			case 'x-png':
				$original = imagecreatefrompng($file);
			break;
		}
		$widthz = imagesx($original);
		$heightz = imagesy($original);
		$qwidth = empty($qwidth) ? $width : $qwidth;
		$qheight = empty($qheight) ? $height : $qheight;
		$ratio_w = 1; 
		$ratio_h = 1;
		$nw = ceil($width * $ratio_w);
		$nh = ceil($height * $ratio_h);
		$thumb = imagecreatetruecolor($nw,$nh);
		imagefilledrectangle($thumb, 0, 0, $widthz, $heightz, imagecolorallocate($thumb, 255, 255, 255));
		if($type){
			$width = imagesx($original);
			$height = imagesy($original);
			if($width > $height){
				$result_w = $height;
				$start_width = ceil(($width - $height) * '0.5');
				$start_height = 0;
			}else{
				$result_w = $width;
				$start_height = ceil(($height - $width) * '0.5');
				$start_width = 0;
			}
			imagecopyresampled($thumb,$original,0,0,$start_width,$start_height,$nw,$nh,$result_w,$result_w);
		}else imagecopyresampled($thumb,$original,0,0,$start_width,$start_height,$nw,$nh,$qwidth,$qheight);
		header("Content-type: image/jpg");
		imagejpeg($thumb,'.'.$directory.$name.'.jpg',90);
		ImageDestroy($thumb);
	}
	
	function add(){
		global $mysqli, $user, $activity;
		if(es_nulo($user->uid)) return json(array('status' => 0, 'data' => 'Usuarios anonimos no pueden agregar im&aacute;genes'));
		if(empty($user->permits['pf'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite agregar im&aacute;genes'));
		if($user->info['u_flood_image'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		$data = array(
			'date' => time(),
			'title' => secure($_POST['title']),
			'url' => secure($_POST['url']),
			'description' => secure($_POST['description'])
		);
		if(es_nulo($data['title'])) return json(array('status' => 0, 'data' => 'No haz ingresado el t&iacute;tulo de la imagen'));
		if(es_nulo($data['url'])) return json(array('status' => 0, 'data' => 'No haz ingresado la url de la imagen'));
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		if($user->permits['pfm']){			$hora = time()-(60*60);
			$query_posts = $mysqli->query('SELECT i_id FROM images WHERE i_user = \''.$user->uid.'\' AND i_date > \''.$hora.'\'');
			if($query_posts->num_rows > $user->permits['pfm']) return json(array('status' => 0, 'data' => 'Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['pfm'].'</b> im&aacute;genes por hora, int&eacute;ntalo de nuevo en unos minutos'));
		}		if(strlen($data['url']) > 300) return json(array('status' => 0, 'data' => 'La url de la imagen es demasiado larga'));
		$data['img'] = getimagesize($data['url']);
		$min_w = 140;
		$min_h = 140;
		$max_w = 2000;
		$max_h = 2000;
		if(empty($data['img'][0])) return json(array('status' => 0, 'data' => 'La url ingresada no existe o no es una imagen v&aacute;lida'));
		elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return json(array('status' => 0, 'data' => 'Tu imagen debe tener un tama&ntilde;o superior a 140x140 pixeles'));
		elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return json(array('status' => 0, 'data' => 'Tu imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles'));
		if($mysqli->query('INSERT INTO images (i_user, i_title, i_url, i_description, i_date, i_ip, i_comments_status, i_status) VALUES (\''.$user->uid.'\', \''.$data['title'].'\', \''.$data['url'].'\',  \''.$data['description'].'\', \''.$data['date'].'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.$data['nocomments'].'\', \'1\')')){
			$imgID = $mysqli->insert_id;
			$this->upload($data['url'], 't_'.$imgID, 120, 120, 0, 0, 1, false, false, '/thumbs/images/');
			$img_link = '/imagenes/'.$imgID.'/'.seo($data['title']).'.html';
			$mysqli->query('UPDATE web_stats SET images = images + 1');
			$mysqli->query('UPDATE users_stats SET u_images = u_images + 1, u_flood_image = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
			$activity->insert(14, $imgID, $user->uid);
			$quote = "'";
			return json(array('status' => 1, 'data' => 'La imagen <b>'.$data['title'].'</b> fue agregada con exito.<br>Redireccionar en <b id="count_down_post_href">11</b> segundos<br><br><center><input type="button" class="button_1 b_ok" value="Ver imagen »" onclick="location.href='.$quote.$img_link.$quote.'"></center>', 'link' => $img_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
	}
	
	function save(){
		global $mysqli, $user, $activity;
		if(empty($user->permits['efp'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite editar esta imagen'));
		$imgid = intval($_POST['img_id']);
		$query = $mysqli->query('SELECT i.* FROM images AS i WHERE i.i_id = \''.$imgid.'\' '.(empty($user->permits['ef']) ? 'AND i_user = \''.$user->uid.'\'' : '').' LIMIT 1');
		$datai = $query->fetch_assoc();
		if(empty($datai)) return json(array('status' => 0, 'data' => 'La imagen que buscas no te pertenece o no existe'));
		
		if($user->info['u_flood_image'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		$data = array(
			'title' => secure($_POST['title']),
			'description' => secure($_POST['description']),
			'reason' => secure($_POST['reason'])
		);
		if(es_nulo($data['title'])) return json(array('status' => 0, 'data' => 'No haz ingresado el t&iacute;tulo de la imagen'));
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		if($mysqli->query('UPDATE images SET i_title = \''.$data['title'].'\', i_description = \''.$data['description'].'\', i_comments_status = \''.$data['nocomments'].'\', i_follow = \''.$data['follow'].'\' WHERE i_id = \''.$datai['i_id'].'\' LIMIT 1')){
			$img_link = '/imagenes/'.$datai['i_id'].'/'.seo($data['title']).'.html';
			if($datai['i_user'] == $user->uid){
				$activity->insert(15, $datai['i_id'], $user->uid);
			}else if($data['title'] != $datai['i_title'] || $data['description'] != $datai['i_description']){
				$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'3\', \''.$datai['i_id'].'\', \''.$user->uid.'\', \''.time().'\', \'3\', \''.$data['reason'].'\')');
			}
			$quote = "'";
			return json(array('status' => 1, 'data' => 'La imagen <b>'.$data['title'].'</b> fue editada con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ver cambios »" onclick="location.href='.$quote.$img_link.$quote.'"></center>', 'link' => $img_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
	}
	
	function get_img_ajax($imgid){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT i.*, s.*, u.u_id, u.u_nick, u.u_date, u.u_country, r.r_name, r.r_image, r.r_color FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_stats AS s ON u.u_id = s.u_id WHERE i.i_id = \''.$imgid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		return $data;
	}
	
	function get_img($imgid, $seo_title){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT i.*, s.*, u.u_id, u.u_nick, u.u_date, u.u_country, u.u_last_avatar, r.r_name, r.r_image, r.r_color FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_stats AS s ON u.u_id = s.u_id WHERE i.i_id = \''.$imgid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($seo_title != seo($data['i_title'])) header('location: /imagenes/'.$imgid.'/'.seo($data['i_title']).'.html');
		require_once'PHP/libs/datos.php';
		$data['u_country_icon'] = strtolower($data['u_country']);
		$data['u_country'] = $array_data['paises'][$data['u_country']];
		$data['u_register'] = array(date('d', $data['u_date']),$time_data['meces'][date('M', $data['u_date'])],date('Y', $data['u_date']));
		date('d \d\e F \d\e Y', $data['u_date']);
		$data_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'3\' AND v_type_id = \''.$imgid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1')->fetch_assoc();
		$data['vote'] = $data_vote['v_id'];
		if($data['i_comments'] > 0){
			require_once'PHP/libs/bbcode.inc.php';
			$bbcode = new bbcode;
			$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'3\' AND c.c_type_id = \''.$imgid.'\' ORDER BY c.c_id ASC');
			$i = 0;
			while($row = $query_comments->fetch_assoc()){
				$data['comments'][$i] = $row;
				$data['comments'][$i]['c_body'] = $bbcode->start(secure($row['c_body'], false, true));
				$i++;
			}
		}
		if($user->uid){
			$query_fav = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$imgid.'\' AND f_type = \'3\' LIMIT 1');
			$data_fav = $query_fav->fetch_assoc();
			if($data_fav['f_id']) $data['i_is_fav'] = true;
		}
		if($user->permits['gomod'] || $user->permits['gomadmin']){
			$query_history = $mysqli->query('SELECT h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod WHERE h.h_type = \'3\' AND h.h_type_id = \''.$imgid.'\' ORDER BY h.h_id DESC');
			while($history = $query_history->fetch_assoc()) $data['history'][] = $history;
		}
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		$query_hit = $mysqli->query('SELECT h_user FROM hits WHERE (h_ip = \''.$_SERVER['REMOTE_ADDR'].'\' OR h_user = \''.$user->uid.'\') AND h_user > 0 and h_type = \'3\' AND h_type_id = \''.$imgid.'\'');
		$visitado = $query_hit->num_rows;
		if(empty($visitado) && $user->uid != $data['i_user']){
			$mysqli->query('INSERT INTO hits (h_type, h_type_id, h_user, h_ip, h_date) VALUES (\'3\', \''.$imgid.'\', \''.$user->uid.'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.time().'\')');
			$mysqli->query('UPDATE images SET i_hits = i_hits + 1 WHERE i_id = \''.$imgid.'\' LIMIT 1');
		}
		return $data;
	}
	
	function get_edit_img($imgid){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT i.* FROM images AS i WHERE i.i_id = \''.$imgid.'\' '.(empty($user->permits['ef']) ? 'AND i_user = \''.$user->uid.'\'' : '').' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data)) return 'La imagen que buscas no te pertenece o no existe';
		if(empty($user->permits['efp'])) return 'Tu rango no te permite editar esta imagen';
		return $data;
	}
		
	function last_images($page){
		global $mysqli;
		$max = 12;
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $max;
		$sql['list'] = $mysqli->query('SELECT i.i_id, i.i_title, i.i_description, i.i_date, u.u_nick FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user WHERE i.i_status = \'1\' ORDER BY i.i_id DESC LIMIT '.$inicio.', '.$max);
		while($row = $sql['list']->fetch_assoc()) $result['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT i_id AS total FROM images WHERE i_status = \'1\'');
		$result['pages'] = $this->images_pag($page, $sql['total']->num_rows, $max);
		return $result;
	}
		
	function images_pag($page, $registros, $max){
		if($registros <= $max) return false;
		$quote = "'";
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page - 1).')">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" onclick="to_page('.$i.')">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page + 1).')">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
		
	function stats(){
		global $mysqli, $web;
		$query = $mysqli->query('SELECT web.* FROM web_stats AS web WHERE web.w_type = \'GLO\'');
		$stats = $query->fetch_assoc();
		// ONLINE
		$online_time = time()-($web['user_online']*60);
		$query = $mysqli->query('SELECT s_id FROM sessions WHERE s_update > \''.$online_time.'\'');
		$stats['online'] = $query->num_rows;
		return $stats;
	}
	
	function last_comments(){
		global $mysqli;
		$query = $mysqli->query('SELECT i.i_id, i.i_title, co.c_id, u.u_nick, u.u_last_avatar FROM comments AS co LEFT JOIN images AS i ON i.i_id = co.c_type_id LEFT JOIN users AS u ON u.u_id = co.c_user WHERE co.c_status = \'1\' AND (co.c_type = \'3\' OR co.c_type = \'4\') AND i.i_status = \'1\' ORDER BY co.c_id DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function vote($imgid, $vote){
		global $mysqli, $user, $activity, $notifica;
		// VALIDAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no se pudo validar';
		$vote = $vote == 0 ? 'i_negatives' : 'i_positives';
		// TIENE PERMISOS PARA VOTAR?
		if(!$user->permits['vpf'] && $vote == 'i_positives') return '0: Tu rango no te permite votar positivo a los comentarios';
		if(!$user->permits['vnf'] && $vote == 'i_negatives') return '0: Tu rango no te permite votar negativo a los comentarios';
		// COMPROBAMOS EXCESO DE VOTOS
		$hora = time()-(60*60);
		$query_votes_pos = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'3\' AND v_val = \'+\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		$query_votes_neg = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'3\' AND v_val = \'-\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		if($query_votes_pos->num_rows > $user->permits['vpfm']) '0: Ya haz votado positivo bastantes veces por el momento';
		if($query_votes_neg->num_rows > $user->permits['vnfm']) '0: Ya haz votado negativo bastantes veces por el momento';
		// OBTENEMOS LOS DATOS DEL COMENTARIO
		$query['img'] = $mysqli->query('SELECT i_id, i_user FROM images WHERE i_id = \''.$imgid.'\' AND i_status = \'1\' LIMIT 1');
		$data['img'] = $query['img']->fetch_assoc();
		if(empty($data['img']['i_id'])) return '0: La imagen se encuentra eliminada o no existe';
		if($data['img']['i_user'] == $user->uid) return '0: No puedes votar tus propias im&aacute;genes';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'3\' AND v_type_id = \''.$imgid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a una misma imagen m&aacute;s de una vez';
		// ACTUALIZAMOS E INSERTAMOS
		$mysqli->query('UPDATE images SET '.$vote.' = '.$vote.' + 1 WHERE i_id = \''.$imgid.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'3\', \''.$imgid.'\', \''.$vote.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$actividad = $vote == 'i_positives' ? 18 : 19;
		$activity->insert($actividad, $imgid, $user->uid);
		$notifica->insert($actividad, $imgid, $data['img']['i_user']);
		return '1: SMline.NET';
	}
		
	function follow($imgid){
		global $mysqli, $user, $activity;
		if($user->info['u_flood_follow'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
		$query_img = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$imgid.'\' LIMIT 1');
		$data_img = $query_img->fetch_assoc();
		if(!$data_img['i_user']) return '0: La imagen no existe o fue eliminada';
		if($data_img['i_user'] == $user->uid) return '0: No puedes seguir tus propias im&aacute;genes';
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$imgid.'\' AND f_type = \'3\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['f_type'])){
			if($mysqli->query('INSERT INTO follows (f_type, f_type_id, f_user, f_date) VALUES (\'3\', \''.$imgid.'\', \''.$user->uid.'\', \''.time().'\')')){
				$mysqli->query('UPDATE images SET i_follows = i_follows + 1 WHERE i_id = \''.$imgid.'\'');
				$mysqli->query('UPDATE users_stats SET u_flood_follow = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
				$activity->insert(20, $imgid, $user->uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Ya est&aacute;s siguiendo esta imagen';	}
	
	function unfollow($imgid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$imgid.'\' AND f_type = \'3\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['f_type']){
			if($mysqli->query('DELETE FROM follows WHERE f_type = \'3\' AND f_user = \''.$user->uid.'\' AND f_type_id = \''.$imgid.'\' LIMIT 1')){
				$mysqli->query('UPDATE images SET i_follows = i_follows - 1 WHERE i_id = \''.$imgid.'\'');
				$activity->delete(20, $imgid, $user->uid);
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: No est&aacute;s siguiendo esta imagen';
	}
		
	function favorite($img_id, $action){
		global $mysqli, $user, $activity;
		if($action == 0){
			if($user->info['u_flood_image'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
			$query_img = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$img_id.'\' LIMIT 1');
			$data_img = $query_img->fetch_assoc();
			if(!$data_img['i_user']) return '0: La imagen que buscas no existe o fue eliminada';
			if($user->uid == $data_img['i_user']) return '0: No puedes agregar a favoritos tus propias imagenes';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$img_id.'\' AND f_type = \'3\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['f_id'])){
				if($mysqli->query('INSERT INTO favorites (f_type, f_type_id, f_user, f_date) VALUES (\'3\', \''.$img_id.'\', \''.$user->uid.'\', \''.time().'\')')){
					$mysqli->query('UPDATE users_stats SET u_flood_image = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
					$mysqli->query('UPDATE images SET i_favs = i_favs + 1 WHERE i_id = \''.$img_id.'\'');
					$activity->insert(21, $img_id, $user->uid);
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
		if($action == 1){
			$query_img = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$img_id.'\' LIMIT 1');
			$data_img = $query_img->fetch_assoc();
			if(!$data_img['i_user']) return '0: La imagen que buscas no existe o fue eliminada';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$img_id.'\' AND f_type = \'3\' LIMIT 1');
			$data = $query->fetch_assoc();
			if($data['f_id']){
				if($mysqli->query('DELETE FROM favorites WHERE f_id = \''.$data['f_id'].'\' LIMIT 1')){
					$mysqli->query('UPDATE images SET i_favs = i_favs - 1 WHERE i_id = \''.$img_id.'\'');
					$activity->delete(21, $img_id, $user->uid);
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: No est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
	}
	
	function comment(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment'], false, true);
		$img_id = intval($_POST['img_id']);
		if(es_nulo($body)) die('0: Ingresa un comentario');
		$query = $mysqli->query('SELECT i_id, i_comments_status, i_user FROM images WHERE i_id = \''.$img_id.'\' AND i_status = \'1\' LIMIT 1');
		$image = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: La imagen que intentas comentar se encuentra eliminada');
		if($image['i_comments_status'] != '1') die('0: Esta imagen no permite comentarios');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// PUEDE COMENTAR?
		if(empty($user->permits['pc'])) die('0: Tu rango no te permite publicar comentarios en esta imagen');
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'3\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> comentarios por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		// BLOQUEADO
		if($user->i_block($image['i_user'])) die('0: '.$user->get_nick($image['i_user']).' te ha bloqueado, no puedes comentar sus im&aacute;genes');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date) VALUES (\'3\', \''.$img_id.'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\')');
		$new_id = $mysqli->insert_id;
		$activity->insert(16, $new_id, $user->uid, $img_id);
		$notifica->insert(16, $new_id, $image['i_user'], $img_id);
		$notifica->insert_to_follows(17, $img_id, $img_id, 3, $image['i_user']);
		$mysqli->query('UPDATE web_stats SET images_comments = images_comments + 1');
		$mysqli->query('UPDATE images SET i_comments = i_comments + 1 WHERE i_id = \''.$img_id.'\'');
		$mysqli->query('UPDATE users_stats SET u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		return array($new_id, $body_bb, time());
	}
	
	function send_replie(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment'], false, true);
		$cid = intval($_POST['cid']);
		if(es_nulo($body)) die('0: Ingresa un comentario');
		
		$query_comment = $mysqli->query('SELECT c_type_id, c_user FROM comments WHERE c_id = \''.$cid.'\' AND c_type = \'3\' LIMIT 1');
		$data_comment = $query_comment->fetch_assoc();
		if(es_nulo($data_comment)) die('0: El comentario que busca no existe');
		
		$query = $mysqli->query('SELECT i_id, i_comments_status, i_user FROM images WHERE i_id = \''.$data_comment['c_type_id'].'\' AND i_status = \'1\' LIMIT 1');
		$image = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: La imagen que intentas comentar se encuentra eliminada');
		if($image['i_comments_status'] != '1') die('0: Esta imagen no permite comentarios ni respuestas');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		
		// PUEDE COMENTAR?
		if(empty($user->permits['pc'])) die('0: Tu rango no te permite publicar comentarios en esta imagen');
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'4\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> respuestas por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		//BLOQUEADO
		if($user->i_block($image['i_user'])) die('0: '.$user->get_nick($image['i_user']).' te ha bloqueado, no puedes comentar sus im&aacute;genes');
		if($user->i_block($data_comment['c_user'])) die('0: '.$user->get_nick($data_comment['c_user']).' te ha bloqueado, no puedes responder sus comentarios');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date, c_replie_id) VALUES (\'4\', \''.$data_comment['c_type_id'].'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\', \''.$cid.'\')');
		$r_id = $mysqli->insert_id;
		$activity->insert(23, $r_id, $user->uid, $cid);
		$notifica->insert(23, $cid, $data_comment['c_user']);
		$mysqli->query('UPDATE web_stats SET images_comments = images_comments + 1');
		$mysqli->query('UPDATE comments SET c_replies = c_replies + 1 WHERE c_id = \''.$cid.'\'');
		$mysqli->query('UPDATE images SET i_comments = i_comments + 1 WHERE i_id = \''.$data_comment['c_type_id'].'\'');
		$mysqli->query('UPDATE users_stats SET u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		
		return array($mysqli->insert_id, $body_bb, time(), 'img');
	}
	
	function show_replies($cid){
		global $mysqli;
		$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'4\' AND c.c_replie_id = \''.$cid.'\' ORDER BY c.c_id ASC');
		$i = 0;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query_comments->fetch_assoc()){
			$query_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'4\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
			$data_vote = $query_vote->fetch_assoc();
			$data[$i] = $row;
			if(!empty($data_vote)) $data['comments'][$i]['vote'] = true;
			$data[$i]['c_body'] = $bbcode->start(secure($row['c_body'], false, true));
			$i++;
		}
		return $data;
	}
	
	function get_edit_comment($cid){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'3\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		if($user->permits['ecp']){
			return '1: '.$data['c_body'];
		}else return '0: Tu rango no te permite editar comentarios';
	}
	
	function save_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'3\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		if($user->permits['ecp']){
			$body = secure($_POST['comment'], false, true);
			if(es_nulo($body)) return '0: Ingresa un comentario';
			if($data['c_body'] != $body){
				$mysqli->query('UPDATE comments SET c_body = \''.$body.'\' WHERE c_id = \''.$cid.'\' LIMIT 1');
				if($user->uid == $data['c_user']) $activity->insert(17, $cid, $user->uid);
			}
			require_once'PHP/libs/bbcode.inc.php';
			$bbcode = new bbcode;
			$body_bb = $bbcode->start(secure($body, false, true));
			return '1: '.$body_bb;
		}else return '0: Tu rango no te permite editar comentarios';
	}
	
	function vote_comment($vote, $cid){
		global $mysqli, $user, $activity, $notifica;
		// VALIDAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no se pudo validar';
		$vote = ($vote == 0) ? '-' : '+';
		// TIENE PERMISOS PARA VOTAR?
		if(!$user->permits['vnc'] && $vote == '-') return '0: Tu rango no te permite votar negativo a los comentarios';
		if(!$user->permits['vpc'] && $vote == '+') return '0: Tu rango no te permite votar positivo a los comentarios';
		// COMPROBAMOS EXCESO DE VOTOS
		$hora = time()-(60*60);
		$query_votes_pos = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'4\' AND v_val = \'+\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		$query_votes_neg = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'4\' AND v_val = \'-\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		if($query_votes_pos->num_rows > $user->permits['vpcm']) '0: Ya haz votado positivo bastantes veces por el momento';
		if($query_votes_neg->num_rows > $user->permits['vncm']) '0: Ya haz votado negativo bastantes veces por el momento';
		// OBTENEMOS LOS DATOS DEL COMENTARIO
		$query['comment'] = $mysqli->query('SELECT c_id, c_user, c_votos FROM comments WHERE c_id = \''.$cid.'\' AND c_status = \'1\' LIMIT 1');
		$data['comment'] = $query['comment']->fetch_assoc();
		if(empty($data['comment']['c_id'])) return '0: El comentario se encuentra eliminado o no existe';
		if($data['comment']['c_user'] == $user->uid) return '0: No puedes votar tus propios comentarios';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'4\' AND v_type_id = \''.$cid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un mismo comentario m&aacute;s de una vez';
		// ACTUALIZAMOS E INSERTAMOS
		$mysqli->query('UPDATE comments SET c_votos = c_votos '.($vote == '+' ? '+ 1' : '- 1').' WHERE c_id = \''.$cid.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'4\', \''.$cid.'\', \''.$vote.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$actividad = ($vote == '+') ? 24 : 25;
		$activity->insert($actividad, $cid, $user->uid);
		$notifica->insert($actividad, $cid, $data['comment']['c_user']);
		$new_total = ($vote == '+') ? $data['comment']['c_votos'] + 1 :  $data['comment']['c_votos'] - 1;
		$return = $new_total > 0 ? '+'.$new_total : $new_total;
		return '1: '.$return;
	}
	
	function del_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user, c_type, c_type_id, c_replies, c_replie_id FROM comments WHERE (c_type = \'3\' OR c_type = \'4\') AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		// NO EXISTE
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['bc'] && $user->uid != $data['c_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		// TIENE PERMISOS?
		if($user->permits['bcp']){
			// BORRAR COMENTARIO + RESPUETAS
			$total_a_borrar = $data['c_replies'] + 1;
			//$activity->delete(4, $cid, $user->uid, $data['c_type_id']);
			if($data['c_type'] == 3) $mysqli->query('DELETE FROM comments WHERE (c_type = \'3\' AND c_id = \''.$cid.'\') OR (c_type = \'4\' && c_replie_id = \''.$cid.'\')');
			else if($data['c_type'] == 4){
				$mysqli->query('DELETE FROM comments WHERE c_type = \'4\' AND c_id = \''.$cid.'\'');
				$mysqli->query('UPDATE comments SET c_replies = c_replies - \'1\' WHERE c_id = \''.$data['c_replie_id'].'\' AND c_type = \'3\'');
			}
			$mysqli->query('UPDATE web_stats SET images_comments = images_comments - \''.$total_a_borrar.'\'');
			$mysqli->query('UPDATE images SET i_comments = i_comments - \''.$total_a_borrar.'\' WHERE i_id = \''.$data['c_type_id'].'\'');
			return '1: El comentario fue eliminado con exito';
		}else return '0: Tu rango no te permite eliminar tus comentarios';
	}
	
	function share($imgid){
		global $mysqli, $user, $activity, $notifica;
			$query_img = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$imgid.'\' AND i_status = \'1\' LIMIT 1');
			$query_follows = $mysqli->query('SELECT f_type FROM follows WHERE f_type_id = \''.$user->uid.'\' AND f_type = \'1\'');
			if($query_follows->num_rows == 0) return '0: No puedes recomendar esta imagen si no tienes seguidores';
			$data_img = $query_img->fetch_assoc();
			if(!$data_img['i_user']) return '0: La imagen no existe o fue eliminada';
			if($user->uid == $data_img['i_user']) return '0: No puedes recomendar tus propias im&aacute;genes';
			$query = $mysqli->query('SELECT s_type FROM shared WHERE s_type = \'3\' AND s_type_id = \''.$imgid.'\' AND s_user = \''.$user->uid.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['s_type'])){
				if($mysqli->query('INSERT INTO shared (s_type, s_type_id, s_user, s_date) VALUES (\'3\', \''.$imgid.'\', \''.$user->uid.'\', \''.time().'\')')){
					$activity->insert(22, $imgid, $user->uid);
					$notifica->insert_to_follows(22, $imgid, $user->uid, 1, $data_img['i_user']);
					$mysqli->query('UPDATE images SET i_shared = i_shared + 1 WHERE i_id = \''.$imgid.'\'');
					return '1: La imagen fue recomendada a todos tus seguidores';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya has recomendado esta imagen antes';
	}
	
	function delete($i_id){
		global $mysqli, $user, $activity;
		$query_img = $mysqli->query('SELECT i_user, i_status FROM images WHERE i_id = \''.$i_id.'\' LIMIT 1');
		$data_img = $query_img->fetch_assoc();
		if($data_img){
			if(empty($user->permits['bfp'])) return '0: Tu rango no te permite borrar im&aacute;genes';
			if($user->uid != $data_img['i_user']) return '0: Esta imagen no te pertenece';
			if($data_img['i_status'] != 0){
					$activity->delete(14, $i_id, $data_img['i_user']);
					$mysqli->query('UPDATE web_stats SET images = images - 1');
					$mysqli->query('UPDATE images SET i_status = \'0\' WHERE i_id = \''.$i_id.'\'');
					$mysqli->query('UPDATE users_stats SET u_images = u_images - 1 WHERE u_id = \''.$user->uid.'\'');
					return '1: La imagen fue borrada correctamente';
			}else return '0: Esta imagen ya se encuentra eliminada';
		}else return '0: La imagen que buscas ya no existe';
	}
	
	function mod_delete($i_id){
		global $mysqli, $user, $activity;
		if(empty($user->permits['bf'])) return '0: Imposible continuar';
		$reason = secure($_POST['reason']);
		$query_image = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$i_id.'\' AND i_status != \'0\' LIMIT 1');
		$data_image = $query_image->fetch_assoc();
		if($data_image){
			if($user->uid == $data_image['i_user']) return '0: Esta imagen es tuya, no puedes borrarla de esta forma';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'3\', \''.$i_id.'\', \''.$user->uid.'\', \''.time().'\', \'1\', \''.$reason.'\')');
			$activity->delete(14, $i_id, $data_image['i_user']);
			$mysqli->query('UPDATE web_stats SET images = images - 1');
			$mysqli->query('UPDATE images SET i_status = \'0\' WHERE i_id = \''.$i_id.'\'');
			$mysqli->query('UPDATE users_stats SET u_images = u_images - 1 WHERE u_id = \''.$data_image['i_user'].'\'');
			return '1: La imagen fue eliminada correctamente';
		}else return '0: Esta imagen ya se encuentra eliminada';
	}
	
	function mod_reac($i_id){
		global $mysqli, $user;
		if(empty($user->permits['vfb'])) return '0: Imposible continuar';
		$reason = '-';
		$query_img = $mysqli->query('SELECT i_user FROM images WHERE i_id = \''.$i_id.'\' AND i_status = \'0\' LIMIT 1');
		$data_img = $query_img->fetch_assoc();
		if($data_img){
			if($user->uid == $data_img['i_user'] && !$user->permits['goadmin']) return '0: No puedes reactivar tus propias im&aacute;genes';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'3\', \''.$i_id.'\', \''.$user->uid.'\', \''.time().'\', \'2\', \''.$reason.'\')');
			$mysqli->query('UPDATE web_stats SET images = images + 1');
			$mysqli->query('UPDATE images SET i_status = \'1\' WHERE i_id = \''.$i_id.'\'');
			$mysqli->query('UPDATE users_stats SET u_images = u_images + 1 WHERE u_id = \''.$data_img['i_user'].'\'');
			return '1: La imagen ha sido reactivada y ser&aacute; visible para todos los usuarios';
		}else return '0: Esta imagen ya se encuentra reactivada';
	}
	
	function get_history(){
		global $mysqli;
		$query_history = $mysqli->query('SELECT h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick, i.i_title, i.i_user FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod LEFT JOIN images AS i ON i.i_id = h.h_type_id WHERE h.h_type = \'3\' ORDER BY h.h_id DESC LIMIT 20');
		while($history = $query_history->fetch_assoc()) $data[] = $history;
		return $data;
	}
}
?>