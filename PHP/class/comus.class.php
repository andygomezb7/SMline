<?php
/*! Powered by SMLINE.NET */
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class comus{
	
	function comu_id($comu_seo){
		global $mysqli;
		$query = $mysqli->query('SELECT comu_id FROM comus WHERE comu_seo = \''.$comu_seo.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		return $data['comu_id'];
	}
	
	function me($comu_id){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT m.*, c.*, r.*, u.u_id FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user LEFT JOIN comus AS c ON c.comu_id = m.m_comu LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank WHERE c.comu_id = \''.$comu_id.'\' AND m.m_user = \''.$user->uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['r_name'] == '') $data['r_name'] = $data['comu_rank'];
		return $data;
	}
	
	function cats(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM comus_cats AS c ORDER BY c.c_name ASC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function cat_info($c_seo){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM comus_cats AS c WHERE c_seo = \''.$c_seo.'\'');
		$data = $query->fetch_assoc();
		return $data;
	}
	
	function img_port($url){
		$img_url = secure($url);
		$data['img'] = getimagesize($img_url);
		$min_w = 120;
		$min_h = 120;
		$max_w = 2000;
		$max_h = 2000;
		if(empty($data['img'][0])) return '0: La imagen no existe o no es una imagen v&aacute;lida';
		elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return '0: La imagen debe tener un tama&ntilde;o superior a 120x120 pixeles';
		elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return '0: La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles';
		return '1: SMline';
	}
	
	function create(){
		global $mysqli, $user, $web, $activity;
		$quote = "'";
		// PUEDE CREARLA?
		if(empty($user->permits['ccs'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite crear comunidades'));
		// FLOOD
		if($user->info['u_flood_comu'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		// DATOS OBTENIDOS CON AJAZ
		$data = array(
			'date' => time(),
			'name' => secure($_POST['comu_name']),
			'seo' => secure($_POST['comu_seo']),
			'rank' => secure($_POST['comu_rank']),
			'desc' => secure($_POST['comu_desc']),
			'cat' => intval($_POST['comu_cat']),
		);
		$p_postear = empty($_POST['p_postear']) ? 0 : 1;
		$p_comentar = empty($_POST['p_comentar']) ? 0 : 1;
		// CAMPOS VACIOS?
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
		// EXISTE LA CATEGORIA?
		$query = $mysqli->query('SELECT c_id, c_seo FROM comus_cats WHERE c_id = \''.$data['cat'].'\' LIMIT 1');
		$data_cat = $query->fetch_assoc();
		if($query->num_rows == 0) return json(array('status' => 0, 'data' => 'La categor&iacute;a especificada no existe'));
		// SEO DE LA COMUNIDAD
		if(!preg_match('/^[-a-z0-9]+$/i', $data['seo'])) return json(array('status' => 0, 'data' => 'El campo nombre corto s&oacute;lo se permiten letras en min&uacute;scula, n&uacute;meros y guiones'));
		elseif(is_numeric($data['seo'])) return json(array('status' => 0, 'data' => 'El nombre corto debe contener al menos una letra'));
		elseif(strlen($data['seo']) < 5 or strlen($data['seo']) > 25) return json(array('status' => 0, 'data' => 'El nombre corto debe tener entre 5 y 25 caracteres'));
		$query_url = $mysqli->query('SELECT comu_id FROM comus WHERE comu_seo = \''.$data['seo'].'\' LIMIT 1');
		if($query_url->num_rows) return json(array('status' => 0, 'data' => 'El nombre corto seleccionado ya est&aacute; en uso'));
		elseif(strlen($data['name']) > 100) return json(array('status' => 0, 'data' => 'El nombre es demasiado largo'));
		elseif(strlen($data['desc']) > 1600) return json(array('status' => 0, 'data' => 'La descripci&oacuten es demasiado larga'));
		elseif(strlen($data['rank']) > 30) return json(array('status' => 0, 'data' => 'El rango por defecto es demasiado largo'));
		// IMAGEN
		$x1 = secure($_POST['thumb_x1']);
		$y1 = secure($_POST['thumb_y1']);
		$x2 = secure($_POST['thumb_x2']);
		$y2 = secure($_POST['thumb_y2']);
		$w = secure($_POST['thumb_w']);
		$h = secure($_POST['thumb_h']);
		$img_url = secure($_POST['img_url']);
		$data['img'] = getimagesize($img_url);
		$min_w = 120;
		$min_h = 120;
		$max_w = 2000;
		$max_h = 2000;
		// EXISTE LA IMAGEN
		if(empty($data['img'][0])) return json(array('status' => 0, 'data' => 'La imagen no existe o no es una imagen v&aacute;lida'));
		elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o superior a 120x120 pixeles'));
		elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles'));
		// COMPROBAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		// MAXIMO DE COMUNIDADES
		if($user->permits['ccsm']){
			$query_total_comus = $mysqli->query('SELECT comu_id FROM comus WHERE comu_admin = \''.$user->uid.'\' AND comu_status = \'1\'');
			if($query_total_comus->num_rows >= $user->permits['ccsm']) return json(array('status' => 0, 'data' => 'Tu rango no te permite crear m&aacute;s de '.$user->permits['ccsm'].' comunidad'.($user->permits['ccsm'] > 1 ? 's' : '').''));
		}
		// INSERTAMOS
		if($mysqli->query('INSERT INTO comus (comu_name, comu_seo, comu_cat, comu_desc, comu_rank, comu_p_post, comu_p_com, comu_date, comu_admin, comu_status, comu_members) VALUES (\''.$data['name'].'\', \''.$data['seo'].'\', \''.$data['cat'].'\', \''.$data['desc'].'\', \''.$data['rank'].'\', \''.$p_postear.'\', \''.$p_comentar.'\', \''.$data['date'].'\', \''.$user->uid.'\', \'1\', \'1\')')){
			$comu_id = $mysqli->insert_id;
			include('PHP/class/images.class.php');
			$img = new img;
			$img->upload($img_url, 't_'.$comu_id, 120, 120, $x1, $y1, false, $w, $h, '/thumbs/comus/');
			$comu_link = '/comunidades/'.$data['seo'].'/';
			$mysqli->query('UPDATE web_stats SET comus = comus + 1');
			$mysqli->query('INSERT INTO comus_members (m_user, m_comu, m_topics, m_rank, m_date) VALUES (\''.$user->uid .'\', \''.$comu_id.'\', \'0\', \'1\', \''.$data['date'].'\')');
			$activity->insert(35, $comu_id, $user->uid);
			return json(array('status' => 1, 'data' => 'La comunidad <b>'.$data['name'].'</b> fue agregada con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ir a mi nueva comunidad »" onclick="location.href='.$quote.$comu_link.$quote.'"></center>', 'link' => $post_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
	}
	
	function save(){
		global $mysqli, $user, $web, $activity;
		$quote = "'";
		// PUEDE CREARLA?
		if(empty($user->permits['ecsp'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite editar comunidades'));
		// FLOOD
		if($user->info['u_flood_comu'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		// DATOS OBTENIDOS CON AJAZ
		$data = array(
			'date' => time(),
			'name' => secure($_POST['comu_name']),
			'rank' => secure($_POST['comu_rank']),
			'desc' => secure($_POST['comu_desc']),
			'cat' => intval($_POST['comu_cat'])
		);
		$p_postear = empty($_POST['p_postear']) ? 0 : 1;
		$p_comentar = empty($_POST['p_comentar']) ? 0 : 1;
		$comu_id = intval($_POST['comu_id']);
		$comu_image = secure($_POST['comu_image']);
		$comu_image_repeat = empty($_POST['comu_image_repeat']) ? 0 : 1;
		$comu_color	=  str_replace('#', '', secure($_POST['comu_color']));
		// CAMPOS VACIOS?
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
		// EXISTE LA CATEGORIA?
		$query = $mysqli->query('SELECT c_id, c_seo FROM comus_cats WHERE c_id = \''.$data['cat'].'\' LIMIT 1');
		$data_cat = $query->fetch_assoc();
		if($query->num_rows == 0) return json(array('status' => 0, 'data' => 'La categor&iacute;a especificada no existe'));
		if(strlen($data['name']) > 100) return json(array('status' => 0, 'data' => 'El nombre es demasiado largo'));
		elseif(strlen($data['desc']) > 1600) return json(array('status' => 0, 'data' => 'La descripci&oacuten es demasiado larga'));
		elseif(strlen($data['rank']) > 30) return json(array('status' => 0, 'data' => 'El rango por defecto es demasiado largo'));
		// PUEDE EDITARLA?
		$me = $this->me($comu_id);
		if($me['m_rank'] != 1 && empty($user->permits['ecs'])) return json(array('status' => 0, 'data' => 'No tienes permisos para editar esta comunidad'));
		// IMAGEN
		$x1 = secure($_POST['thumb_x1']);
		$y1 = secure($_POST['thumb_y1']);
		$x2 = secure($_POST['thumb_x2']);
		$y2 = secure($_POST['thumb_y2']);
		$w = secure($_POST['thumb_w']);
		$h = secure($_POST['thumb_h']);
		$img_url = secure($_POST['img_url']);
		if($img_url){
			$data['img'] = getimagesize($img_url);
			$min_w = 120;
			$min_h = 120;
			$max_w = 2000;
			$max_h = 2000;
			// EXISTE LA IMAGEN
			if(empty($data['img'][0])) return json(array('status' => 0, 'data' => 'La imagen no existe o no es una imagen v&aacute;lida'));
			elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o superior a 120x120 pixeles'));
			elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles'));
		}
		if($comu_image){
			$data_img = getimagesize($comu_image);
			$min_w = 2;
			$min_h = 2;
			$max_w = 1500;
			$max_h = 1500;
			if(empty($data_img[0])) return '0: La imagen de fondo ingresada no existe o no es una imagen v&aacute;lida';
			elseif($data_img[0] < $min_w || $data_img[1] < $min_h) return '0: La imagen de fondo debe tener un tama&ntilde;o superior a 2x2 pixeles';
			elseif($data_img[0] > $max_w || $data_img[1] > $max_h) return '0: La imagen de fondo debe tener un tama&ntilde;o menor a 1500x1500 pixeles';
		}
		// COMPROBAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		//
		$data_comu = $this->comu_data($comu_id);
		if(empty($data_comu['comu_id'])) return json(array('status' => 0, 'data' => 'La comunidad se encuentra actualmente suspendida'));
		// ACTUALIZAMOS
		if($mysqli->query('UPDATE comus SET comu_name = \''.$data['name'].'\', comu_cat = \''.$data['cat'].'\', comu_desc = \''.$data['desc'].'\', comu_rank = \''.$data['rank'].'\', comu_p_post = \''.$p_postear.'\', comu_p_com = \''.$p_comentar.'\', comu_image = \''.$comu_image.'\', comu_image_repeat = \''.$comu_image_repeat.'\', comu_color = \''.$comu_color.'\' WHERE comu_id = \''.$comu_id.'\' LIMIT 1')){
			if($img_url){
				include('PHP/class/images.class.php');
				$img = new img;
				$img->upload($img_url, 't_'.$comu_id, 120, 120, $x1, $y1, false, $w, $h, '/thumbs/comus/');
				$mysqli->query('UPDATE comus SET comu_last_image = \''.$data['date'].'\' WHERE comu_id = \''.$comu_id.'\' LIMIT 1');
			}
			$comu_link = '/comunidades/'.$data_comu['comu_seo'].'/';
			//$activity->insert(2, $comu_id, $user->uid);
			return json(array('status' => 1, 'data' => 'La comunidad <b>'.$data['name'].'</b> fue editada con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ir a la comunidad »" onclick="location.href='.$quote.$comu_link.$quote.'"></center>', 'link' => $comu_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
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
	
	function recent_comus(){
		global $mysqli;
		$query = $mysqli->query('SELECT comu_seo, comu_name FROM comus WHERE comu_status = \'1\' ORDER BY comu_id DESC LIMIT 5');
		while($row = $query->fetch_assoc()) $array[] = $row;
		return $array;
	}
	
	function comu_data($comu_id){
		global $mysqli;
		$query = $mysqli->query('SELECT co.*, ca.*, u.u_id, u.u_nick FROM comus AS co LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = co.comu_admin WHERE co.comu_id = \''.$comu_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		return $data;
	}
	

	
	function load_members(){
		global $user, $mysqli;
		
		$comu_id = intval($_POST['cid']);
		$page = intval($_POST['page']);
		$type = secure($_POST['type']);
		$search = intval($_POST['search']);
		
		$me = $this->me($comu_id);
		$data_comu = $this->comu_data($comu_id);

		if($me['m_rank'] != 1 && $me['m_rank'] == 2 && !$user->permits['ecs']) die('0: Solo los moderadores de la comunidad pueden realizar esta acci&oacute;n');
		
		$limit = 10;
		if(empty($page)){
			$start = 0;
			$page = 1;
		}else $start = ($page - 1) * $limit;
		if($type == 'members') $u_status = 1;
		else $u_status = 0;
		$searching = secure($_POST['user']);
		if($search && $searching) $searched = 'AND u.u_nick LIKE \'%'.$searching.'%\'';
		
		$query = $mysqli->query('SELECT m.*, r.*, co.*, u.u_id, u.u_nick, u.u_last_avatar FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE co.comu_id = \''.$comu_id.'\' AND m.m_status = \''.$u_status.'\' '.$searched.' ORDER BY m.m_id DESC LIMIT '.$start.', '.$limit) or die($mysqli->error);
		while($row = $query->fetch_assoc()) $data['list'][] = $row;
		
		$query_total = $mysqli->query('SELECT m.m_id FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user WHERE m.m_comu = \''.$comu_id.'\' AND m.m_status = \''.$u_status.'\' '.$searched);
		
		if($query_total == 0) die('0: No hay miembros con los filtros seleccionados');
		
		$data['pages'] = $this->members_pag($page, $query_total->num_rows, $limit, $comu_id, $type, $search);
		
		return $data;
	}
	
	function members_pag($page, $registros, $max, $comu_id, $type, $search){
		if($registros <= $max) return false;
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Anterior" onclick="admin_comu.load_members('.$comu_id.', \''.$type.'\', '.($page - 1).', \''.$search.'\')">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" onclick="admin_comu.load_members('.$comu_id.', \''.$type.'\', '.$i.', \''.$search.'\')">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" onclick="admin_comu.load_members('.$comu_id.', \''.$type.'\', '.($page + 1).', \''.$search.'\')">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
	function admin_member(){
		global $mysqli, $user;
		
		// VARS
		$userid = intval($_POST['user']);
		$comu_id = intval($_POST['cid']);
		
		// SOY ADMIN O MOD
		$me = $this->me($comu_id);
		if($me['m_rank'] != 1 && $me['m_rank'] == 2 && !$user->permits['ecs']) die('<div id="error">Solo los moderadores de la comunidad pueden realizar esta acci&oacute;n</div>');
		
		$query = $mysqli->query('SELECT m.m_rank, m.m_status, m.m_date, co.comu_rank, r.r_id, r.r_name, u.u_id, u.u_nick FROM comus_members AS m LEFT JOIN users AS u ON u.u_id = m.m_user LEFT JOIN comus AS co ON co.comu_id = m.m_comu LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank WHERE co.comu_id = \''.$comu_id.'\' AND m.m_user = \''.$userid.'\' LIMIT 1') or die($mysqli->error);
		$data = $query->fetch_assoc();
		
		// RANGO POR DEFECTO
		if($data['r_name'] == '') $data['r_name'] = $data['comu_rank'];
		
		// EXISTR
		if(empty($data['u_id'])) die('<div id="error">Este usuario no es miembro de esta comunidad</div>');
		
		// BANEADO?
		if($data['m_status'] == 0){
			$query = $mysqli->query('SELECT b.b_reason, b.b_mod, b.b_date, b.b_end, u.u_nick FROM comus_bans AS b LEFT JOIN users AS u ON u.u_id = b.b_mod WHERE b_user = \''.$userid.'\' AND b_comu = \''.$comu_id.'\' LIMIT 1');
			$data['ban'] = $query->fetch_assoc();
			$data['ban']['b_end'] = $data['ban']['b_end'] == 0 ? 'nunca' : date('d/m/Y h:i:s A', $data['ban']['b_end']);
		}
		
		// LISTA DE RANGOS
		$query = $mysqli->query('SELECT r_id, r_name FROM comus_ranks ORDER BY r_id ASC');
		while($row = $query->fetch_assoc()) $data['list_ranks'][] = $row;
		
		// PERMISOS DE CAMBIAR RANGO
		if($me['m_rank'] == 1 || $user->permits['goadmin']) $data['change_rank'] = true;
		
		// RESULT
		return $data;
	}
	
	function ban_member($uid, $cid){
		global $mysqli, $user;
		
		// SOLO ADMINS Y MOD?
		$me = $this->me($cid);
		if($me['m_rank'] != 1 && $me['m_rank'] != 2 && !$user->permits['ecs']) return '0: <div id="error">Solo los moderadores de la comunidad pueden realizar esta acci&oacute;n</div>';
		
		// RAZON
		$reason = secure($_POST['razon_desc']);
		if(es_nulo($reason)) return '0: Ingresa una raz&oacute;n';
		
		// MIEMBRO ADMINISTRADO
		$query = $mysqli->query('SELECT m.m_id, m.m_rank, m.m_status, co.comu_admin FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE m.m_comu = \''.$cid.'\' AND m.m_user = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		
		// MIEMBRO
		if(empty($data['m_rank'])) return '0: Este usuario no es miembro de esta comunidad';
		if($data['m_rank'] <= $me['m_rank'] && !$user->permits['ecs'] && $data['comu_admin'] != $user->uid) return '0: No puedes suspender a miembros con un rango igual o superior al tuyo';
		if($data['comu_admin'] == $uid) return '0: Imposible suspender al primer administrador de la comunidad';
		if($data['m_status'] == 0) return '0: Este miembro ya se encuentra suspendido';
		
		// PROCEDEMOS
		$b_duration_type = secure($_POST['duration']);
		$b_total_val = secure($_POST['total_val']);
		$b_times = array(0, 3600, 86400);
		if($b_duration_type == 0) $b_end = 0;
		else $b_end = time()+($b_times[$b_duration_type]*$b_total_val);
		$mysqli->query('INSERT INTO comus_bans (b_user, b_comu, b_reason, b_mod, b_date, b_end) VALUES (\''.$uid.'\', \''.$cid.'\', \''.$reason.'\', \''.$user->uid.'\', \''.time().'\', \''.$b_end.'\')');
		$mysqli->query('UPDATE comus_members SET m_status = \'0\' WHERE m_id = \''.$data['m_id'].'\' AND m_comu = \''.$cid.'\' LIMIT 1');
		$end_msj = $b_end == 0 ? 'nunca' : date('d/m/Y h:i:s A', $b_end);
		return '1: Miembro suspendido correctamente hasta <b>'.$end_msj.'</b>';
	}
	
	function unban_member($uid, $cid){
		global $mysqli, $user;
		
		$reactivar = intval($_POST['reactivar']);
		if(empty($reactivar)) return '1: Tus cambios han sido guardados';
		
		// SOLO ADMINS Y MOD?
		$me = $this->me($cid);
		if($me['m_rank'] != 1 && $me['m_rank'] != 2 && !$user->permits['ecs']) return '0: <div id="error">Solo los moderadores de la comunidad pueden realizar esta acci&oacute;n</div>';
		
		// MIEMBRO ADMINISTRADO
		$query = $mysqli->query('SELECT m.m_id, m.m_rank, m.m_status, co.comu_admin FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE m.m_comu = \''.$cid.'\' AND m.m_user = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$query = $mysqli->query('SELECT b_id, b_mod FROM comus_bans WHERE b_user = \''.$uid.'\' AND b_comu = \''.$cid.'\' LIMIT 1');
		$data['ban'] = $query->fetch_assoc();
		
		// MIEMBRO
		if(empty($data['m_rank'])) return '0: Este usuario no es miembro de esta comunidad';
		if($data['ban']['b_mod'] != $user->uid && $me['m_rank'] != 1 && !$user->permits['ecs']) return '0: Solo puedes reactivar usuarios que tu suspendiste';
		if($data['m_status'] == 1) return '0: Este miembro no se encuentra suspendido';
		
		// PROCEDEMOS
		$mysqli->query('DELETE FROM comus_bans WHERE b_id = \''.$data['ban']['b_id'].'\' LIMIT 1');
		$mysqli->query('UPDATE comus_members SET m_status = \'1\' WHERE m_id = \''.$data['m_id'].'\' AND m_comu = \''.$cid.'\' LIMIT 1');
		return '1: Miembro reactivado correctamente!';
	}
	
	function change_rank_member($uid, $cid){
		global $mysqli, $user;
		
		// MSJ OK ;)
		$msj_ok = '1: Tus cambios han sido guardados';
		
		// SOLO ADMINS?
		$me = $this->me($cid);
		if($me['m_rank'] != 1 && !$user->permits['goadmin']) return '0: <div id="error">Solo los administradores de la comunidad pueden realizar esta acci&oacute;n</div>';
		
		// NUEVO RANGO
		$new_rank = intval($_POST['new_rank']);
		if($new_rank > 5 || $new_rank < 1) return '0: El rango seleccionado no es v&aacute;lido';
		
		// MIEMBRO ADMINISTRADO
		$query = $mysqli->query('SELECT m.m_id, m.m_rank, co.comu_admin FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu WHERE m.m_comu = \''.$cid.'\' AND m.m_user = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		
		// MIEMBRO
		if(empty($data['m_rank'])) return '0: Este usuario no es miembro de esta comunidad';
		if($data['m_rank'] == $new_rank) return $msj_ok;
		if($data['comu_admin'] == $uid && $uid != $user->uid) return '0: Imposible editar al primer administrador de la comunidad';
		
		// PROCEDEMOS
		$mysqli->query('UPDATE comus_members SET m_rank = \''.$new_rank.'\' WHERE m_id = \''.$data['m_id'].'\' LIMIT 1');
		return $msj_ok;
	}
	
	function mis_comus($order){
		// GLOBALES
		global $user, $mysqli;
		
		// VARS
		$_GET['order'] = secure($_GET['order']);
		if($_GET['order'] == 'nombre') $order = 'ORDER BY co.comu_name ASC';
		elseif($_GET['order'] == 'miembros') $order = 'ORDER BY co.comu_members DESC';
		elseif($_GET['order'] == 'temas') $order = 'ORDER BY co.comu_topics DESC';
		else $order = 'ORDER BY r.r_id ASC';
		$max = 10;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $max;
		
		// SQL PRINCIPAL
		$query = $mysqli->query('SELECT co.comu_id, co.comu_name, co.comu_seo, co.comu_desc, co.comu_members, co.comu_topics, co.comu_rank, co.comu_last_image, c.c_name, r.r_name FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank WHERE m.m_user = \''.$user->uid.'\' AND m.m_status = \'1\' '.$order.' LIMIT '.$inicio.', '.$max) or die($mysqli->error);
		while($row = $query->fetch_assoc()) $data['list'][] = $row;
		
		// SQL TOTAL
		$query_total = $mysqli->query('SELECT m_id FROM comus_members WHERE m_user = \''.$user->uid.'\'');
		$data['total'] = $query_total->num_rows;
		
		// PAGINACION
		if($data['total'] > $max) $data['pages'] = $this->pag($page, $data['total'], $max, '?', true);
		
		// DATOS
		$data['start'] = ($page * $max) - 9;
		$data['end'] = ($page * $max);
		
		// RECOMENDADAS
		$query_c = $mysqli->query('SELECT comu_id, comu_last_image, comu_seo, comu_name, (comu_members + comu_followers + comu_topics) AS total FROM comus  ORDER BY total DESC LIMIT 28');
		$i = 1;
		$u[1] = rand(1, 7);
		$u[2] = rand(8, 14);
		$u[3] = rand(15, 21);
		$u[4] = rand(22, 28);
		while($row = $query_c->fetch_assoc()){
			if($i == $u[1] || $i == $u[2] || $i == $u[3] || $i == $u[4]) $data['recomendadas'][] = $row;
			$i++;
		}
		
		// RESULTADO
		return $data;
	}
	
	function leave($comu_id){
		global $user, $activity, $mysqli;
		$me = $this->me($comu_id);
		$data_comu = $this->comu_data($comu_id);
		$query_admins = $mysqli->query('SELECT * FROM comus_members WHERE m_comu = \''.$comu_id.'\' AND m_rank = \'1\'');
		// EXISTE?
		if($data_comu['comu_id'] && $data_comu['comu_status'] == 1){
			if($me['m_rank']){
				if($me['m_rank'] != 1 || $query_admins->num_rows != 1){
					$mysqli->query('DELETE FROM comus_members WHERE m_comu = \''.$comu_id.'\' AND m_user = \''.$user->uid.'\' LIMIT 1');
					$mysqli->query('UPDATE comus SET comu_members = comu_members - 1 WHERE comu_id = \''.$comu_id.'\' LIMIT 1');
					$activity->delete(36, $comu_id, $user->uid);
					return '1: <a href="http://smline.net">SMline</a>';
				}else return '0: Esta comunidad debe tener como m&iacute;nimo un administrador';
			}else return '0: No perteneces a esta comunidad pero bueno -.-';
		}else return '0: La comunidad se encuentra actualmente suspendida';
	}

	function join($comu_id){
		global $user, $activity, $mysqli;
		$me = $this->me($comu_id);
		$data_comu = $this->comu_data($comu_id);
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$comu_id.'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return '0: No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>';
		// EXISTE?
		if($data_comu['comu_id'] && $data_comu['comu_status'] == 1){
			if(!$me['m_rank']){
				$mysqli->query('INSERT INTO comus_members (m_user, m_comu, m_rank, m_date) VALUES (\''.$user->uid.'\', \''.$comu_id.'\', \'3\', \''.time().'\')');
				$mysqli->query('UPDATE comus SET comu_members = comu_members + 1 WHERE comu_id = \''.$comu_id.'\' LIMIT 1');
				$activity->insert(36, $comu_id, $user->uid);
				return '1: <a href="http://smline.net">SMline</a>';
			}else return '0: Ya eres miembro de esta comunidad';
		}else return '0: La comunidad se encuentra actualmente suspendida';
	}
	
	function ban($comu_id){
		global $user, $mysqli;
		$data_comu = $this->comu_data($comu_id);
		if($user->permits['scs'] && $data_comu['comu_id']){
			if($data_comu['comu_status'] == 1){
				$mysqli->query('UPDATE comus SET comu_status = \'0\' WHERE comu_id = \''.$comu_id.'\' LIMIT 1');
				return '1: La comunidad fue suspendida correctamente';
			}else return '0:  La comunidad ya se encuentra suspendida';
		}else return '0: No tienes permisos para suspender esta comunidad';
	}

	function unban($comu_id){
		global $user, $mysqli;
		$data_comu = $this->comu_data($comu_id);
		if($user->permits['rcs'] && $data_comu['comu_id']){
			if($data_comu['comu_status'] == 0){
				$mysqli->query('UPDATE comus SET comu_status = \'1\' WHERE comu_id = \''.$comu_id.'\' LIMIT 1');
				return '1: La comunidad fue reactivada correctamente';
			}else return '0:  La comunidad ya se encuentra activa';
		}else return '0: No tienes permisos para reactivar esta comunidad';
	}
	
	function follow($comu_id){
		global $mysqli, $user, $activity;
		if($user->info['u_flood_follow'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
		$query_comu = $mysqli->query('SELECT comu_id FROM comus WHERE comu_id = \''.$comu_id.'\' AND comu_status = \'1\' LIMIT 1');
		$data_comu = $query_comu->fetch_assoc();
		if(!$data_comu['comu_id']) return '0: Esta comunidad se encuentra suspendida';
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$comu_id.'\' AND f_type = \'4\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['f_type'])){
			if($mysqli->query('INSERT INTO follows (f_type, f_type_id, f_user, f_date) VALUES (\'4\', \''.$comu_id.'\', \''.$user->uid.'\', \''.time().'\')')){
				$activity->insert(37, $comu_id, $user->uid);
				$mysqli->query('UPDATE comus SET comu_followers = comu_followers + 1 WHERE comu_id = \''.$comu_id.'\'');
				$mysqli->query('UPDATE users_stats SET u_flood_follow = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Ya est&aacute;s siguiendo esta comunidad';
	}
	
	function unfollow($comu_id){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$comu_id.'\' AND f_type = \'4\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['f_type']){
			if($mysqli->query('DELETE FROM follows WHERE f_type = \'4\' AND f_user = \''.$user->uid.'\' AND f_type_id = \''.$comu_id.'\' LIMIT 1')){
				$activity->delete(37, $comu_id, $user->uid);
				$mysqli->query('UPDATE comus SET comu_followers = comu_followers - 1 WHERE comu_id = \''.$comu_id.'\'');
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: No est&aacute;s siguiendo esta comunidad';
	}
	
	function add_topic(){
		global $mysqli, $user, $activity;
		if(empty($user->permits['pt'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite publicar temas en esta ni en otra comunidad'));
		if($user->info['u_flood_comu'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		$data = array(
			'date' => time(),
			'title' => secure($_POST['title']),
			'body' => secure($_POST['body'], false, true),
		);
		
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
		if(strlen($data['body']) > 100000) return json(array('status' => 0, 'data' => 'El contenido del tema es muy largo, no puede superar los 100.000 caracteres'));
		$comu_id = intval($_POST['comu_id']);
		$data_comu = $this->comu_data($comu_id);
		if(empty($data_comu['comu_id']) || $data_comu['comu_status'] != 1) return json(array('status' => 0, 'data' => 'La comunidad se encuentra actualmente suspendida'));
		
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$comu_id.'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return json(array('status' => 0, 'data' => 'No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>'));
		
		$me = $this->me($comu_id);
		if(empty($me['m_rank'])) return json(array('status' => 0, 'data' => 'Solo miembros de la comunidad pueden publicar en ella'));
		if($me['m_rank'] > 3) return json(array('status' => 0, 'data' => 'Tu rango en esta comunidad no te permite crear temas en ella'));
		
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
        if(empty($user->permits['ft'])) $data['sticky'] = 0;
		else $data['sticky'] = empty($_POST['sticky']) ? 0 : 1;
		if((empty($user->permits['ft']) || empty($user->permits['goadmin'])) && ($me['m_rank'] != 2 || $me['m_rank'] != 1)) $data['sticky'] = 0;
		
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		
		if($user->permits['ptm']){
			$hora = time()-(60*60);
			$query_posts = $mysqli->query('SELECT t_id FROM comus_topics WHERE t_user = \''.$user->uid.'\' AND t_date > \''.$hora.'\'');
			if($query_posts->num_rows > $user->permits['ptm']) return json(array('status' => 0, 'data' => 'Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ptm'].'</b> temas por hora, int&eacute;ntalo de nuevo en unos minutos'));
		}
		
		if(($me['m_rank'] != 2 || $me['m_rank'] != 1) && empty($data_comu['comu_p_post'])) return json(array('status' => 0, 'data' => 'Esta comunidad no permite que sus miembros publiquen temas'));
		
		if($mysqli->query('INSERT INTO comus_topics (t_user, t_title, t_body, t_comu, t_date, t_ip, t_comments_status, t_follow, t_sticky, t_status) VALUES (\''.$user->uid.'\', \''.$data['title'].'\',  \''.$data['body'].'\', \''.$comu_id.'\', \''.$data['date'].'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.$data['nocomments'].'\', \''.$data['follow'].'\', \''.$data['sticky'].'\', \'1\')')){
			$topicID = $mysqli->insert_id;

			$topic_link = '/comunidades/'.$data_comu['comu_seo'].'/'.$topicID.'/'.seo($data['title']).'.html';
			$mysqli->query('UPDATE web_stats SET topics = topics + 1');
			$mysqli->query('UPDATE users_stats SET u_topics = u_topics + 1, u_flood_comu = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
			$mysqli->query('UPDATE comus SET comu_topics = comu_topics + 1 WHERE comu_id = \''.$comu_id.'\'');
			$activity->insert(38, $topicID, $user->uid);
			return json(array('status' => 1, 'data' => 'El tema <b>'.$data['title'].'</b> fue agregado con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ir al tema »" onclick="location.href=\''.$topic_link.$quote.'\'"></center>', 'link' => $topic_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde: '.$mysqli->error));
	}
	
	function get_edit_topic(){
		global $mysqli, $user;
		$tid = intval($_GET['tid']);
		$query = $mysqli->query('SELECT t_id, t_user, t_title, t_body, t_comments_status, t_sticky, t_comu FROM comus_topics WHERE t_id = \''.$tid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$me = $this->me($data['t_comu']);
		if(empty($user->permits['et']) && $me['m_rank'] != 1 && $me['m_rank'] != 2 && $data['t_user'] != $user->uid) return 'No tienes permisos para editar este tema';
		if(empty($data)) return 'El tema que buscas no existe';
		if(empty($user->permits['etp'])) return 'Tu rango no te permite editar tus propios temas';
		return $data;
	}
	
	function save_topic(){
		global $mysqli, $user, $activity;
		
		$tid = intval($_POST['tid']);
		$query = $mysqli->query('SELECT t_id, t_user, t_title, t_body, t_comments_status, t_sticky, t_comu FROM comus_topics WHERE t_id = \''.$tid.'\' LIMIT 1');
		$datat = $query->fetch_assoc();
		$me = $this->me($datat['t_comu']);
		if(empty($user->permits['et']) && $me['m_rank'] != 1 && $me['m_rank'] != 2 && $datat['t_user'] != $user->uid) return json(array('status' => 0, 'data' => 'No tienes permisos para editar este tema'));
		if(empty($datat)) return json(array('status' => 0, 'data' => 'El tema que buscas no existe'));
		if(empty($user->permits['etp'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite editar tus propios temas'));
		
		$data = array(
			'date' => time(),
			'title' => secure($_POST['title']),
			'body' => secure($_POST['body'], false, true),
			'reason' => secure($_POST['reason']),
		);
		
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
		if(strlen($data['body']) > 100000) return json(array('status' => 0, 'data' => 'El contenido del tema es muy largo, no puede superar los 100.000 caracteres'));

		$data_comu = $this->comu_data($datat['t_comu']);
		if(empty($data_comu['comu_id']) || $data_comu['comu_status'] != 1) return json(array('status' => 0, 'data' => 'La comunidad se encuentra actualmente suspendida'));
		
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$comu_id.'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return json(array('status' => 0, 'data' => 'No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>'));
		
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
        if(empty($user->permits['ft'])) $data['sticky'] = 0;
		else $data['sticky'] = empty($_POST['sticky']) ? 0 : 1;
		if((empty($user->permits['ft']) || empty($user->permits['goadmin'])) && ($me['m_rank'] != 2 || $me['m_rank'] != 1)) $data['sticky'] = 0;
		
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		
		if($mysqli->query('UPDATE comus_topics SET t_title = \''.$data['title'].'\', t_body = \''.$data['body'].'\', t_comments_status = \''.$data['nocomments'].'\', t_follow = \''.$data['follow'].'\', t_sticky = \''.$data['sticky'].'\' WHERE t_id = \''.$tid.'\'')){
			$topicID = $mysqli->insert_id;

			$topic_link = '/comunidades/'.$data_comu['comu_seo'].'/'.$tid.'/'.seo($data['title']).'.html';
			
			if($datat['t_user'] != $user->uid){
				$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'5\', \''.$tid.'\', \''.$user->uid.'\', \''.time().'\', \'3\', \''.$data['reason'].'\')');
			}
			
			return json(array('status' => 1, 'data' => 'El tema <b>'.$data['title'].'</b> fue editado con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ver cambios realizados »" onclick="location.href=\''.$topic_link.$quote.'\'"></center>', 'link' => $topic_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde: '.$mysqli->error));
	}
	
	function get_topic($topic_id, $comu_seo, $topic_title){
		global $mysqli, $user, $web;
		$query = $mysqli->query('SELECT t.*, s.*, co.*, me.*, cr.*, c.c_name, c.c_seo, u.u_id, u.u_nick, u.u_date, u.u_country, u.u_last_avatar FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = t.t_user LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_stats AS s ON u.u_id = s.u_id LEFT JOIN comus_members AS me ON me.m_user = t.t_user LEFT JOIN comus_ranks AS cr ON cr.r_id = me.m_rank WHERE t.t_id = \''.$topic_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(($comu_seo != $data['comu_seo'] || $topic_title != seo($data['t_title'])) && $data['t_id']) header('location: /comunidades/'.$data['comu_seo'].'/'.$topic_id.'/'.seo($data['t_title']).'.html');
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$data['t_html'] = $data['t_body'];
		$data['t_body'] = $bbcode->start(secure($data['t_body'], false, true), true, true, $data['t_title']);
		require_once'PHP/libs/datos.php';
		$data['u_country_icon'] = strtolower($data['u_country']);
		$data['u_country'] = $array_data['paises'][$data['u_country']];
		$data['u_register'] = array(date('d', $data['u_date']),$time_data['meces'][date('M', $data['u_date'])],date('Y', $data['u_date']));
		date('d \d\e F \d\e Y', $data['u_date']);
		$data_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'5\' AND v_type_id = \''.$topic_id.'\' AND v_user = \''.$user->uid.'\' LIMIT 1')->fetch_assoc();
		$data['vote'] = $data_vote['v_id'];
		if($data['t_comments'] > 0){
			$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'5\' AND c.c_type_id = \''.$topic_id.'\' ORDER BY c.c_id ASC');
			$i = 0;
			while($row = $query_comments->fetch_assoc()){
				$query_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'6\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
				$data_vote = $query_vote->fetch_assoc();
				$data['comments'][$i] = $row;
				if(!empty($data_vote)) $data['comments'][$i]['vote'] = true;
				$data['comments'][$i]['c_body'] = $bbcode->start(secure($row['c_body'], false, true));
				$i++;
			}
		}
		if($user->uid){
			$query_fav = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$topic_id.'\' AND f_type = \'5\' LIMIT 1');
			$data_fav = $query_fav->fetch_assoc();
			if($data_fav['f_id']) $data['t_is_fav'] = true;
			$me = $this->me($data['comu_id']);
		}
		if($user->permits['gomod'] || $user->permits['gomadmin'] || $me['m_rank'] == 1 || $me['m_rank'] == 2){
			$query_history = $mysqli->query('SELECT h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod WHERE h.h_type = \'5\' AND h.h_type_id = \''.$topic_id.'\' ORDER BY h.h_id DESC');
			while($history = $query_history->fetch_assoc()) $data['history'][] = $history;
		}
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('Su IP no es real');
		$query_hit = $mysqli->query('SELECT h_user FROM hits WHERE (h_ip = \''.$_SERVER['REMOTE_ADDR'].'\' OR (h_user = \''.$user->uid.'\' AND h_user > 0)) AND h_type = \'5\' AND h_type_id = \''.$topic_id.'\'');
		$visitado = $query_hit->num_rows;
		if(empty($visitado) && $user->uid != $data['t_user']){
			$mysqli->query('INSERT INTO hits (h_type, h_type_id, h_user, h_ip, h_date) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.time().'\')');
			$mysqli->query('UPDATE comus_topics SET t_hits = t_hits + 1 WHERE t_id = \''.$topic_id.'\' LIMIT 1');
		}
		$data['related'] = $this->related_topics($data['t_title'], $data['t_id']);
		if(empty($data['t_id'])) return array('No encontramos el tema.', 'El tema que intentas buscar no existe o fue eliminado de por vida.', '');
		else if($data['t_status'] == 0 && !$user->permits['vpb'] && $me['m_rank'] != 1 && $me['m_rank'] != 2) return array('Tema eliminado.', 'Este tema se encuentra eliminado, solo los moderadores de la comunidad podr&aacute;n acceder a &eacute;l.', $data['related']);
		return $data;
	}
	
	function related_topics($search, $omite){
		global $mysqli;
		//$busqueda = 'p.p_tags LIKE \'%'.secure($search).'%\'';
		$busqueda = 'MATCH (t.t_title) AGAINST (\''.secure($search).'\' IN BOOLEAN MODE)';
		$sql = $mysqli->query('SELECT t.*, co.*, ca.* FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat WHERE '.$busqueda.' AND t.t_status = \'1\' AND t.t_id != \''.$omite.'\' ORDER BY RAND() LIMIT 10');
		while($row = $sql->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function vote_topic($topic_id, $vote){
		global $mysqli, $user, $activity, $notifica;
		// VALIDAMOS LA IP
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no se pudo validar';
		$vote = $vote == 0 ? 't_negatives' : 't_positives';
		// TIENE PERMISOS PARA VOTAR?
		if(!$user->permits['vpt'] && $vote == 't_positives') return '0: Tu rango no te permite votar positivo a los comentarios';
		if(!$user->permits['vnt'] && $vote == 't_negatives') return '0: Tu rango no te permite votar negativo a los comentarios';
		// COMPROBAMOS EXCESO DE VOTOS
		$hora = time()-(60*60);
		$query_votes_pos = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'5\' AND v_val = \'+\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		$query_votes_neg = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'5\' AND v_val = \'-\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		if($query_votes_pos->num_rows > $user->permits['vptm']) '0: Ya haz votado positivo bastantes veces por el momento';
		if($query_votes_neg->num_rows > $user->permits['vntm']) '0: Ya haz votado negativo bastantes veces por el momento';
		// OBTENEMOS LOS DATOS DEL COMENTARIO
		$query['topic'] = $mysqli->query('SELECT t_id, t_user, t_comu FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_status = \'1\' LIMIT 1');
		$data['topic'] = $query['topic']->fetch_assoc();
		if(empty($data['topic']['t_id'])) return '0: El tema se encuentra eliminado o no existe';
		if($data['topic']['t_user'] == $user->uid) return '0: No puedes votar tus propios temas';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'5\' AND v_type_id = \''.$topic_id.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un misma tema m&aacute;s de una vez';
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$data['topic']['t_comu'].'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return '0: No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>';
		// ES MIEMBRO
		$me = $this->me($data['topic']['t_comu']);
		if(empty($me['m_rank'])) return '0: Solo miembros de la comunidad pueden votar temas en ella';
		// ACTUALIZAMOS E INSERTAMOS
		$mysqli->query('UPDATE comus_topics SET '.$vote.' = '.$vote.' + 1 WHERE t_id = \''.$topic_id.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'5\', \''.$topic_id.'\', \''.$vote.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$actividad = $vote == 't_positives' ? 41 : 42;
		$activity->insert($actividad, $topic_id, $user->uid);
		$notifica->insert($actividad, $topic_id, $data['topic']['t_user']);
		return '1: SMline.NET';
	}
	
	function comment_topic(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment'], false, true);
		$topic_id = intval($_POST['topic_id']);
		if(es_nulo($body)) die('0: Ingresa una respuesta');
		$query = $mysqli->query('SELECT t_id, t_comments_status, t_comu, t_user FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_status = \'1\' LIMIT 1');
		$post = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: Este tema se encuentra eliminado o a&uacute; no ha sido publicado');
		if($post['t_comments_status'] != '1') die('0: Este tema no permite respuestas');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// ES MIEMBRO
		$me = $this->me($post['t_comu']);
		if(empty($me['m_rank'])) die('0: Solo miembros de la comunidad pueden responder los temas');
		if($me['m_rank'] > 4) return die('0: Tu rango en esta comunidad no te permite responder temas en ella');
		if(($me['m_rank'] != 2 || $me['m_rank'] != 1) && empty($me['comu_p_com'])) die('0: Esta comunidad no permite que sus miembros publiquen respuestas');
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$post['t_comu'].'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return '0: No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>';
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'5\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> respuestas por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		//BLOQUEADO
		if($user->i_block($post['t_user'])) die('0: '.$user->get_nick($post['t_user']).' te ha bloqueado, no puedes comentar sus temas');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\')');
		$new_id = $mysqli->insert_id;
		$activity->insert(39, $new_id, $user->uid, $topic_id);
		$notifica->insert(39, $new_id, $post['t_user'], $topic_id);
		$notifica->insert_to_follows(43, $topic_id, $topic_id, 5, $post['t_user']);
		$mysqli->query('UPDATE web_stats SET replies = replies + 1');
		$mysqli->query('UPDATE comus_topics SET t_comments = t_comments + 1 WHERE t_id = \''.$topic_id.'\'');
		$mysqli->query('UPDATE users_stats SET u_replies = u_replies + 1, u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		return array($new_id, $body_bb, time());
	}
	
	function send_replie(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden enviar respuestas');
		$body = secure($_POST['comment'], false, true);
		$cid = intval($_POST['cid']);
		if(es_nulo($body)) die('0: Ingresa una respuesta');
		
		$query_comment = $mysqli->query('SELECT c_type_id, c_user FROM comments WHERE c_id = \''.$cid.'\' AND c_type = \'5\' LIMIT 1');
		$data_comment = $query_comment->fetch_assoc();
		if(es_nulo($data_comment)) die('0: El comentario que buscas no existe');
		
		$query = $mysqli->query('SELECT t_id, t_comments_status, t_comu, t_user FROM comus_topics WHERE t_id = \''.$data_comment['c_type_id'].'\' AND t_status = \'1\' LIMIT 1');
		$post = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: El tema que buscas no existe');
		if($post['t_comments_status'] != '1') die('0: Este tema no permite respuestas');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// ES MIEMBRO
		$me = $this->me($post['t_comu']);
		if(empty($me['m_rank'])) die('0: Solo miembros de la comunidad pueden responder los temas');
		if($me['m_rank'] > 4) return die('0: Tu rango en esta comunidad no te permite responder temas en ella');
		if(($me['m_rank'] != 2 || $me['m_rank'] != 1) && empty($me['comu_p_com'])) die('0: Esta comunidad no permite que sus miembros publiquen respuestas');
		// BANEADO?
		$banned = $mysqli->query('SELECT b_reason, b_end FROM comus_bans WHERE b_comu = \''.$post['t_comu'].'\' AND b_user = \''.$user->uid.'\' LIMIT 1');
		$ban = $banned->fetch_assoc();
		if($ban['b_end'] == 0) $term = 'Indefinido';
		else $term = date('d/m/Y - H:i:s', $ban['b_end']);
		if($banned->num_rows) return '0: No puedes participar en esta comunidad ya que fuiste suspendido de la misma<br><br><b>Causa:</b> '.$ban['b_reason'].'<b><br><br><b>Termina:</b> '.$term.'<b>';
		// PUEDE COMENTAR?
		if(empty($user->permits['pc'])) die('0: Tu rango no te permite publicar respuestas en este tema');
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'6\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> respuestas por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		//BLOQUEADO
		if($user->i_block($post['t_user'])) die('0: '.$user->get_nick($post['t_user']).' te ha bloqueado, no puedes comentar sus temas');
		if($user->i_block($data_comment['c_user'])) die('0: '.$user->get_nick($data_comment['c_user']).' te ha bloqueado, no puedes responder sus comentarios');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date, c_replie_id) VALUES (\'6\', \''.$data_comment['c_type_id'].'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\', \''.$cid.'\')');
		$r_id = $mysqli->insert_id;
		$activity->insert(34, $cid, $user->uid);
		$notifica->insert(34, $cid, $data_comment['c_user']);
		$mysqli->query('UPDATE web_stats SET replies = replies + 1');
		$mysqli->query('UPDATE comments SET c_replies = c_replies + 1 WHERE c_id = \''.$cid.'\'');
		$mysqli->query('UPDATE comus_topics SET t_comments = t_comments + 1 WHERE t_id = \''.$data_comment['c_type_id'].'\'');
		$mysqli->query('UPDATE users_stats SET u_replies = u_replies + 1, u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		return array($r_id, $body_bb, time(), 'topic');
	}
	
	function del_comment($cid){	
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user, c_type, c_type_id, c_replies, c_replie_id FROM comments WHERE (c_type = \'5\' OR c_type = \'6\') AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$data['c_type_id'].'\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		// ADMIN
		$me = $this->me($data_topic['t_comu']);
		// NO EXISTE
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['bc'] && $user->uid != $data['c_user'] && $user->uid != $data_topic['t_user'] && $me['m_rank'] != 2 && $me['m_rank'] != 1) return '0: Este comentario no te pertenece, no lo puedes editar';
		// TIENE PERMISOS?
		if($user->permits['bcp']){
			// BORRAR COMENTARIO + RESPUETAS
			$total_a_borrar = $data['c_replies'] + 1;
			//$activity->delete(4, $cid, $user->uid, $data['c_type_id']);
			if($data['c_type'] == 5) $mysqli->query('DELETE FROM comments WHERE (c_type = \'5\' AND c_id = \''.$cid.'\') OR (c_type = \'6\' && c_replie_id = \''.$cid.'\')');
			else if($data['c_type'] == 6){
				$mysqli->query('DELETE FROM comments WHERE c_type = \'6\' AND c_id = \''.$cid.'\'');
				$mysqli->query('UPDATE comments SET c_replies = c_replies - \'1\' WHERE c_id = \''.$data['c_replie_id'].'\' AND c_type = \'5\'');
			}
			$mysqli->query('UPDATE web_stats SET replies = replies - \''.$total_a_borrar.'\'');
			$mysqli->query('UPDATE comus_topics SET t_comments = t_comments - \''.$total_a_borrar.'\' WHERE t_id = \''.$data['c_type_id'].'\'');
			$mysqli->query('UPDATE users_stats SET u_replies = u_replies - 1 WHERE u_id = \''.$data['c_user'].'\'');
			return '1: El comentario fue eliminado con exito';
		}else return '0: Tu rango no te permite eliminar tus comentarios';
	}
	
	function mod_delete($topic_id){
		global $mysqli, $user, $activity;
		$reason = secure($_POST['reason']);
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_status != \'0\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		//$comu_data = $comu_data($data_topic['t_comu']);
		$me = $this->me($data_topic['t_comu']);
		if(empty($user->permits['bt']) && $me['m_rank'] != 1 && $me['m_rank'] != 2) return '0: Imposible continuar';
		if($data_topic){
			if($user->uid == $data_topic['t_user']) return '0: Este tema es tuyo, no puedes borrarlo de esta forma';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\', \'1\', \''.$reason.'\')');
			//$activity->delete(2, $topic_id, $data_topic['t_user']);
			$mysqli->query('UPDATE comus_topics SET t_status = \'0\' WHERE t_id = \''.$topic_id.'\'');
			$mysqli->query('UPDATE web_stats SET topics = topics - 1');
			$mysqli->query('UPDATE users_stats SET u_topics = u_topics - 1 WHERE u_id = \''.$data_topic['t_user'].'\'');
			$mysqli->query('UPDATE comus SET comu_topics = comu_topics - 1 WHERE comu_id = \''.$data_topic['t_comu'].'\'');
			return '1: El tema fue eliminado';
		}else return '0: Este tema ya se encuentra eliminado';
	}
	
	function mod_reac($topic_id){
		global $mysqli, $user;
		$reason = '-';
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_status = \'0\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		$me = $this->me($data_topic['t_comu']);
		if(empty($user->permits['vpb']) && $me['m_rank'] != 1 && $me['m_rank'] != 2) return '0: Imposible continuar';
		if($data_topic){
			if($user->uid == $data_topic['t_user'] && !$user->permits['goadmin']) return '0: No puedes reactivar tus propios temas';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\', \'2\', \''.$reason.'\')');
			$mysqli->query('UPDATE web_stats SET topics = topics + 1');
			$mysqli->query('UPDATE comus_topics SET t_status = \'1\' WHERE t_id = \''.$topic_id.'\'');
			$mysqli->query('UPDATE users_stats SET u_topics = u_topics + 1 WHERE u_id = \''.$data_topic['t_user'].'\'');
			$mysqli->query('UPDATE comus SET comu_topics = comu_topics + 1 WHERE comu_id = \''.$data_topic['t_comu'].'\'');
			return '1: El tema fue reactivado y ser&aacute; visible para todos los usuarios';
		}else return '0: Este tema ya se encuentra reactivado';
	}
	
	function mod_add_sticky($topic_id){
		global $mysqli, $user;
		$reason = '-';
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_sticky = \'0\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		$me = $this->me($data_topic['t_comu']);
		if(empty($user->permits['ft']) && $me['m_rank'] != 1 && $me['m_rank'] != 2) return '0: Imposible continuar';
		if($data_topic){
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\', \'6\', \''.$reason.'\')');
			$mysqli->query('UPDATE comus_topics SET t_sticky = \'1\' WHERE t_id = \''.$topic_id.'\'');
			return '1: El tema fue fijado exitosamente';
		}else return '0: Este tema ya se encuentra fijado';
	}
	
	function mod_remove_sticky($topic_id){
		global $mysqli, $user;
		$reason = '-';
		$query_topic = $mysqli->query('SELECT t_user, t_comu FROM comus_topics WHERE t_id = \''.$topic_id.'\' AND t_sticky = \'1\' LIMIT 1');
		$data_topic = $query_topic->fetch_assoc();
		$me = $this->me($data_topic['t_comu']);
		if(empty($user->permits['dt']) && $me['m_rank'] != 1 && $me['m_rank'] != 2) return '0: Imposible continuar';
		if($data_topic){
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'5\', \''.$topic_id.'\', \''.$user->uid.'\', \''.time().'\', \'7\', \''.$reason.'\')');
			$mysqli->query('UPDATE comus_topics SET t_sticky = \'0\' WHERE t_id = \''.$topic_id.'\'');
			return '1: El tema fue desfijado exitosamente';
		}else return '0: Este tema no se encuentra fijado';
	}
	
	function home_top_comus(){
		global $mysqli;
		$query = $mysqli->query('SELECT comu_name, comu_seo, comu_members FROM comus WHERE comu_status = \'1\' ORDER BY comu_members DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function popular_comu(){
		global $mysqli;
		$query = $mysqli->query('SELECT comu_name, comu_id, comu_last_image, comu_seo, comu_members, SUM(comu_members + comu_followers + comu_topics) AS total FROM comus WHERE comu_status = \'1\' GROUP BY comu_id ORDER BY total DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		shuffle($result);
		$result_no_array = $result[0];
		return $result_no_array;
	}
	
}
?>