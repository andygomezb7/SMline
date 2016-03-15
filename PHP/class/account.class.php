<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class account{
	function get_info(){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT s.*, u.*, ac.* FROM users AS u LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id LEFT JOIN users_stats AS s ON u.u_id = s.u_id WHERE u.u_id = \''.$user->uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$data['options'] = unserialize($data['u_options']);
		$data['notifications'] = unserialize($data['u_notifications']);
		
		$query = $mysqli->query('SELECT u.u_nick, u.u_id, u.u_last_avatar FROM users_blocks AS b LEFT JOIN users AS u ON u.u_id = b.b_to_user WHERE b.b_user = \''.$user->uid.'\'');
		while($row = $query->fetch_assoc()) $data['my_blocks'][] = $row;
		return $data;
	}
	
	function save(){
		global $mysqli, $user, $web;
		$type = secure($_POST['type']);
		switch($type){
			case 'my-general':
				$require = array(
					'names' => secure($_POST['u_names']),
					'surnames' => secure($_POST['u_surnames']),
					'country' => secure($_POST['u_country']),
					'day' => intval($_POST['u_day']),
					'month' => intval($_POST['u_month']),
					'year' => intval($_POST['u_year'])
				);
				include'PHP/libs/datos.php';
				if(empty($array_data['paises'][$require['country']])) return '0: Por favor, selecciona tu pa&iacute;s';
				foreach($require AS $val){
					if(empty($val)) return '0: Faltan completar campos';
				}
				$u_sex = intval($_POST['u_sex']) ? 1 : 0;
				$date_permit = (date('Y') - $web['min_age']);
				$date_max = (date('Y') - ($web['min_age']+100));
				if($require['day'] > 31 || $require['day'] < 1) return '0: El d&iacute; no es v&aacute;lido';
				if($require['month'] > 12 || $require['month'] < 1) return '0: El mes no es v&aacute;lido';
				if($require['year'] > $date_permit || $require['year'] < $date_max) return '0: Debes ser mayor de '.$web['min_age'].' a&ntilde;os';
				$mysqli->query('UPDATE users_accounts SET u_names = \''.$require['names'].'\', u_surnames = \''.$require['surnames'].'\', u_day = \''.$require['day'].'\', u_month = \''.$require['month'].'\', u_year = \''.$require['year'].'\' WHERE u_id = \''.$user->uid.'\'');
				$mysqli->query('UPDATE users SET u_sex = \''.$u_sex.'\', u_country = \''.$require['country'].'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: SMline.NET';
			break;
			case 'my-profile':
				$u_bio = secure($_POST['u_bio']);
				$u_image = secure($_POST['u_image']);
				$u_image_repeat = intval($_POST['u_image_repeat']) ? 1 : 0;
				$u_color = str_replace('#', '', secure($_POST['u_color']));
				$u_site = secure($_POST['u_site']);
				if($u_image){
					$data_img = getimagesize($u_image);
					$min_w = 2;
					$min_h = 2;
					$max_w = 1500;
					$max_h = 1500;
					if(empty($data_img[0])) return '0: La imagen de fondo ingresada no existe o no es una imagen v&aacute;lida';
					elseif($data_img[0] < $min_w || $data_img[1] < $min_h) return '0: La imagen de fondo debe tener un tama&ntilde;o superior a 2x2 pixeles';
					elseif($data_img[0] > $max_w || $data_img[1] > $max_h) return '0: La imagen de fondo debe tener un tama&ntilde;o menor a 1500x1500 pixeles';
				}
				$mysqli->query('UPDATE users_accounts SET u_bio = \''.$u_bio.'\', u_image = \''.$u_image.'\', u_image_repeat = \''.$u_image_repeat.'\', u_color = \''.$u_color.'\', u_site = \''.$u_site.'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: SMline.NET';
			break;
			case 'my-options':
				$options = array(
					'escribir' => intval($_POST['p_escribir']),
					'mensajes' => intval($_POST['p_mensajes']),
					'n_sounds' => intval($_POST['n_sounds']),
				);
				foreach($options AS $val){
					if($val > 2 || $val < 0) return '0: Software by SMline.NET';
				}
				$options = serialize($options);
				$mysqli->query('UPDATE users_accounts SET u_options = \''.$options.'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: SMline.NET';
			break;
			case 'my-notifications':
				$notifications = array(2,4,5,6,9,10,11,12,13,16,17,18,19,22,23,24,25,26,28,29,30,31,34,39,41,42,43,44,45,46);
				$new_array = $_POST;
				foreach($new_array as $name => $val){
					$name = str_replace('not', '', $name);
					if(in_array($name, $notifications)) $noti[$name] = $val == 0 ? 0 : 1;
				}
				$noti = serialize($noti);
				$mysqli->query('UPDATE users_accounts SET u_notifications = \''.$noti.'\' WHERE u_id = \''.$user->uid.'\'');
				return '1: SMline.NET';
			break;
			case 'change-password':
				$data = array(
					'actual' => secure($_POST['c_actual']),
					'new' => secure($_POST['c_new']),
					'renew' => secure($_POST['c_renew'])
				);
				$close_sessions = intval($_POST['c_close']) ? true : false;
				foreach($data AS $val){
					if(empty($val)) return '0: No haz completado todos los campos';
				}
				if(strlen($data['new']) < 6 || strlen($data['new']) > 20) return '0: Tu nueva contrase&ntilde;a debe tener entre 6 y 20 caracteres';
				if($data['new'] != $data['renew']) return '0: Las contrase&ntilde;as ingresadas no coinciden';
				$p_actual = substr(md5(sha1($data['actual']).'SMLine'), 0, 35);
				$user_data = $mysqli->query('SELECT u_pass FROM users WHERE u_id = \''.$user->uid.'\' LIMIT 1')->fetch_assoc();
				if($p_actual != $user_data['u_pass']) return '0: La contrase&ntilde;a ingresada no es correcta';
				$p_new = substr(md5(sha1($data['new']).'SMLine'), 0, 35);
				$mysqli->query('UPDATE users SET u_pass = \''.$p_new.'\' WHERE u_id = \''.$user->uid.'\'');
				if($close_sessions) $user->cerrar($user->uid, true);
				return '1: SMline.NET';
			break;
		}
	}
	
	function import_avatar($url){
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
	
	function save_avatar(){
		global $user, $mysqli, $web;
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
		if(empty($data['img'][0])) return '0: La imagen no existe o no es una imagen v&aacute;lida';
		elseif($data['img'][0] < $min_w || $data['img'][1] < $min_h) return '0: La imagen debe tener un tama&ntilde;o superior a 120x120 pixeles';
		elseif($data['img'][0] > $max_w || $data['img'][1] > $max_h) return '0: La imagen debe tener un tama&ntilde;o menor a 2000x2000 pixeles';
		include('PHP/class/images.class.php');
		$img = new img;
		$img->upload($img_url, $user->uid.'_120', 120, 120, $x1, $y1, false, $w, $h, '/avatar/');
		$img->upload($web['url'].'/avatar/'.$user->uid.'_120.jpg', $user->uid.'_50', 50, 50, 0, 0, false, 120, 120, '/avatar/');
		$img->upload($web['url'].'/avatar/'.$user->uid.'_120.jpg', $user->uid.'_32', 32, 32, 0, 0, false, 120, 120, '/avatar/');
		$img->upload($web['url'].'/avatar/'.$user->uid.'_120.jpg', $user->uid.'_16', 16, 16, 0, 0, false, 120, 120, '/avatar/');
		$time = time();
		$mysqli->query('UPDATE users SET u_last_avatar = \''.$time.'\' WHERE u_id = \''.$user->uid.'\' LIMIT 1');
		return '1: '.$web['url'].'/avatar/'.$user->uid.'_120.jpg?'.$time;
	}
}
?>