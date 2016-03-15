<?php
/*! Powered by SMline.NET */
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class posts{
	
	function cats(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM posts_cats AS c ORDER BY c.c_name ASC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function cat_info($c_seo){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM posts_cats AS c WHERE c_seo = \''.$c_seo.'\'');
		$data = $query->fetch_assoc();
		return $data;
	}
	
	function validTags($tags){
        if(es_nulo($tags)) return false;
        else{
            $tags = explode(',',$tags);
            if(count($tags) < 4) return false;
            foreach($tags as $val){
                if(es_nulo($val)) return false;
            }   
        }
        return true;
    }
	
	function img_port($url){
		$img_url = secure($url);
		$data['img'] = getimagesize($img_url);
		$min_w = 154;
		$min_h = 116;
		$max_w = 2000;
		$max_h = 2000;
		if(empty($data['img'][0])) return '0: La imagen de portada no existe o no es una imagen v&aacute;lida';
		elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return '0: La imagen debe tener un tama&ntilde;o superior a 154x116 pixeles';
		elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return '0: La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles';
		return '1: SMline';
	}
	
	function add(){
		global $mysqli, $user, $web, $activity, $notifica;
		$quote = "'";
		if(es_nulo($user->uid)) return json(array('status' => 0, 'data' => 'Usuarios anonimos no pueden postear'));
		if(empty($user->permits['pp'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite publicar posts'));
		if($user->info['u_flood_post'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		$data = array(
			'date' => time(),
			'title' => secure($_POST['title']),
			'body' => secure($_POST['body'], false, true),
			'tags' => secure($_POST['tags']),
			'category' => intval($_POST['cat']),
		);
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
        $tags = $this->validTags($data['tags']);
        if(empty($tags)) return json(array('status' => 0, 'data' => 'Tienes que ingresar por lo menos <b>4</b> tags separados por coma'));
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
        if(empty($user->permits['fp'])) $data['sticky'] = 0;
		else $data['sticky'] = empty($_POST['sticky']) ? 0 : 1;
		if(empty($user->permits['fp']) || empty($user->permits['goadmin'])) $data['sticky'] = 0;
        else if($_POST['patro']) $data['sticky'] = 2;
		$status =  empty($user->permits['sprr']) ? 1 : 2;
		if($status == 2){
			$query_posts_aprobados = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$user->uid.'\' AND p_status = \'1\'');
			if($query_posts_aprobados->num_rows > $user->permits['sprrp']) $status = 1;
		}
		$query = $mysqli->query('SELECT c_id, c_seo FROM posts_cats WHERE c_id = \''.$data['category'].'\' LIMIT 1');
		$data_cat = $query->fetch_assoc();
		if($query->num_rows == 0) return json(array('status' => 0, 'data' => 'La categor&iacute;a especificada no existe'));
		if($web['port_posts']){
			$x1 = secure($_POST['thumb_x1']);
			$y1 = secure($_POST['thumb_y1']);
			$x2 = secure($_POST['thumb_x2']);
			$y2 = secure($_POST['thumb_y2']);
			$w = secure($_POST['thumb_w']);
			$h = secure($_POST['thumb_h']);
			$img_url = secure($_POST['img_url']);
			$data['img'] = getimagesize($img_url);
			$min_w = 154;
			$min_h = 116;
			$max_w = 2000;
			$max_h = 2000;
			if(empty($data['img'][0])) return json(array('status' => 0, 'data' => 'La imagen de portada no existe o no es una imagen v&aacute;lida'));
			elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o superior a 154x116 pixeles'));
			elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles'));
		}
		
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		
		if($user->permits['cp']){
			$recaptcha = secure($_POST['recaptcha_response_field']);
			$recaptcha_2 = secure($_POST['recaptcha_challenge_field']);
			if((empty($recaptcha) || $recaptcha == 'undefined') && (empty($recaptcha_2) || $recaptcha_2 == 'undefined')) return json(array('status' => 2, 'data' => '<div class="post-create"><li class="list_item"><div id="recaptcha_image"></div><label for="recaptcha_response_field">Ingresa el código de la imagen <a onclick="Recaptcha.reload();" class="stip" title="Cambiar imagen"><img src="'.$web['img'].'/icons/reboot.png" width="12px" height="12px" /></a><br /></label><input type="text" style="width: 250px;display: block;" id="recaptcha_response_field" class="inp_text" name="recaptcha_response_field" value="" autocomplete="off"></li></div>'));
			else {
				require_once'PHP/libs/recaptchalib.php';
				require_once'PHP/libs/datos.php';
				$robot = recaptcha_check_answer(PRIVATE_KEY, $_SERVER['REMOTE_ADDR'], $recaptcha_2, $recaptcha);		
				if(!$robot->is_valid) return json(array('status' => 0, 'data' => 'El código de la imagen no es correcto'));
			}
		}
		
		if($user->permits['ppm']){
			$hora = time()-(60*60);
			$query_posts = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$user->uid.'\' AND p_date > \''.$hora.'\'');
			if($query_posts->num_rows > $user->permits['ppm']) return json(array('status' => 0, 'data' => 'Tu rango solo te permite publicar <b>'.$user->permits['ppm'].'</b> posts por hora, int&eacute;ntalo de nuevo en unos minutos'));
		}
		if($mysqli->query('INSERT INTO posts (p_user, p_cat, p_title, p_body, p_date, p_update, p_tags, p_ip, p_comments_status, p_follow, p_sticky, p_status) VALUES (\''.$user->uid.'\', \''.$data['category'].'\', \''.$data['title'].'\',  \''.$data['body'].'\', \''.$data['date'].'\', \''.$data['date'].'\' , \''.$data['tags'].'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.$data['nocomments'].'\', \''.$data['follow'].'\', \''.$data['sticky'].'\', \''.$status.'\')')){
			$postID = $mysqli->insert_id;
			if($web['port_posts']){
				include('PHP/class/images.class.php');
				$img = new img;
				$img->upload($img_url, 't_'.$postID, 154, 116, $x1, $y1, false, $w, $h, '/thumbs/posts/');
			}
			$post_link = '/posts/'.$data_cat['c_seo'].'/'.$postID.'/'.seo($data['title']).'.html';
			if($status == 1){
				$mysqli->query('UPDATE web_stats SET posts = posts + 1');
				$mysqli->query('UPDATE users_stats SET u_posts = u_posts + 1, u_flood_post = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
				$activity->insert(2, $postID, $user->uid);
				$notifica->insert_to_follows(2, $postID, $user->uid, '1');
			}
			if($status == 2) return json(array('status' => 1, 'data' => 'El post <b>'.$data['title'].'</b> ser&aacute; revisado por un moderador antes de ser publicado. Esta restricci&oacute;n ser&aacute; eliminada cuando tengas '.$user->permits['sprrp'].' posts aprobados.<br><br><center><input type="button" class="button_1 b_ok" value="Ir al inicio" onclick="location.href='.$quote.'/'.$quote.'"></center>'));
			else return json(array('status' => 1, 'data' => 'El post <b>'.$data['title'].'</b> fue agregado con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ir al post »" onclick="location.href='.$quote.$post_link.$quote.'"></center>', 'link' => $post_link));
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
	}
	
	function save(){
		global $mysqli, $user, $web, $activity;
		$quote = "'";
		$pid = intval($_POST['pid']);
		if(es_nulo($user->uid)) return json(array('status' => 0, 'data' => 'Usuarios anonimos no pueden postear'));
		if(empty($user->permits['epp'])) return json(array('status' => 0, 'data' => 'Tu rango no te permite editar posts'));
		
		$query = $mysqli->query('SELECT p_id, p_user, p_title, p_body, p_tags, p_cat, p_comments, p_follow, p_sticky, p_status FROM posts WHERE p_id = \''.$pid.'\' '.(empty($user->permits['ep']) ? 'AND p_user = \''.$user->uid.'\'' : '').' LIMIT 1');
		$datap = $query->fetch_assoc();
		if(empty($datap)) return json(array('status' => 0, 'data' => 'El post que buscas no te pertenece o no existe'));
		
		if($user->info['u_flood_post'] > $user->info['flood']) return json(array('status' => 0, 'data' => 'No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes'));
		$data = array(
			'title' => secure($_POST['title']),
			'body' => secure($_POST['body'], false, true),
			'tags' => secure($_POST['tags']),
			'category' => intval($_POST['cat']),
			'reason' => secure($_POST['reason'])
		);
		foreach($data as $key => $val){
			if(es_nulo($val)) return json(array('status' => 0, 'data' => 'Todos los campos son requeridos'));
		}
        $tags = $this->validTags($data['tags']);
        if(empty($tags)) return json(array('status' => 0, 'data' => 'Tienes que ingresar por lo menos <b>4</b> tags separados por coma'));
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
        if(empty($user->permits['fp'])) $data['sticky'] = 0;
		else $data['sticky'] = empty($_POST['sticky']) ? 0 : 1;
		if(empty($user->permits['fp']) || empty($user->permits['goadmin'])) $data['sticky'] = 0;
        else if($_POST['patro']) $data['sticky'] = 2;
		$status =  empty($user->permits['sprr']) ? 1 : 2;
		if($status == 2){
			$query_posts_aprobados = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$user->uid.'\' AND p_status = \'1\'');
			if($query_posts_aprobados->num_rows > $user->permits['sprrp']) $status = 1;
		}
		$query_cat = $mysqli->query('SELECT c_id, c_seo FROM posts_cats WHERE c_id = \''.$data['category'].'\' LIMIT 1');
		$data_cat = $query_cat->fetch_assoc();
		if($query_cat->num_rows == 0) return json(array('status' => 0, 'data' => 'La categor&iacute;a especificada no existe'));
		
		if($web['port_posts'] && $_POST['img_url']){
			$x1 = secure($_POST['thumb_x1']);
			$y1 = secure($_POST['thumb_y1']);
			$x2 = secure($_POST['thumb_x2']);
			$y2 = secure($_POST['thumb_y2']);
			$w = secure($_POST['thumb_w']);
			$h = secure($_POST['thumb_h']);
			$img_url = secure($_POST['img_url']);
			$data['img'] = getimagesize($img_url);
			$min_w = 154;
			$min_h = 116;
			$max_w = 2000;
			$max_h = 2000;
			if(empty($data['img'][0])) return json(array('status' => 0, 'data' => 'La imagen de portada no existe o no es una imagen v&aacute;lida'));
			elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o superior a 154x116 pixeles'));
			elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return json(array('status' => 0, 'data' => 'La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles'));
		}
		
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return json(array('status' => 0, 'data' => 'Su IP no es real'));
		
		if($user->permits['cp']){
			$recaptcha = secure($_POST['recaptcha_response_field']);
			$recaptcha_2 = secure($_POST['recaptcha_challenge_field']);
			if((empty($recaptcha) || $recaptcha == 'undefined') && (empty($recaptcha_2) || $recaptcha_2 == 'undefined')) return json(array('status' => 2, 'data' => '<div class="post-create"><li class="list_item"><div id="recaptcha_image"></div><label for="recaptcha_response_field">Ingresa el código de la imagen <a onclick="Recaptcha.reload();" class="stip" title="Cambiar imagen"><img src="'.$web['img'].'/icons/reboot.png" width="12px" height="12px" /></a><br /></label><input type="text" style="width: 250px;display: block;" id="recaptcha_response_field" class="inp_text" name="recaptcha_response_field" value="" autocomplete="off"></li></div>'));
			else {
				require_once'PHP/libs/recaptchalib.php';
				require_once'PHP/libs/datos.php';
				$robot = recaptcha_check_answer(PRIVATE_KEY, $_SERVER['REMOTE_ADDR'], $recaptcha_2, $recaptcha);		
				if(!$robot->is_valid) return json(array('status' => 0, 'data' => 'El código de la imagen no es correcto'));
			}
		}
		
		if($user->permits['ppm'] && $datap['p_user'] == $user->uid){
			$hora = time()-(60*60);
			$query_posts = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$user->uid.'\' AND p_date > \''.$hora.'\'');
			if($query_posts->num_rows > $user->permits['ppm']) return json(array('status' => 0, 'data' => 'Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> posts por hora, int&eacute;ntalo de nuevo en unos minutos'));
		}
		if($datap['p_status'] == 0) $status = 0;
		if($mysqli->query('UPDATE posts SET p_cat = \''.$data['category'].'\', p_title = \''.$data['title'].'\', p_body = \''.$data['body'].'\', p_tags = \''.$data['tags'].'\', p_comments_status = \''.$data['nocomments'].'\', p_follow = \''.$data['follow'].'\', p_sticky = \''.$data['sticky'].'\', p_status = \''.$status.'\', p_update = \''.time().'\' WHERE p_id = \''.$datap['p_id'].'\'')){
			if($web['port_posts'] && $_POST['img_url']){
				include('PHP/class/images.class.php');
				$img = new img;
				$img->upload($img_url, 't_'.$datap['p_id'], 154, 116, $x1, $y1, false, $w, $h, '/thumbs/posts/');
			}
			$post_link = '/posts/'.$data_cat['c_seo'].'/'.$datap['p_id'].'/'.seo($data['title']).'.html';
			if($status != $datap['p_status']){
				if($datap['p_status'] == 1){
					$mysqli->query('UPDATE web_stats SET posts = posts + 1');
					$mysqli->query('UPDATE users_stats SET u_posts = u_posts + 1, u_flood_post = \''.time().'\' WHERE u_id = \''.$datap['p_user'].'\'');
				}else{
					//$mysqli->query('UPDATE web_stats SET posts = posts - 1');
					//$mysqli->query('UPDATE users_stats SET u_posts = u_posts - 1, u_flood_post = \''.time().'\' WHERE u_id = \''.$datap['p_user'].'\'');
				}
			}
			if($status == 2) return json(array('status' => 1, 'data' => 'El post <b>'.$data['title'].'</b> ser&aacute; revisado por un moderador antes de ser publicado. Esta restricci&oacute;n ser&aacute; eliminada cuando tengas '.$user->permits['sprrp'].' posts aprobados.<br><br><center><input type="button" class="button_1 b_ok" value="Ir al inicio" onclick="location.href='.$quote.'/'.$quote.'"></center>'));
			else {
				if($datap['p_user'] == $user->uid){
					$activity->insert(3, $datap['p_id'], $user->uid);
				}else if($data['title'] != $datap['p_title'] || $data['body'] != $datap['p_body'] || $data['category'] != $datap['p_cat']){
					$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'3\', \''.$data['reason'].'\')');
				}
				return json(array('status' => 1, 'data' => 'El post <b>'.$data['title'].'</b> ha sido editado con exito.<br><br><center><input type="button" class="button_1 b_ok" value="Ir al post »" onclick="location.href='.$quote.$post_link.$quote.'"></center>', 'link' => $post_link));
			}
		}else return json(array('status' => 0, 'data' => 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'));
	}
	
	function save_borrador(){
		global $mysqli, $user, $web;
		if(es_nulo($user->uid)) return 'Usuarios anonimos no pueden guardar borradores';
		if($user->info['u_flood_post'] > $user->info['flood']) return 'No puedes realizar tantas acciones seguidas';
		$data = array(
			'date' => time(),
			'title' => secure($_POST['title']),
			'body' => secure($_POST['body'], false, true),
			'tags' => secure($_POST['tags']),
			'category' => intval($_POST['cat']),
		);
		foreach($data as $key => $val){
			if(es_nulo($val)) return 'Todos los campos son necesarios para guardar un borrador';
		}
		
		// YA LO GUARDO?
		$query = $mysqli->query('SELECT p_id FROM borradores WHERE p_title = \''.$data['title'].'\' AND p_body= \''.$data['body'].'\', p_date = \''.$data['date'].'\' LIMIT 1');
		if($query->num_rows) return 'El borrador fue guardado correctamente a las '.date("H:i:s",time());
		
		$data['follow'] = empty($_POST['follow']) ? 0 : 1;
		$data['nocomments'] = empty($_POST['nocomments']) ? 1 : 0;
		// CAT
		$query = $mysqli->query('SELECT c_id, c_seo FROM posts_cats WHERE c_id = \''.$data['category'].'\' LIMIT 1');
		$data_cat = $query->fetch_assoc();
		if($query->num_rows == 0) return 'La categor&iacute;a especificada no existe';
		
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return 'Su IP no es real';
		
		if($user->permits['ppm']){
			$hora = time()-(60*60);
			$query_posts = $mysqli->query('SELECT p_id FROM borradores WHERE p_user = \''.$user->uid.'\' AND p_date > \''.$hora.'\'');
			if($query_posts->num_rows > $user->permits['ppm']) return 'Tu rango solo te permite guardar <b>'.$user->permits['ppm'].'</b> borradores por hora, int&eacute;ntalo de nuevo en unos minutos';
		}
		
		$bid = intval($_POST['bid']);
		if($bid){
			$query = $mysqli->query('SELECT p_id FROM borradores WHERE p_id = \''.$bid.'\' AND p_user = \''.$user->uid.'\' LIMIT 1');
			if($query->num_rows){
				if($mysqli->query('UPDATE borradores SET p_cat = \''.$data['category'].'\', p_title = \''.$data['title'].'\', p_body = \''.$data['body'].'\', p_tags = \''.$data['tags'].'\', p_comments_status = \''.$data['nocomments'].'\', p_date = \''.$data['date'].'\' WHERE p_id = \''.$bid.'\'')){
					return 'El borrador fue guardado correctamente a las '.date("H:i:s",time());
				}else return 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'.$mysqli->error;
			}else return 'El borrador que intentas guardar no te pertenece';
		}
		
		if($mysqli->query('INSERT INTO borradores (p_user, p_cat, p_title, p_body, p_date, p_tags, p_comments_status) VALUES (\''.$user->uid.'\', \''.$data['category'].'\', \''.$data['title'].'\',  \''.$data['body'].'\', \''.$data['date'].'\' , \''.$data['tags'].'\', \''.$data['nocomments'].'\')')){
			$mysqli->query('UPDATE users_stats SET u_flood_post = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
			return 'El borrador fue guardado correctamente a las '.date("H:i:s",time());
		}else return 'No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde';
	}
	
	function del_borrador(){
		global $mysqli, $user;
		
		$bid = intval($_POST['bid']);
		
		$query = $mysqli->query('SELECT p_id FROM borradores WHERE p_id = \''.$bid.'\' AND p_user = \''.$user->uid.'\' LIMIT 1');
		if($query->num_rows){
			if($mysqli->query('DELETE FROM borradores WHERE p_id = \''.$bid.'\'')){
				return '1: El borrador fue eliminado';
			}else return '0: No se pudo completar la operaci&oacute;n, int&eacute;ntalo de nuevo m&aacute;s tarde'.$mysqli->error;
		}else return '0: El borrador que intentas eliminar no te pertenece';
	}
	
	function get_borradores(){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_date FROM borradores AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE p.p_user = \''.$user->uid.'\' AND p.p_type = \'1\'');
		while($row = $query->fetch_assoc()) $data['normal'][] = $row;
		
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_date FROM borradores AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE p.p_user = \''.$user->uid.'\' AND p.p_type = \'2\'');
		while($row = $query->fetch_assoc()) $data['eliminados'][] = $row;
		
		return $data;
	}
	
	function get_ports(){
		$body = secure($_POST['body']);
        preg_match_all('/(?i)\[img\](.+?)\[\/img\]/i', $body, $images);
		preg_match_all('/(?i)\[img\=(.+?)\]/i', $body, $images2);
        $imgs = array_merge($images[1],$images2[1]);
        return $imgs;
	}
	
	function get_post($post_id, $cat_seo, $post_title){
		global $mysqli, $user, $web;
		$query = $mysqli->query('SELECT p.*, s.*, c.c_name, c.c_seo, u.u_id, u.u_nick, u.u_date, u.u_country, u.u_last_avatar, r.r_name, r.r_image, r.r_color FROM posts AS p LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat LEFT JOIN users AS u ON u.u_id = p.p_user LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_stats AS s ON u.u_id = s.u_id WHERE p.p_id = \''.$post_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(($cat_seo != $data['c_seo'] || $post_title != seo($data['p_title'])) && $data['p_id']) header('location: /posts/'.$data['c_seo'].'/'.$post_id.'/'.seo($data['p_title']).'.html');
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$data['p_html'] = $data['p_body'];
		$data['p_body'] = $bbcode->start(secure($data['p_body'], false, true), true, true, $data['p_title']);
		require_once'PHP/libs/datos.php';
		$data['u_country_icon'] = strtolower($data['u_country']);
		$data['u_country'] = $array_data['paises'][$data['u_country']];
		$data['u_register'] = array(date('d', $data['u_date']),$time_data['meces'][date('M', $data['u_date'])],date('Y', $data['u_date']));
		date('d \d\e F \d\e Y', $data['u_date']);
		$data_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'1\' AND v_type_id = \''.$post_id.'\' AND v_user = \''.$user->uid.'\' LIMIT 1')->fetch_assoc();
		$data['vote'] = $data_vote['v_id'];
		if($data['p_comments'] > 0){
			$data_comments = $this->get_comments(0, $post_id);
			$data['comments'] = $data_comments['list'];
			$data['comments_pages'] = $data_comments['pages'];
		}
		if($user->uid){
			$query_fav = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$post_id.'\' AND f_type = \'1\' LIMIT 1');
			$data_fav = $query_fav->fetch_assoc();
			if($data_fav['f_id']) $data['p_is_fav'] = true;
			$data['horas_recarga'] = round((($user->info['u_update_points']-(time()-(60*60*$web['points_update'])))/60/60));
			
		}
		if($user->permits['gomod'] || $user->permits['gomadmin']){
			$query_history = $mysqli->query('SELECT h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod WHERE h.h_type = \'1\' AND h.h_type_id = \''.$post_id.'\' ORDER BY h.h_id DESC');
			while($history = $query_history->fetch_assoc()) $data['history'][] = $history;
		}
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('Su IP no es real');
		$query_hit = $mysqli->query('SELECT h_user FROM hits WHERE (h_ip = \''.$_SERVER['REMOTE_ADDR'].'\' OR (h_user = \''.$user->uid.'\' AND h_user > 0)) AND h_type = \'1\' AND h_type_id = \''.$post_id.'\'');
		$visitado = $query_hit->num_rows;
		if(empty($visitado) && $user->uid != $data['p_user']){
			$mysqli->query('INSERT INTO hits (h_type, h_type_id, h_user, h_ip, h_date) VALUES (\'1\', \''.$post_id.'\', \''.$user->uid.'\', \''.$_SERVER['REMOTE_ADDR'].'\', \''.time().'\')');
			$mysqli->query('UPDATE posts SET p_hits = p_hits + 1 WHERE p_id = \''.$post_id.'\' LIMIT 1');
		}
		$data['tags'] = explode(',', str_replace(array(', ', ' ,', ' '), ',', $data['p_tags']));
		$data['related'] = $this->related_posts($data['p_tags'], $data['p_id']);
		if(empty($data['p_id'])) return array('No encontramos el post.', 'El post que intentas buscar no existe o fue eliminado de por vida.', '');
		else if($data['p_status'] == 0 && !$user->permits['vpb']) return array('Post eliminado.', 'Este post se encuentra eliminado, solo los moderadores podr&aacute;n acceder a &eacute;l.', $data['related']);
		else if($data['p_status'] == 2 && !$user->permits['vpr'] && !$user->permits['apr']) return array('Post en revisi&oacute;n.', 'Este post se encuentra en revisi&oacute;n, solo los moderadores podr&aacute;n acceder a &eacute;l.', $data['related']);
		return $data;
	}
	
	function get_comments($page, $post_id){
		global $mysqli, $user, $web;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		
		if(empty($page)){
			$start = 0;
			$page = 1;
		}else $start = ($page - 1) * $web['max_comm'];
		
		$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'1\' AND c.c_type_id = \''.$post_id.'\' ORDER BY c.c_id ASC LIMIT '.$start.', '.$web['max_comm']);
		$i = 0;
		while($row = $query_comments->fetch_assoc()){
			$query_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'2\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
			$data_vote = $query_vote->fetch_assoc();
			$data['list'][$i] = $row;
			if(!empty($data_vote)) $data['list'][$i]['vote'] = true;
			$data['list'][$i]['c_body'] = $bbcode->start(secure($row['c_body'], false, true));
			$i++;
		}
		$sql['total'] = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'1\' AND c_type_id = \''.$post_id.'\'');
		$data['pages'] = $this->com_pages($page, $sql['total']->num_rows, $web['max_comm']);
		return $data;
	}
	
	function com_pages($page, $registros, $max){
		if($registros <= $max) return false;
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Siguiente" onclick="post.com_pages('.($page - 1).')">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" onclick="post.com_pages('.$i.')">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" onclick="post.com_pages('.($page + 1).')">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
	function related_posts($search, $omite){
		global $mysqli;
		//$busqueda = 'p.p_tags LIKE \'%'.secure($search).'%\'';
		$busqueda = 'MATCH (p.p_tags) AGAINST (\''.secure($search).'\' IN BOOLEAN MODE)';
		$sql = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE '.$busqueda.' AND p.p_status = \'1\' AND p.p_id != \''.$omite.'\' ORDER BY RAND() LIMIT 10');
		while($row = $sql->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function get_edit_post($pid, $borrador = false){
		global $mysqli, $user;
		if($borrador){
			$query = $mysqli->query('SELECT p_id, p_user, p_title, p_body, p_tags, p_cat, p_comments_status FROM borradores WHERE p_id = \''.$pid.'\' AND p_user = \''.$user->uid.'\' LIMIT 1');
		}else{
			$query = $mysqli->query('SELECT p_id, p_user, p_title, p_body, p_tags, p_cat, p_comments_status, p_follow, p_sticky, p_update FROM posts WHERE p_id = \''.$pid.'\' '.(empty($user->permits['ep']) ? 'AND p_user = \''.$user->uid.'\'' : '').' LIMIT 1');
		}
		$data = $query->fetch_assoc();
		if(empty($data)) return 'El '.($borrador ? 'borrador' : 'post').' que buscas no te pertenece o no existe';
		if(empty($user->permits['epp']) && !$borrador) return 'Tu rango no te permite editar posts';
		return $data;
	}
	
	function comment(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment'], false, true);
		$post_id = intval($_POST['post_id']);
		if(es_nulo($body)) die('0: Ingresa un comentario');
		$query = $mysqli->query('SELECT p_id, p_comments_status, p_user FROM posts WHERE p_id = \''.$post_id.'\' AND p_status = \'1\' LIMIT 1');
		$post = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: Este post se encuentra eliminado o a&uacute; no ha sido publicado');
		if($post['p_comments_status'] != '1') die('0: Este post no permite comentarios');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// PUEDE COMENTAR?
		if(empty($user->permits['pc'])) die('0: Tu rango no te permite publicar comentarios en este post');
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'1\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> comentarios por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		//BLOQUEADO
		if($user->i_block($post['p_user'])) die('0: '.$user->get_nick($post['p_user']).' te ha bloqueado, no puedes comentar sus posts');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date) VALUES (\'1\', \''.$post_id.'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\')');
		$new_id = $mysqli->insert_id;
		$activity->insert(4, $new_id, $user->uid, $post_id);
		$notifica->insert(4, $new_id, $post['p_user'], $post_id);
		$notifica->insert_to_follows(5, $post_id, $post_id, 2, $post['p_user']);
		$mysqli->query('UPDATE web_stats SET comments = comments + 1');
		$mysqli->query('UPDATE posts SET p_comments = p_comments + 1 WHERE p_id = \''.$post_id.'\'');
		$mysqli->query('UPDATE users_stats SET u_comments = u_comments + 1, u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		return array($new_id, $body_bb, time());
	}
	
	function send_replie(){
		global $mysqli, $user, $activity, $notifica;
		if($user->info['u_flood_comment'] > $user->info['flood']) die('0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes');
		if(es_nulo($user->uid)) die('0: Usuarios anonimos no pueden comentar');
		$body = secure($_POST['comment'], false, true);
		$cid = intval($_POST['cid']);
		if(es_nulo($body)) die('0: Ingresa un comentario');
		
		$query_comment = $mysqli->query('SELECT c_type_id, c_user FROM comments WHERE c_id = \''.$cid.'\' AND c_type = \'1\' LIMIT 1');
		$data_comment = $query_comment->fetch_assoc();
		if(es_nulo($data_comment)) die('0: El comentario que busca no existe');
		
		$query = $mysqli->query('SELECT p_id, p_comments_status, p_user FROM posts WHERE p_id = \''.$data_comment['c_type_id'].'\' AND p_status = \'1\' LIMIT 1');
		$post = $query->fetch_assoc();
		if($query->num_rows == 0) die('0: El post que buscas no existe');
		if($post['p_comments_status'] != '1') die('0: Este post no permite comentarios ni respuestas');
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) die('0: Su IP no es real');
		// PUEDE COMENTAR?
		if(empty($user->permits['pc'])) die('0: Tu rango no te permite publicar comentarios en este post');
		// YA COMENTO BASTANTE
		if($user->permits['pcm']){
			$hora = time()-(60*60);
			$query_total = $mysqli->query('SELECT c_id FROM comments WHERE c_type = \'2\' AND c_user = \''.$user->uid.'\' AND c_date > \''.$hora.'\'');
			if($query_total->num_rows > $user->permits['pcm']) die('0: Tu rango no te permite publicar m&aacute;s de <b>'.$user->permits['ppm'].'</b> comentarios por hora, int&eacute;ntalo de nuevo en unos minutos');
		}
		//BLOQUEADO
		if($user->i_block($post['p_user'])) die('0: '.$user->get_nick($post['p_user']).' te ha bloqueado, no puedes comentar sus posts');
		if($user->i_block($data_comment['c_user'])) die('0: '.$user->get_nick($data_comment['c_user']).' te ha bloqueado, no puedes responder sus comentarios');
		//
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$body_bb = $bbcode->start(secure($body, false, true));
		$mysqli->query('INSERT INTO comments (c_type, c_type_id, c_user, c_body, c_date, c_replie_id) VALUES (\'2\', \''.$data_comment['c_type_id'].'\', \''.$user->uid.'\', \''.$body.'\', \''.time().'\', \''.$cid.'\')');
		$r_id = $mysqli->insert_id;
		$activity->insert(10, $r_id, $user->uid, $cid);
		$notifica->insert(10, $cid, $data_comment['c_user']);
		$mysqli->query('UPDATE web_stats SET comments = comments + 1');
		$mysqli->query('UPDATE comments SET c_replies = c_replies + 1 WHERE c_id = \''.$cid.'\'');
		$mysqli->query('UPDATE posts SET p_comments = p_comments + 1 WHERE p_id = \''.$data_comment['c_type_id'].'\'');
		$mysqli->query('UPDATE users_stats SET u_comments = u_comments + 1, u_flood_comment = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
		return array($r_id, $body_bb, time(), 'post');
	}
	
	function show_replies($cid){
		global $mysqli;
		$query_comments = $mysqli->query('SELECT c.*, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_type = \'2\' AND c.c_replie_id = \''.$cid.'\' ORDER BY c.c_id ASC');
		$i = 0;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query_comments->fetch_assoc()){
			$query_vote = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'2\' AND v_type_id = \''.$row['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
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
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'1\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		if($user->permits['ecp']){
			return '1: '.$data['c_body'];
		}else return '0: Tu rango no te permite editar comentarios';
	}
	
	function save_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user FROM comments WHERE c_type = \'1\' AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		if(!$user->permits['ec'] && $user->uid != $data['c_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		if($user->permits['ecp']){
			$body = secure($_POST['comment'], false, true);
			if(es_nulo($body)) return '0: Ingresa un comentario';
			if($data['c_body'] != $body){
				$mysqli->query('UPDATE comments SET c_body = \''.$body.'\' WHERE c_id = \''.$cid.'\' LIMIT 1');
				if($user->uid == $data['c_user']) $activity->insert(5, $cid, $user->uid);
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
		$query_votes_pos = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'2\' AND v_val = \'+\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		$query_votes_neg = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'2\' AND v_val = \'-\' AND v_user = \''.$user->uid.'\' AND v_date > \''.$hora.'\'');
		if($query_votes_pos->num_rows > $user->permits['vpcm']) '0: Ya haz votado positivo bastantes veces por el momento';
		if($query_votes_neg->num_rows > $user->permits['vncm']) '0: Ya haz votado negativo bastantes veces por el momento';
		// OBTENEMOS LOS DATOS DEL COMENTARIO
		$query['comment'] = $mysqli->query('SELECT c_id, c_user, c_votos FROM comments WHERE c_id = \''.$cid.'\' AND c_status = \'1\' LIMIT 1');
		$data['comment'] = $query['comment']->fetch_assoc();
		if(empty($data['comment']['c_id'])) return '0: El comentario se encuentra eliminado o no existe';
		if($data['comment']['c_user'] == $user->uid) return '0: No puedes votar tus propios comentarios';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'2\' AND v_type_id = \''.$cid.'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un mismo comentario m&aacute;s de una vez';
		// ACTUALIZAMOS E INSERTAMOS
		$mysqli->query('UPDATE comments SET c_votos = c_votos '.($vote == '+' ? '+ 1' : '- 1').' WHERE c_id = \''.$cid.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'2\', \''.$cid.'\', \''.$vote.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$actividad = ($vote == '+') ? 11 : 12;
		$activity->insert($actividad, $cid, $user->uid);
		$notifica->insert($actividad, $cid, $data['comment']['c_user']);
		$new_total = ($vote == '+') ? $data['comment']['c_votos'] + 1 :  $data['comment']['c_votos'] - 1;
		$return = $new_total > 0 ? '+'.$new_total : $new_total;
		return '1: '.$return;
	}
	
	function del_comment($cid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT c_body, c_user, c_type, c_type_id, c_replies, c_replie_id FROM comments WHERE (c_type = \'1\' OR c_type = \'2\') AND c_id = \''.$cid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$data['c_type_id'].'\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		// NO EXISTE
		if(!$query->num_rows) return '0: El comentario que buscas no existe';
		// NO LE PERTENECE
		if(!$user->permits['bc'] && $user->uid != $data['c_user'] && $user->uid != $data_post['p_user']) return '0: Este comentario no te pertenece, no lo puedes editar';
		// TIENE PERMISOS?
		if(!$user->permits['bcp'] && !$user->permits['bc']) return '0: Tu rango no te permite eliminar tus comentarios';
		// BORRAR COMENTARIO + RESPUETAS
		$total_a_borrar = $data['c_replies'] + 1;
		$activity->delete(4, $cid, $user->uid, $data['c_type_id']);
		if($data['c_type'] == 1) $mysqli->query('DELETE FROM comments WHERE (c_type = \'1\' AND c_id = \''.$cid.'\') OR (c_type = \'2\' && c_replie_id = \''.$cid.'\')');
		else if($data['c_type'] == 2){
			$mysqli->query('DELETE FROM comments WHERE c_type = \'2\' AND c_id = \''.$cid.'\'');
			$mysqli->query('UPDATE comments SET c_replies = c_replies - \'1\' WHERE c_id = \''.$data['c_replie_id'].'\' AND c_type = \'1\'');
		}
		$mysqli->query('UPDATE web_stats SET comments = comments - \''.$total_a_borrar.'\'');
		$mysqli->query('UPDATE posts SET p_comments = p_comments - \''.$total_a_borrar.'\' WHERE p_id = \''.$data['c_type_id'].'\'');
		$mysqli->query('UPDATE users_stats SET u_comments = u_comments - 1 WHERE u_id = \''.$data['c_user'].'\'');
		return '1: El comentario fue eliminado con exito';
	}
	
	function last_posts($page, $sticky, $cat){
		global $mysqli, $web, $user;
		$web['max_posts'] = empty($web['max_posts']) ? 40 : $web['max_posts'];
		if($web['port_posts']) $web['max_posts'] = 20;
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		if($cat){
			$query_cat = $mysqli->query('SELECT c_id FROM posts_cats WHERE c_seo = \''.$cat.'\' LIMIT 1');
			$data_cat = $query_cat->fetch_assoc();
			if(empty($data_cat)) header('location: /');
			else $w_cat = true;
		}
		if(!$user->permits['goadmin'] && !$user->permits['gomod'] && !$user->permits['vpb'] && !$user->permits['vpr']) $hide_posts = 'AND p_status = \'1\'';
		$sql['list'] = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_status, p.p_sticky, p.p_update '.($web['port_posts']?',p.p_hits, p.p_puntos, p.p_comments, p.p_date, u.u_nick':'').' FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id '.($web['port_posts']?'LEFT JOIN users AS u ON u.u_id = p.p_user':'').' WHERE p.p_id '.$hide_posts.' '.($sticky ? 'AND p.p_sticky != \'0\'' : 'AND p.p_sticky = \'0\'').' '.($w_cat ? 'AND p.p_cat = \''.$data_cat['c_id'].'\'' : '').' ORDER BY '.($sticky ? 'p.p_sticky' : 'p.p_id').' DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $result['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT p_id AS total FROM posts WHERE p_id '.$hide_posts.' '.($sticky ? 'AND p_sticky != \'0\'' : 'AND p_sticky = \'0\'').' '.($w_cat ? 'AND p_cat = \''.$data_cat['c_id'].'\'' : '').'');
		$result['pages'] = $this->posts_pag($page, $sql['total']->num_rows, $web['max_posts'], $cat);
		
		return $result;
	}
	
	function posts_pag($page, $registros, $max, $cat){
		if($registros <= $max) return false;
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page - 1).', \''.$cat.'\')">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" onclick="to_page('.$i.', \''.$cat.'\')">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" onclick="to_page('.($page + 1).', \''.$cat.'\')">&#187;</a>';
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
	
	function last_comments($cat){
		global $mysqli;
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, co.c_id, u.u_nick FROM comments AS co LEFT JOIN posts AS p ON p.p_id = co.c_type_id LEFT JOIN users AS u ON u.u_id = co.c_user LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE co.c_status = \'1\' AND (co.c_type = \'1\' OR co.c_type = \'2\') AND p.p_status = \'1\' '.($cat ? 'AND c.c_seo = \''.$cat.'\'' : '').' ORDER BY co.c_id DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function news(){
		global $mysqli;
		$query = $mysqli->query('SELECT n.* FROM news AS n WHERE n_status = \'1\' ORDER BY RAND()');
		$i = 0;
		if($query->num_rows){
			require_once'PHP/libs/bbcode.inc.php';
			$bbcode = new bbcode;
			while($row = $query->fetch_assoc()){
				$data[$i] = $row;
				$data[$i]['n_body'] = $bbcode->start(secure($row['n_body'], false, true));
				$i++;
			}
		}
		return $data;
	}
	
	function links_i(){
		global $mysqli;
		$query = $mysqli->query('SELECT l.* FROM admin_links AS l WHERE l.l_status = \'1\' ORDER BY RAND()');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function last_members(){
		global $mysqli;
		$query = $mysqli->query('SELECT u_id, u_nick, u_last_avatar FROM users WHERE u_status = \'1\' ORDER BY u_id DESC LIMIT 5');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function top_posts(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.c_seo, p.p_id, p.p_puntos, p.p_title FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE p.p_status = \'1\' ORDER BY p.p_puntos DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function top_users(){
		global $mysqli;
		$query = $mysqli->query('SELECT u.u_nick, s.u_points FROM users_stats AS s LEFT JOIN users AS u ON u.u_id = s.u_id ORDER BY s.u_points DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function puntuar($puntos, $post_id){
		global $mysqli, $user, $activity, $notifica, $web;
		$_SERVER['REMOTE_ADDR'] = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        if(!filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)) return '0: Su ip no se pudo validar';
		if(empty($user->uid)) return '0: Reg&iacute;strate para dar puntos';
		// - $user->info['u_update_points']
		$horas_recarga = round((($user->info['u_update_points']-(time()-(60*60*$web['points_update'])))/60/60));
		if($puntos > $user->info['u_points_ava']) return '0: No puedes dar m&aacute;s de <b>'.$user->info['u_points_ava'].'</b> puntos por el momento, espera '.$horas_recarga.' hora'.($horas_recarga > 1 ? 's' : '').' para que se te recarguen los puntos';
		$query['post'] = $mysqli->query('SELECT p_id, p_user FROM posts WHERE p_id = \''.$post_id.'\' AND p_status = \'1\' LIMIT 1');
		$data['post'] = $query['post']->fetch_assoc();
		if(empty($data['post']['p_id'])) return '0: El post se encuentra eliminado o no existe';
		if($data['post']['p_user'] == $user->uid) return '0: No puedes puntuar tus propios posts';
		$query['vote'] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'1\' AND v_type_id = \''.$post_id.'\' AND (v_user = \''.$user->uid.'\' OR v_ip = \''.$_SERVER['REMOTE_ADDR'].'\') LIMIT 1');
		$data['vote'] = $query['vote']->fetch_assoc();	
		if(!empty($data['vote']['v_id'])) return '0: No es posible votar a un mismo post m&aacute;s de una vez';
		$mysqli->query('UPDATE posts SET p_puntos = p_puntos + \''.$puntos.'\' WHERE p_id = \''.$post_id.'\'');
		$mysqli->query('UPDATE users_stats SET u_points = u_points + \''.$puntos.'\' WHERE u_id = \''.$data['post']['p_user'].'\'');
		$mysqli->query('UPDATE users SET u_points_ava = u_points_ava - \''.$puntos.'\' WHERE u_id = \''.$user->uid.'\'');
		$mysqli->query('INSERT INTO votes (v_user, v_type, v_type_id, v_val, v_date, v_ip) VALUES (\''.$user->uid.'\', \'1\', \''.$post_id.'\', \''.$puntos.'\', \''.time().'\', \''.$_SERVER['REMOTE_ADDR'].'\')');
		$v_id = $mysqli->insert_id;
		$dattt = $this->up_rank($data['post']['p_user']);
		$activity->insert(6, $v_id, $user->uid);
		$notifica->insert(6, $v_id, $data['post']['p_user']);
		return '1: puntos agregados';
	}
	
	function up_rank($user_id){
		global $mysqli, $user, $notifica;
		// DATOS DEL USUARIO
		$query['user'] = $mysqli->query('SELECT u.u_rank, u.u_points_ava, s.u_points FROM users AS u LEFT JOIN users_stats AS s ON s.u_id = u.u_id WHERE u.u_id =  \''.$user_id.'\' LIMIT 1');
		$data['user'] = $query['user']->fetch_assoc();
		// RANGO ACTUAL
		$query['rank'] = $mysqli->query('SELECT r_id, r_pxd, r_points_require, r_type FROM users_ranks WHERE r_id = \''.$data['user']['u_rank'].'\'');
		$data['rank'] = $query['rank']->fetch_assoc();
		if($data['rank']['r_type'] == 1 && $data['user']['u_rank'] != 3) return false;
		// RANGOS
		$query['ranks'] = $mysqli->query('SELECT r.* FROM users_ranks AS r WHERE r.r_type = \'0\' ORDER BY r_points_require DESC');

		while($row = $query['ranks']->fetch_assoc()){
			if($row['r_id'] == $data['rank']['r_id']) return false;
			if($row['r_points_require'] <= $data['user']['u_points']){
				$mysqli->query('UPDATE users SET u_rank =  \''.$row['r_id'].'\', u_points_ava = \''.$row['r_pxd'].'\' WHERE u_id = \''.$user_id.'\' LIMIT 1');
				$notifica->insert(44, $row['r_id'], $user_id, 0, 'SMline');
				return true;
			}
		}
	}
	
	function follow($pid){
		global $mysqli, $user, $activity;
		if($user->info['u_flood_follow'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_status = \'1\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if(!$data_post['p_user']) return '0: El post no existe o fue eliminado';
		if($data_post['p_user'] == $user->uid) return '0: No puedes seguir tus propios posts';
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$pid.'\' AND f_type = \'2\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($data['f_type'])){
			if($mysqli->query('INSERT INTO follows (f_type, f_type_id, f_user, f_date) VALUES (\'2\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\')')){
				$activity->insert(7, $pid, $user->uid);
				$mysqli->query('UPDATE posts SET p_follows = p_follows + 1 WHERE p_id = \''.$pid.'\'');
				$mysqli->query('UPDATE users_stats SET u_flood_follow = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: Ya est&aacute; en tu lista de seguidores';
	}
	
	function unfollow($pid){
		global $mysqli, $user, $activity;
		$query = $mysqli->query('SELECT f_type FROM follows WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$pid.'\' AND f_type = \'2\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['f_type']){
			if($mysqli->query('DELETE FROM follows WHERE f_type = \'2\' AND f_user = \''.$user->uid.'\' AND f_type_id = \''.$pid.'\' LIMIT 1')){
				$activity->delete(7, $pid, $user->uid);
				$mysqli->query('UPDATE posts SET p_follows = p_follows - 1 WHERE p_id = \''.$pid.'\'');
				return '1: Software by <b>SMline</b>';
			}else return '0: No se pudo completar lo operaci&oacute;n';
		}else return '0: No est&aacute; en tu lista de seguidores';
	}
	
	function favorite($pid, $action){
		global $mysqli, $user, $activity;
		if($action == 0){
			if($user->info['u_flood_post'] > $user->info['flood']) return '0: No puedes realizar tantas acciones seguidas, int&eacute;ntalo de nuevo en unos instantes';
			$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_status = \'1\' LIMIT 1');
			$data_post = $query_post->fetch_assoc();
			if(!$data_post['p_user']) return '0: El post no existe o fue eliminado';
			if($user->uid == $data_post['p_user']) return '0: No puedes agregar a favoritos tus propios posts';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$pid.'\' AND f_type = \'1\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['f_id'])){
				if($mysqli->query('INSERT INTO favorites (f_type, f_type_id, f_user, f_date) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\')')){
					$activity->insert(8, $pid, $user->uid);
					$mysqli->query('UPDATE users_stats SET u_flood_post = \''.time().'\' WHERE u_id = \''.$user->uid.'\'');
					$mysqli->query('UPDATE posts SET p_favs = p_favs + 1 WHERE p_id = \''.$pid.'\'');
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
		if($action == 1){
			$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' LIMIT 1');
			$data_post = $query_post->fetch_assoc();
			if(!$data_post['p_user']) return '0: El post no existe o fue eliminado';
			//if($user->uid == $data_post['p_user']) return '0: No puedes agregar a favoritos tus propios posts';
			$query = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$user->uid.'\' AND f_type_id = \''.$pid.'\' AND f_type = \'1\' LIMIT 1');
			$data = $query->fetch_assoc();
			if($data['f_id']){
				if($mysqli->query('DELETE FROM favorites WHERE f_id = \''.$data['f_id'].'\' LIMIT 1')){
					$activity->delete(8, $pid, $user->uid);
					$mysqli->query('UPDATE posts SET p_favs = p_favs - 1 WHERE p_id = \''.$pid.'\'');
					return '1: Software by <b>SMline</b>';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: No est&aacute; en tu lista de <a href="/favoritos">favoritos</a>';
		}
	}
	
	function share($pid){
		global $mysqli, $user, $activity, $notifica;
			$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_status = \'1\' LIMIT 1');
			$query_follows = $mysqli->query('SELECT f_type FROM follows WHERE f_type_id = \''.$user->uid.'\' AND f_type = \'1\'');
			if($query_follows->num_rows == 0) return '0: No puedes recomendar posts si no tienes seguidores';
			$data_post = $query_post->fetch_assoc();
			if(!$data_post['p_user']) return '0: El post no existe o fue eliminado';
			if($user->uid == $data_post['p_user']) return '0: No puedes recomendar tus propios posts';
			$query = $mysqli->query('SELECT s_type FROM shared WHERE s_type = \'1\' AND s_type_id = \''.$pid.'\' AND s_user = \''.$user->uid.'\' LIMIT 1');
			$data = $query->fetch_assoc();
			if(empty($data['s_type'])){
				if($mysqli->query('INSERT INTO shared (s_type, s_type_id, s_user, s_date) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\')')){
					$activity->insert(9, $pid, $user->uid);
					$notifica->insert_to_follows(9, $pid, $user->uid, 1, $data_post['p_user']);
					$mysqli->query('UPDATE posts SET p_shared = p_shared + 1 WHERE p_id = \''.$pid.'\'');
					return '1: El post fue recomendado a todos tus seguidores';
				}else return '0: No se pudo completar lo operaci&oacute;n';
			}else return '0: Ya has recomendado este post antes';
	}
	
	function delete($pid){
		global $mysqli, $user, $activity;
		$query_post = $mysqli->query('SELECT p_user, p_status, p_puntos FROM posts WHERE p_id = \''.$pid.'\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			if(empty($user->permits['bpp'])) return '0: Tu rango no te permite borrar posts';
			if($user->uid != $data_post['p_user']) return '0: Solo puedes eliminar posts creados por ti';
			if($data_post['p_status'] != 0){
					$activity->delete(2, $pid, $data_post['p_user']);
					$mysqli->query('UPDATE web_stats SET posts = posts - 1');
					$mysqli->query('UPDATE posts SET p_status = \'0\' WHERE p_id = \''.$pid.'\'');
					$mysqli->query('UPDATE users_stats SET u_posts = u_posts - 1, u_points = u_points - \''.$data_post['p_puntos'].'\' WHERE u_id = \''.$user->uid.'\'');
					return '1: El post fue eliminado';
			}else return '0:  Este post ya se encuentra eliminado';
		}else return '0: Este post ya se encuentra eliminado';
	}
	
	function mod_delete($pid){
		global $mysqli, $user, $activity;
		if(empty($user->permits['bp'])) return '0: Imposible continuar';
		$reason = secure($_POST['reason']);
		$save_borrador = intval($_POST['save_borrador']);
		$query_post = $mysqli->query('SELECT p_user, p_puntos '.($save_borrador ? ', p_cat, p_title, p_body, p_tags, p_comments_status' : '').' FROM posts WHERE p_id = \''.$pid.'\' AND p_status != \'0\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			if($user->uid == $data_post['p_user']) return '0: Este post es tuyo, no puedes borrarlo de esta forma';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'1\', \''.$reason.'\')');
			
			if($save_borrador) $mysqli->query('INSERT INTO borradores (p_user, p_cat, p_title, p_body, p_date, p_tags, p_comments_status, p_type) VALUES (\''.$data_post['p_user'].'\', \''.$data_post['p_cat'].'\', \''.$data_post['p_title'].'\',  \''.$data_post['p_body'].'\', \''.time().'\' , \''.$data_post['p_tags'].'\', \''.$data_post['p_comments_status'].'\', \'2\')');
			
			$activity->delete(2, $pid, $data_post['p_user']);
			$mysqli->query('UPDATE web_stats SET posts = posts - 1');
			$mysqli->query('UPDATE posts SET p_status = \'0\' WHERE p_id = \''.$pid.'\'');
			$mysqli->query('UPDATE users_stats SET u_posts = u_posts - 1, u_points = u_points - \''.$data_post['p_puntos'].'\' WHERE u_id = \''.$data_post['p_user'].'\'');
			return '1: El post fue eliminado';
		}else return '0: Este post ya se encuentra eliminado';
	}
	
	function mod_reac($pid){
		global $mysqli, $user;
		if(empty($user->permits['vpb'])) return '0: Imposible continuar';
		$reason = '-';
		$query_post = $mysqli->query('SELECT p_user, p_puntos FROM posts WHERE p_id = \''.$pid.'\' AND p_status = \'0\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			if($user->uid == $data_post['p_user'] && !$user->permits['goadmin']) return '0: No puedes reactivar tus propios posts';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'2\', \''.$reason.'\')');
			$mysqli->query('UPDATE web_stats SET posts = posts + 1');
			$mysqli->query('UPDATE posts SET p_status = \'1\' WHERE p_id = \''.$pid.'\'');
			$mysqli->query('UPDATE users_stats SET u_posts = u_posts + 1, u_points = u_points + \''.$data_post['p_puntos'].'\' WHERE u_id = \''.$data_post['p_user'].'\'');
			return '1: El post fue reactivado y ser&aacute; visible para todos los usuarios';
		}else return '0: Este post ya se encuentra reactivado';
	}
	
	function mod_revise($pid){
		global $mysqli, $user;
		if(empty($user->permits['apr'])) return '0: Imposible continuar';
		$reason = $_POST['reason'] ? secure($_POST['reason']) : '-';
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_status != \'2\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			if($user->uid == $data_post['p_user']) return '0: Imposible continuar';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'4\', \''.$reason.'\')');
			$mysqli->query('UPDATE web_stats SET posts = posts - 1');
			$mysqli->query('UPDATE posts SET p_status = \'2\' WHERE p_id = \''.$pid.'\'');
			return '1: El post fue mandado a revisi&oacute;n';
		}else return '0: Este post ya se encuentra en revisi&oacute;n';
	}
	
	function mod_approve($pid){
		global $mysqli, $user;
		if(empty($user->permits['apr'])) return '0: Imposible continuar';
		$reason = '-';
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_status = \'2\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			if($user->uid == $data_post['p_user']) return '0: Imposible continuar';
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'5\', \''.$reason.'\')');
			$mysqli->query('UPDATE web_stats SET posts = posts + 1');
			$mysqli->query('UPDATE posts SET p_status = \'1\' WHERE p_id = \''.$pid.'\'');
			return '1: El post fue aprobado y ser&aacute; visible';
		}else return '0: Este post no se encuentra en revisi&oacute;n';
	}
	
	function mod_add_sticky($pid){
		global $mysqli, $user;
		if(empty($user->permits['fp'])) return '0: Imposible continuar';
		$reason = '-';
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_sticky = \'0\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'6\', \''.$reason.'\')');
			$mysqli->query('UPDATE posts SET p_sticky = \'1\' WHERE p_id = \''.$pid.'\'');
			return '1: El post fue fijado en la home';
		}else return '0: Este post ya se encuentra fijado';
	}
	
	function mod_remove_sticky($pid){
		global $mysqli, $user;
		if(empty($user->permits['dfp'])) return '0: Imposible continuar';
		$reason = '-';
		$query_post = $mysqli->query('SELECT p_user FROM posts WHERE p_id = \''.$pid.'\' AND p_sticky = \'1\' LIMIT 1');
		$data_post = $query_post->fetch_assoc();
		if($data_post){
			$mysqli->query('INSERT INTO history (h_type, h_type_id, h_mod, h_date, h_action, h_reason) VALUES (\'1\', \''.$pid.'\', \''.$user->uid.'\', \''.time().'\', \'7\', \''.$reason.'\')');
			$mysqli->query('UPDATE posts SET p_sticky = \'0\' WHERE p_id = \''.$pid.'\'');
			return '1: El post fue desfijado con exito';
		}else return '0: Este post no se encuentra fijado';
	}
	
	function favorites($f_type){
		global $mysqli, $user, $web;
		$limit = 30;
		$page = intval($_GET['page']);
		if(empty($page)){
			$start = 0;
			$page = 1;
		}else $start = ($page - 1) * $limit;
		$result = '';
		switch($f_type){
			case '':
			case 'posts':
				$query = $mysqli->query('SELECT f.f_id, f.f_date, p.p_id, p.p_title, p.p_date, p.p_puntos, p.p_comments, p.p_status, cat.c_seo, cat.c_name, cat.c_img FROM favorites AS f LEFT JOIN posts AS p ON p.p_id = f.f_type_id LEFT JOIN posts_cats AS cat ON cat.c_id = p.p_cat WHERE f.f_type = \'1\' AND f.f_user = \''.$user->uid.'\' ORDER BY f.f_date DESC LIMIT '.$start.', '.$limit);
				$total = $mysqli->query('SELECT f_id FROM favorites WHERE f_type = \'1\' AND f_user = \''.$user->uid.'\'');
				$result['pages'] = $this->favorites_pages($page, $total->num_rows, $limit);
			break;
			case 'imagenes':
				$query = $mysqli->query('SELECT f.f_id, f.f_date, i.i_id, i.i_title, i.i_date, i.i_positives, i.i_negatives, i.i_comments, i.i_status FROM favorites AS f LEFT JOIN images AS i ON i.i_id = f.f_type_id WHERE f.f_type = \'3\' AND f.f_user = \''.$user->uid.'\' ORDER BY f.f_date DESC LIMIT '.$start.', '.$limit)  or die($mysqli->error);
				$total = $mysqli->query('SELECT f_id FROM favorites WHERE f_type = \'3\' AND f_user = \''.$user->uid.'\'');
				$result['pages'] = $this->favorites_pages($page, $total->num_rows, $limit);
			break;
			case 'temas':
				$query = $mysqli->query('SELECT f.f_id, f.f_date, t.t_id, t.t_title, t.t_date, t.t_positives, t.t_negatives, t.t_comments, t.t_status, co.comu_seo, cat.c_seo, cat.c_name, cat.c_img FROM favorites AS f LEFT JOIN comus_topics AS t ON t.t_id = f.f_type_id LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS cat ON cat.c_id = co.comu_cat WHERE f.f_type = \'5\' AND f.f_user = \''.$user->uid.'\' ORDER BY f.f_date DESC LIMIT '.$start.', '.$limit) or die($mysqli->error);
				$total = $mysqli->query('SELECT f_id FROM favorites WHERE f_type = \'5\' AND f_user = \''.$user->uid.'\'');
				$result['pages'] = $this->favorites_pages($page, $total->num_rows, $limit);
			break;
			default:
				header('location: /favoritos');
			break;
		}
		while($row = $query->fetch_assoc()) $result['list'][] = $row;
		return $result;
	}
	
	function favorites_pages($page, $total, $max){
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
	
	function del_fav($fid){
		global $mysqli, $user;
		$query_fav = $mysqli->query('SELECT f_id, f_type, f_type_id FROM favorites WHERE f_id = \''.$fid.'\' AND f_user = \''.$user->uid.'\' LIMIT 1');
		if($query_fav->num_rows == 0) return '0: El favorito que buscas ya se encuentra eliminado';
		else{
			$data = $query_fav->fetch_assoc();
			switch($data['f_type']){
				case '1': // POSTS
					$mysqli->query('UPDATE posts SET p_favs = p_favs - 1 WHERE p_id = \''.$data['f_type_id'].'\' LIMIT 1');
				break;
				case '3': // IMAGENES
					$mysqli->query('UPDATE images SET i_favs = i_favs - 1 WHERE i_id = \''.$data['f_type_id'].'\' LIMIT 1');
				break;
				case '5': // TEMAS
					$mysqli->query('UPDATE comus_topics SET t_favs = t_favs - 1 WHERE t_id = \''.$data['f_type_id'].'\' LIMIT 1');
				break;
				default:
					return '0: Imposible continuar';
				break;
			}
			$mysqli->query('DELETE FROM favorites WHERE f_id = \''.$data['f_id'].'\' LIMIT 1');
			return '1: Fav is delete';
		}
	}
	
	function get_history(){
		global $mysqli;
		$query = $mysqli->query('SELECT h.h_id, h.h_action, h.h_mod, h.h_reason, h.h_date, u.u_id, u.u_nick, p.p_title, p.p_user FROM history AS h LEFT JOIN users AS u ON u.u_id = h.h_mod LEFT JOIN posts AS p ON p.p_id = h.h_type_id WHERE h.h_type = \'1\' ORDER BY h.h_id DESC LIMIT 30');
		while($history = $query->fetch_assoc()) $data[] = $history;
		return $data;
	}
}
?>