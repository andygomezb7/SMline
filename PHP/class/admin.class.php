<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class admin{
	
	function set_access(){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT a_id, a_user FROM admin_access ORDER BY a_id DESC LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['a_user'] == $user->uid){
			$mysqli->query('UPDATE admin_access SET a_date = \''.time().'\' WHERE a_id = \''.$data['a_id'].'\' LIMIT 1');
			return;
		}
		$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$mysqli->query('INSERT INTO admin_access (a_ip, a_user, a_date) VALUES (\''.$ip.'\', \''.$user->uid.'\', \''.time().'\')');
		
		// BORRAMOS ACCESOS ANTIGUOS
		$limit_del = $data['a_id']-4;
		$mysqli->query('DELETE FROM admin_access WHERE a_id < \''.$limit_del.'\'');
	}
	
	function get_access(){
		global $mysqli;
		$query = $mysqli->query('SELECT a.a_ip, a.a_user, a.a_date, u.u_nick FROM admin_access AS a LEFT JOIN users AS u ON u.u_id = a.a_user ORDER BY a.a_id DESC LIMIT 5');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_admins(){
		global $mysqli;
		$query = $mysqli->query('SELECT r_id, r_permits FROM users_ranks');
		while($row = $query->fetch_assoc()){
			$row['p'] = unserialize($row['r_permits']);
			if($row['p']['goadmin']){
				$query_users = $mysqli->query('SELECT u_nick FROM users WHERE u_rank = \''.$row['r_id'].'\'');
				while($data = $query_users->fetch_assoc()) $result[] = $data;
			}
		}
		return $result;
	}
	
	function get_icons($f = 'cats', $size = null){
		global $web;
        $arr_ext = array('jpg', 'png', 'gif');
        $mydir = opendir('./themes/'.$web['theme'].'/css/img/icons/'.$f);
        while($file = readdir($mydir)){
            $ext = substr($file, -3);
            if(in_array($ext, $arr_ext)){
                if(!empty($size)){
                    $im_size = substr($file, -6, 2);
                    if ($size == $im_size)
                        $icons[] = substr($file, 0, -7);
                }else $icons[] = $file;
            }
        }
        return $icons;
    }
	
	function pag($page, $registros, $max, $url){
		if($registros <= $max) return false;
		$quote = "'";
		$return = '<div class="paginas pag_recent" align="center">';
		if(($page - 1) > 0) $return .= '<a id="btn" title="Anterior" href="'.$url.'page='.($page - 1).'">&#171;</a>';
		$total_pages = ceil($registros / $max);
		for ($i=1; $i<=$total_pages; $i++){
			if($page == $i) $return .= '<a class="numero active">'.$page.'</a>';
			else{
				if(($i < ($page + 4) && $i > ($page - 4)) && $i < ($total_pages+1)) $return .= '<a class="numero" href="'.$url.'page='.$i.'">'.$i.'</a>';
			}
		}
		if(($page + 1)<=$total_pages) $return .= '<a id="btn" title="Siguiente" href="'.$url.'page='.($page + 1).'">&#187;</a>';
		$return .= '</div>';
		return $return;
	}
	
//=> CONFIGS
	
	function save_settings(){
		global $mysqli;
		$item = secure($_POST['item']);
		$item = substr($item, 2);
		$val = secure($_POST['val']);
		$mysqli->query('UPDATE web_settings SET '.$item.' = \''.$val.'\'');
		return '1: Cambios guardados!';
	}
	
//=> TEMAS
	function get_themes(){
		global $mysqli;
		$query = $mysqli->query('SELECT t_id, t_name, t_seo, t_author, t_author_link, t_install FROM admin_themes ORDER BY t_id DESC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function install_theme(){
		global $mysqli, $web;
		$t_seo = secure($_POST['t_seo']);
		if(empty($t_seo)) return 'Ingresa el directorio de el tema';
		include('./themes/'.$t_seo.'/theme.php');
		if(empty($status)) return 'La carpeta no existe en el directorio <strong>'.$web['url'].'/themes/</strong>';
		if(!preg_match('/^[-a-zA-Z0-9]+$/i', $t_seo)) return 'El nombre de la carpeta debe tener solo caracteres alfanum&eacute;ricos y guiones.<br />Puedes editar el nombre de la carpeta desde tu FTP.';
		$query = $mysqli->query('SELECT t_id FROM admin_themes WHERE t_seo = \''.$t_seo.'\' LIMIT 1');
		if($query->num_rows) return 'Este tema ya se encuentra instalado.';
		else {
			$mysqli->query('INSERT INTO admin_themes (t_name, t_seo, t_author, t_author_link, t_install) VALUES (\''.$theme_name.'\', \''.$t_seo.'\', \''.$theme_author.'\', \''.$theme_author_link.'\', \''.time().'\')');
			return array();
		}
	}
	
	function uninstall_theme(){
		global $mysqli, $web;
		$t_id = intval($_GET['tid']);
		if($mysqli->query('DELETE FROM admin_themes WHERE t_id = \''.$t_id.'\' LIMIT 1')) return true;
		else return false;
	}
	
	function aplicar_theme(){
		global $smarty, $mysqli;
		$data_theme = $this->data_theme();
		include('./themes/'.$data_theme['t_seo'].'/theme.php');
		if(empty($status)) return false;
		if($data_theme && $mysqli->query('UPDATE web_settings SET theme = \''.$data_theme['t_seo'].'\' LIMIT 1')){
			$directory = $smarty->cache_dir;
			$h = opendir($directory);
			while(($dat = readdir($h)) !== false){
				if($dat != '.' && $dat != '..') unlink($directory . DIRECTORY_SEPARATOR . $dat);
			}
			closedir($h);
			return true;
		}else die('No se pudo instalar el tema');
	}
	
	function data_theme(){
		global $mysqli;
		$t_id = intval($_GET['tid']);
		$query = $mysqli->query('SELECT t_id, t_name, t_seo, t_author, t_author_link, t_install FROM admin_themes WHERE t_id = \''.$t_id.'\'');
		$data = $query->fetch_assoc();
		if(!$query->num_rows) return false;
		return $data;
	}
	
//=> NOTICIAS
	
	function add_new(){
		global $mysqli, $user;
		$n_body = secure($_POST['n_body']);
		$n_status = empty($_POST['n_status']) ? 0 : 1;
		if(empty($n_body)) return '0: No haz ingresado la noticia';
		$mysqli->query('INSERT INTO news (n_body, n_user, n_date, n_status) VALUES (\''.$n_body.'\', \''.$user->uid.'\', \''.time().'\', \''.$n_status.'\')');
		return '1: Noticia agregada!';
	}
	
	function upd_new(){
		global $mysqli;
		$n_id = intval($_POST['n_id']);
		$query = $mysqli->query('SELECT n_status FROM news WHERE n_id = \''.$n_id.'\' LIMIT 1');
		if($query->num_rows == 0) return '0: La noticia no existe';
		$data = $query->fetch_assoc();
		$new_status = $data['n_status'] == 0 ? 1 : 0;
		$mysqli->query('UPDATE news SET n_status = \''.$new_status.'\' WHERE n_id = \''.$n_id.'\' LIMIT 1');
		if($new_status == 1) return '1: ';
		else return '2: ';
	}
	
	function del_new(){
		global $mysqli;
		$n_id = intval($_POST['n_id']);
		$mysqli->query('DELETE FROM news WHERE n_id = \''.$n_id.'\' LIMIT 1');
		return '1: ';
	}
	
	function news(){
		global $mysqli;
		$query = $mysqli->query('SELECT n.*, u.u_nick FROM news AS n LEFT JOIN users AS u ON u.u_id = n.n_user ORDER BY n_id DESC');
		$i = 0;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query->fetch_assoc()){
			$data[$i] = $row;
			$data[$i]['n_body'] = $bbcode->start($row['n_body']);
			$i++;
		}
		return $data;
	}
	
//=> BANNERS
	
	function save_ads(){
		global $mysqli;
		$ads_script = html_entity_decode($_POST['ads_script']);
		$ads_300 = html_entity_decode($_POST['ads_300']);
		$ads_468 = html_entity_decode($_POST['ads_468']);
		$ads_160 = html_entity_decode($_POST['ads_160']);
		$ads_728 = html_entity_decode($_POST['ads_728']);
		$mysqli->query('UPDATE web_settings SET ads_script = \''.$ads_script.'\', ads_300 = \''.$ads_300.'\', ads_468 = \''.$ads_468.'\', ads_160 = \''.$ads_160.'\', ads_728 = \''.$ads_728.'\'');
		return '1: Cambios guardados!';
	}
	
//=> LINKS DE INTERES
	
	function add_link(){
		global $mysqli, $user;
		$l_url = secure($_POST['l_url']);
		$l_title = secure($_POST['l_title']);
		$l_status = empty($_POST['l_status']) ? 0 : 1;
		if(empty($l_url)) return '0: No haz ingresado la url del sitio';
		if(empty($l_title)) return '0: ingresa el t&iacute;tulo del link';
		if(!filter_var($l_url, FILTER_VALIDATE_URL)) return '0: La url ingresada no es v&aacute;lida';
		$mysqli->query('INSERT INTO admin_links (l_url, l_title, l_user, l_date, l_status) VALUES (\''.$l_url.'\', \''.$l_title.'\', \''.$user->uid.'\', \''.time().'\', \''.$l_status.'\')');
		return '1: Link is ADD!';
	}
	
	function upd_link(){
		global $mysqli;
		$l_id = intval($_POST['l_id']);
		$query = $mysqli->query('SELECT l_status FROM admin_links WHERE l_id = \''.$l_id.'\' LIMIT 1');
		if($query->num_rows == 0) return '0: La web amiga no existe';
		$data = $query->fetch_assoc();
		$new_status = $data['l_status'] == 0 ? 1 : 0;
		$mysqli->query('UPDATE admin_links SET l_status = \''.$new_status.'\' WHERE l_id = \''.$l_id.'\' LIMIT 1');
		if($new_status == 1) return '1: ';
		else return '2: ';
	}
	
	function del_link(){
		global $mysqli;
		$l_id = intval($_POST['l_id']);
		$mysqli->query('DELETE FROM admin_links WHERE l_id = \''.$l_id.'\' LIMIT 1');
		return '1: ';
	}
	
	function links_i(){
		global $mysqli;
		$query = $mysqli->query('SELECT l.*, u.u_nick FROM admin_links AS l LEFT JOIN users AS u ON u.u_id = l.l_user ORDER BY l.l_id DESC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
//=> BLOQUEOS
	
	function add_lock(){
		global $mysqli, $user;
		$l_type = intval($_POST['l_type']);
		$l_lock = secure($_POST['l_lock']);
		$locks_types = array(1, 2, 3);
		if(!in_array($l_type, $locks_types)) return '0: El tipo de bloqueo seleccionado no es v&aacute;lido';
		if(empty($l_lock)) return '0: Por favor, ingresa un bloqueo v&aacute;lido';
		$mysqli->query('INSERT INTO admin_locks (l_type, l_lock, l_user, l_date) VALUES (\''.$l_type.'\', \''.$l_lock.'\', \''.$user->uid.'\', \''.time().'\')');
		return '1: Lock is ADD!';
	}
	
	function del_lock(){
		global $mysqli;
		$l_id = intval($_POST['l_id']);
		$mysqli->query('DELETE FROM admin_locks WHERE l_id = \''.$l_id.'\' LIMIT 1');
		return '1: OKAY';
	}
	
	function get_locks(){
		global $mysqli;
		$query = $mysqli->query('SELECT l.*, u.u_nick FROM admin_locks AS l LEFT JOIN users AS u ON u.u_id = l.l_user ORDER BY l.l_id DESC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
//=> CENSURAS
	
	function add_cen(){
		global $mysqli, $user;
		$c_val = secure($_POST['c_val']);
		$c_por = secure($_POST['c_por']);
		$c_ireplace = empty($_POST['c_ireplace']) ? 0 : 1;
		if(empty($c_val)) return '0: No haz ingresado la palabra a censurar';
		if(strlen($c_val) <= 3) return '0: La palabra a censurar es demasiado corta';
		$mysqli->query('INSERT INTO censored (c_val, c_por, c_ireplace, c_admin, c_date) VALUES (\''.$c_val.'\', \''.$c_por.'\', \''.$c_ireplace.'\', \''.$user->uid.'\', \''.time().'\')');
		return '1: SMLine.Net';
	}
	
	function del_cen(){
		global $mysqli;
		$c_id = intval($_POST['c_id']);
		$mysqli->query('DELETE FROM censored WHERE c_id = \''.$c_id.'\' LIMIT 1');
		return '1: SMLine.Net';
	}
	
	function censored(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.*, u.u_nick FROM censored AS c LEFT JOIN users AS u ON u.u_id = c.c_admin ORDER BY c.c_id DESC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
//=> POSTS
	
	function posts(){
		global $mysqli;
		$web['max_posts'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		$sql['list'] = $mysqli->query('SELECT u.u_nick, c.c_seo, c.c_img, c.c_name, p.p_id, p.p_title, p.p_date, p.p_status FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id LEFT JOIN users AS u ON u.u_id = p.p_user ORDER BY p.p_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT p_id AS total FROM posts');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/admin?do=posts&');
		return $data;
	}
	
//=> IMAGENES
	
	function get_images(){
		global $mysqli;
		$web['max_images'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_images'];
		$sql['list'] = $mysqli->query('SELECT u.u_nick, i.i_id, i.i_title, i.i_date, i.i_status FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user ORDER BY i.i_id DESC LIMIT '.$inicio.', '.$web['max_images']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT i_id FROM images');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_images'], '/admin?do=gallery&');
		return $data;
	}
	
//=> MEDALLAS
	
	function get_medals(){
		global $mysqli;
		$query = $mysqli->query('SELECT m.* FROM admin_medals AS m');
		$i = 0;
		while($row = $query->fetch_assoc()){
			$query_users = $mysqli->query('SELECT ma_id FROM admin_medals_assign WHERE m_id = \''.$row['m_id'].'\'')->num_rows;
			$data[$i] = $row;
			$data[$i]['m_users'] = $query_users;
			$i++;
		}
		return $data;
	}
	
	function see_medal($m_id){
		global $mysqli;
		$query = $mysqli->query('SELECT m_title FROM admin_medals WHERE m_id = \''.$m_id.'\' LIMIT 1');
		while($row = $query->fetch_assoc()) $data['m'][] = $row;
		$query_users =  $mysqli->query('SELECT ma.ma_id, ma.ma_date, u.u_id, u.u_nick, u.u_email, u.u_last_active, u.u_date FROM admin_medals_assign AS ma LEFT JOIN users AS u ON u.u_id = ma.ma_user WHERE ma.m_id = \''.$m_id.'\' ORDER BY ma.ma_id DESC');
		while($row = $query_users->fetch_assoc()) $data['users'][] = $row;
		return $data;
	}
	
	function medals_types(){
		$array_types = array(
							1 => 'Puntos recibidos',
							2 => 'Puntos dados',
							3 => 'Posts creados',
							4 => 'Temas creados',
							5 => 'Im&aacute;genes subidas',
							6 => 'Comentarios en posts',
							7 => 'Respuestas en temas',
							8 => 'Comentarios en Im&aacute;genes',
							9 => 'Seguidores',
							10 => 'Rango'
						);
		return $array_types;
	}
	
	function add_medal(){
		global $mysqli, $user;
		$m_title = secure($_POST['m_title']);
		$m_desc = secure($_POST['m_desc']);
		$m_cant = intval($_POST['m_cant']);
		$m_type = intval($_POST['m_type']);
		$m_rank = secure($_POST['m_rank']);
		$m_image = secure($_POST['m_icon']);
		$m_types = $this->medals_types();
		
		if(empty($m_title)) return '0: Ingresa el t&iacute;tulo de la medalla';
		if(empty($m_desc)) return '0: Ingresa la descripci&oacute;n de la medalla';
		if(empty($m_types[$m_type])) return '0: El tipo de medalla no es v&aacute;lido';
		
		if($m_type == 10) $m_cant = 0;
		else $m_rank = 0;
		
		$mysqli->query('INSERT INTO admin_medals (m_title, m_desc, m_autor, m_image, m_cant, m_type, m_rank, m_date) VALUES (\''.$m_title.'\', \''.$m_desc.'\', \''.$user->uid.'\', \''.$m_image.'\', \''.$m_cant.'\', \''.$m_type.'\', \''.$m_rank.'\', \''.time().'\')');
		return '1: Medal is ADD!';
	}
	
	function save_medal($m_id){
		global $mysqli;
		
		// DATOS DE LA MEDALLA
		$query = $mysqli->query('SELECT m_id FROM admin_medals WHERE m_id = \''.$m_id.'\' LIMIT 1');
		if(empty($query->num_rows)) return '0: Esta medalla no existe';
		
		// VARIABLES
		$m_title = secure($_POST['m_title']);
		$m_desc = secure($_POST['m_desc']);
		$m_cant = intval($_POST['m_cant']);
		$m_type = intval($_POST['m_type']);
		$m_rank = secure($_POST['m_rank']);
		$m_image = secure($_POST['m_icon']);
		$m_types = $this->medals_types();
		
		// CAMPOS VACIOS
		if(empty($m_title)) return '0: Ingresa el t&iacute;tulo de la medalla';
		if(empty($m_desc)) return '0: Ingresa la descripci&oacute;n de la medalla';
		if(empty($m_types[$m_type])) return '0: El tipo de medalla no es v&aacute;lido';
		if($m_type == 10) $m_cant = 0;
		else $m_rank = 0;
		
		// NUEVOS DATOS
		$mysqli->query('UPDATE admin_medals SET m_title = \''.$m_title.'\', m_desc = \''.$m_desc.'\', m_image = \''.$m_image.'\', m_cant = \''.$m_cant.'\', m_type = \''.$m_type.'\', m_rank = \''.$m_rank.'\' WHERE m_id = \''.$m_id.'\' LIMIT 1');
		
		// RETORNAMOS
		return '1: Ok save';
	}
	
	function medal_info($m_id){
		global $mysqli;
		$query = $mysqli->query('SELECT m.* FROM admin_medals AS m WHERE m.m_id = \''.$m_id.'\'');
		$data = $query->fetch_assoc();
		if(empty($data['m_id'])) die('La medalla seleccionada no existe');
		return $data;
	}
	
	function del_medal($m_id){
		global $mysqli;
		$query = $mysqli->query('SELECT m_id FROM admin_medals AS m WHERE m.m_id = \''.$m_id.'\'');
		$data = $query->fetch_assoc();
		if(empty($data['m_id'])) return '0: La medalla seleccionada no existe';
		$mysqli->query('DELETE FROM admin_medals WHERE m_id = \''.$m_id.'\'');
		$mysqli->query('DELETE FROM admin_medals_assign WHERE m_id = \''.$m_id.'\'');
		return '1: Ok del';
	}
	
	function del_medal_assign($ma_id){
		global $mysqli;
		$query = $mysqli->query('SELECT ma_id FROM admin_medals_assign WHERE ma_id = \''.$ma_id.'\'');
		$data = $query->fetch_assoc();
		if(empty($data['ma_id'])) return '0: La asignaci&oacute;n que busca no existe';
		$mysqli->query('DELETE FROM admin_medals_assign WHERE ma_id = \''.$ma_id.'\'');
		return '1: Ok del assign';
	}
	
//=> RANGOS
	
	function ranks($type){
		global $mysqli;
		$query = $mysqli->query('SELECT r.* FROM users_ranks AS r WHERE r_type = \''.$type.'\'');
		$i = 0;
		while($row = $query->fetch_assoc()){
			$query_users = $mysqli->query('SELECT u_id FROM users WHERE u_rank = \''.$row['r_id'].'\'')->num_rows;
			$data[$i] = $row;
			$data[$i]['r_users'] = $query_users;
			$i++;
		}
		return $data;
	}
	
	function see_rank($r_id){
		global $mysqli;
		$query = $mysqli->query('SELECT r_name FROM users_ranks WHERE r_id = \''.$r_id.'\' LIMIT 1');
		while($row = $query->fetch_assoc()) $data['r'][] = $row;
		$query_users =  $mysqli->query('SELECT u_id, u_nick, u_email, u_last_active, u_date FROM users WHERE u_rank = \''.$r_id.'\' ORDER BY u_id DESC');
		while($row = $query_users->fetch_assoc()) $data['users'][] = $row;
		return $data;
	}
	
	function add_rank(){
		global $mysqli;
		$permits = array('gadmin', 'gomod', 'bp', 'ep', 'vpb', 'vpr', 'apr', 'fp', 'dfp', 'bf', 'ef', 'vfb', 'be', 'ee', 'veb', 'scs', 'rcs', 'ecds', 'etds', 'ecs', 'vmcs', 'bt', 'et', 'ft', 'dt', 'bc', 'oc', 'ec', 'acc', 'vcb', 'su', 'ru', 'aebn', 'ebp', 'aebli', 'acp', 'acf', 'acm', 'aebc', 'aeu', 'aebm', 'aebr', 'abpc', 'abib', 'as', 'pp', 'cp', 'sprr', 'bpp', 'epp', 'pf', 'efp', 'bfp', 'pt', 'etp', 'btp', 'vpt', 'vnt', 'ccs', 'ecsp', 'bcsp', 'pc', 'em', 'cm', 'ecp', 'bcp', 'vpc', 'vnc', 'vpf', 'vnf', 'pe', 'eep', 'bep');
		$val_permits = array('ppm', 'sprrp', 'pfm', 'ptm', 'vptm', 'vntm', 'ccsm', 'pcm', 'emm', 'vpcm', 'vncm', 'vpfm', 'vnfm', 'pem');
		$new_array = $_POST;
		$permit = array();
		$permit_list = '';
		foreach($new_array as $name => $val){
			if(in_array($name, $permits)) $permit[$name] = $val == 1 ? 1 : 0;
			else if(in_array($name, $val_permits)) $permit[$name] = intval($val);
			else if($name) $_POST[$name] = secure($val);
		}
		if(empty($_POST['r_name'])) return '0: Ingresa el nombre del rango';
		$_POST['r_color'] = empty($_POST['r_color']) ? '000' : str_replace('#', '', $_POST['r_color']);
		
		if(empty($_POST['r_points_require'])) $r_type = 1;
		else $r_type = 0;
		$permit = serialize($permit);
		$mysqli->query('INSERT INTO users_ranks (r_name, r_color, r_image, r_pxd, r_type, r_permits, r_flood, r_points_require) VALUES (\''.$_POST['r_name'].'\', \''.$_POST['r_color'].'\', \''.$_POST['r_image'].'\', \''.$_POST['r_pxd'].'\', \''.$r_type.'\', \''.$permit.'\', \''.$_POST['r_flood'].'\', \''.$_POST['r_points_require'].'\')');
		return '1: Rango agregado!';
	}
	
	function save_rank($r_id){
		global $mysqli;
		$permits = array('goadmin', 'gomod', 'bp', 'ep', 'vpb', 'vpr', 'apr', 'fp', 'dfp', 'bf', 'ef', 'vfb', 'be', 'ee', 'veb', 'scs', 'rcs', 'ecds', 'etds', 'ecs', 'vmcs', 'bt', 'et', 'ft', 'dt', 'bc', 'oc', 'ec', 'acc', 'vcb', 'su', 'ru', 'aebn', 'ebp', 'aebli', 'acp', 'acf', 'acm', 'aebc', 'aeu', 'aebm', 'aebr', 'abpc', 'abib', 'as', 'pp', 'cp', 'sprr', 'bpp', 'epp', 'pf', 'efp', 'bfp', 'pt', 'etp', 'btp', 'vpt', 'vnt', 'ccs', 'ecsp', 'bcsp', 'pc', 'em', 'cm', 'ecp', 'bcp', 'vpc', 'vnc', 'vpf', 'vnf', 'pe', 'eep', 'bep');
		$val_permits = array('ppm', 'sprrp', 'pfm', 'ptm', 'vptm', 'vntm', 'ccsm', 'pcm', 'emm', 'vpcm', 'vncm', 'vpfm', 'vnfm', 'pem');
		$new_array = $_POST;
		$permit = array();
		$permit_list = '';
		foreach($new_array as $name => $val){
			if(in_array($name, $permits)) $permit[$name] = $val == 1 ? 1 : 0;
			else if(in_array($name, $val_permits)) $permit[$name] = intval($val);
			else if($name) $_POST[$name] = secure($val);
		}
		if(empty($_POST['r_name'])) return '0: Ingresa el nombre del rango';
		$_POST['r_color'] = empty($_POST['r_color']) ? '000' : str_replace('#', '', $_POST['r_color']);
		
		if(empty($_POST['r_points_require'])) $r_type = 1;
		else $r_type = 0;
		$permit = serialize($permit);
		$mysqli->query('UPDATE users_ranks SET r_name = \''.$_POST['r_name'].'\', r_flood = \''.$_POST['r_flood'].'\', r_color = \''.$_POST['r_color'].'\', r_image = \''.$_POST['r_image'].'\', r_pxd = \''.$_POST['r_pxd'].'\', r_type = \''.$r_type.'\', r_permits = \''.$permit.'\', r_points_require = \''.$_POST['r_points_require'].'\' WHERE r_id = \''.$r_id.'\' LIMIT 1');
		return '1: Rango editado!';
	}
	
	function rank_info($r_id){
		global $mysqli;
		$query = $mysqli->query('SELECT r.*, r.r_permits FROM users_ranks AS r WHERE r.r_id = \''.$r_id.'\'');
		$data['e'] = $query->fetch_assoc();
		$query_users = $mysqli->query('SELECT u_id FROM users WHERE u_rank = \''.$r_id.'\'')->num_rows;
		$data['e']['users'] = $query_users;
		$data['r'] = unserialize($data['e']['r_permits']);
		if(empty($data['e']['r_id'])) die('El rango seleccionado no existe');
		return $data;
	}
	
	function rank_del($r_id){
		global $mysqli;
		if($r_id <= 3) return '0: Imposible eliminar este rango';
		$query_users = $mysqli->query('SELECT u_id FROM users WHERE u_rank = \''.$r_id.'\'');
		if($query_users->num_rows){
			$move_to = intval($_POST['move_to']);
			$query = $mysqli->query('SELECT r.* FROM users_ranks AS r WHERE r.r_id = \''.$move_to.'\'');
			if(!$query->num_rows) return '0: El rango nuevo para los usuarios no existe';
			else{
				$mysqli->query('UPDATE users SET u_rank = \''.$move_to.'\' WHERE u_rank = \''.$r_id.'\'');
			}
		}
		$mysqli->query('DELETE FROM users_ranks WHERE r_id = \''.$r_id.'\'');
		return '1: El rango ha sido eliminado!';
	}
	
	// USUARIOS
	
	function get_users(){
		global $mysqli;
		
		// PAGINACION
		$web['max_users'] = 40;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_users'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_user = 'WHERE u.u_nick LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT u.u_id, u.u_nick, u.u_email, u.u_last_active, u.u_date, u.u_last_ip, u.u_status, r.r_name, r.r_color FROM users AS u LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank '.$w_user.' ORDER BY u.u_id DESC LIMIT '.$inicio.', '.$web['max_users']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT u.u_id AS total FROM users AS u '.$w_user.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_users'], '/admin?do=users&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	function user_info($uid){
		global $mysqli;
		$query = $mysqli->query('SELECT u.u_id, u.u_nick, u.u_email, u.u_last_active, u.u_last_ip, u.u_points_ava, u.u_status, r.r_id, r.r_name, r.r_color, ac.u_bio, ac.u_site, ac.u_names, ac.u_surnames, ac.u_image, ac.u_color FROM users AS u LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id WHERE u.u_id = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data){
			$data['u_posts'] = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$uid.'\'')->num_rows;
			$data['u_images'] = $mysqli->query('SELECT i_id FROM images WHERE i_user = \''.$uid.'\'')->num_rows;
			$data['u_topics'] = $mysqli->query('SELECT t_id FROM comus_topics WHERE t_user = \''.$uid.'\'')->num_rows;
			$data['u_comments'] = $mysqli->query('SELECT c_id FROM comments WHERE c_user = \''.$uid.'\'')->num_rows;
			$data['u_states'] = $mysqli->query('SELECT s_id FROM states WHERE s_user = \''.$uid.'\' OR s_to_user = \''.$uid.'\'')->num_rows;
			$data['u_favorites'] = $mysqli->query('SELECT f_id FROM favorites WHERE f_user = \''.$uid.'\'')->num_rows;
			$data['u_activity'] = $mysqli->query('SELECT a_type FROM activity WHERE a_user = \''.$uid.'\'')->num_rows;
			$data['u_notis'] = $mysqli->query('SELECT n_type FROM notifications WHERE n_user_to = \''.$uid.'\'')->num_rows;
			return $data;
		}else return 'El usuario seleccionado no existe';
	}
	
	function user_save($uid){
		global $user, $mysqli, $notifica;
		
		// VARIABLES SEGURAS
		$u_nick = secure($_POST['u_nick']);
		$u_email = secure($_POST['u_email']);
		$u_rank = intval($_POST['u_rank']);
		$u_names = secure($_POST['u_names']);
		$u_surnames = secure($_POST['u_surnames']);
		$u_bio = secure($_POST['u_bio']);
		$u_site = secure($_POST['u_site']);
		$u_image = secure($_POST['u_image']);
		$u_color = secure($_POST['u_color']);
		$u_pass = secure($_POST['u_pass']);
		$u_repass = secure($_POST['u_repass']);
		$c_close = empty($_POST['c_close']) ? 0 : 1;
		$c_send = explode(',', $_POST['c_send'][0]);
		
		// EXISTE?
		$query['uedit'] = $mysqli->query('SELECT u_nick, u_email, u_rank FROM users WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data['uedit'] = $query['uedit']->fetch_assoc();
		
		// CONSULTAS
		$query['nick'] = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_nick) = \''.strtolower($u_nick).'\' AND u_nick != \''.$data['uedit']['u_nick'].'\'');
		$query['email'] = $mysqli->query('SELECT u_id FROM users WHERE LOWER(u_email) = \''.strtolower($u_email).'\'  AND u_email != \''.$data['uedit']['u_email'].'\'');
		$query['rank'] = $mysqli->query('SELECT r.* FROM users_ranks AS r WHERE r.r_id = \''.$u_rank.'\' LIMIT 1');
		
		// PRIMER ADMIN
		if($uid == 1) return '0: Imposible editar la cuenta del administrador principal';
		// EXISTE
		elseif(empty($data['uedit'])) return '0: El usuario que quieres editar no existe';
		// COMPROBAMOS EL NICK
		elseif(es_nulo($u_nick) || !preg_match('/^[-_a-zA-Z0-9]+$/i', $u_nick) || strlen($u_nick) < 3 || strlen($u_nick) > 16) return '0: Ingresa un nick v&aacute;lido de 3 a 16 caracteres';
		elseif($query['nick']->num_rows) return '0: El nick ingresado ya se encuentra en uso';
		// COMPROBAMOS EN CORREO
		elseif(!filter_var($u_email, FILTER_VALIDATE_EMAIL) || strlen($u_email) > 40) return '0: Ingresa un email v&aacute;lido que no supere los 40 caracteres';
		elseif($query['email']->num_rows) return '0: El email ingresado ya se encuentra en uso';
		// RANGO
		elseif(!$query['rank']->num_rows) return '0: El rango seleccionado no existe';
		// NOMBRES Y APELLIDOS
		// RANK NOTIFICA
		if($u_rank != $data['uedit']['u_rank']) $notifica->insert(44, $u_rank, $uid, 0, 'SMLine');
		
		// GENERAL
		$mysqli->query('UPDATE users SET u_nick = \''.$u_nick.'\', u_email = \''.$u_email.'\', u_rank = \''.$u_rank.'\' WHERE u_id = \''.$uid.'\'');
		// PERFIL
		$mysqli->query('UPDATE users_accounts SET u_bio = \''.$u_bio.'\', u_site = \''.$u_site.'\', u_names = \''.$u_names.'\', u_surnames = \''.$u_surnames.'\', u_image = \''.$u_image.'\', u_color = \''.$u_color.'\' WHERE u_id = \''.$uid.'\'');
		// CAMBIAR PASS
		if($u_pass){
			if(strlen($u_pass) < 6 || strlen($u_pass) > 20) return '0: La nueva contrase&ntilde;a debe tener entre 6 y 20 caracteres';
			if($u_pass != $u_repass) return '0: Las contrase&ntilde;as ingresadas no coinciden';
			$p_new = substr(md5(sha1($u_pass).'SMLine'), 0, 35);
			$mysqli->query('UPDATE users SET u_pass = \''.$p_new.'\' WHERE u_id = \''.$uid.'\'');
			if($c_close) $user->cerrar($uid, true);
		}
		
		// BORRAR POSTS
		if(in_array(1, $c_send)){
			$query = $mysqli->query('SELECT COUNT(p_id) AS pactivos, SUM(p_puntos) AS tpuntos FROM posts WHERE p_status = \'1\' AND p_user = \''.$uid.'\'');
			$data = $query->fetch_assoc();
			$post_activos = $data['pactivos'];
			$total_puntos = $data['tpuntos'];
			$query = $mysqli->query('SELECT p_id FROM posts WHERE p_user = \''.$uid.'\'');
			while($row = $query->fetch_assoc()){
				// BORRAR PUNTOS
				$mysqli->query('DELETE FROM votes WHERE v_type = \'1\' AND v_type_id = \''.$row['p_id'].'\'');
				// BORRAR COMENTARIOS 
				$query_comments = $mysqli->query('SELECT c.* FROM comments AS c WHERE c.c_type = \'1\' AND c.c_type_id = \''.$row['p_id'].'\' ORDER BY c.c_id ASC');
				while($low = $query_comments->fetch_assoc()){
					$mysqli->query('DELETE FROM votes WHERE v_type = \'2\' AND v_type_id = \''.$low['c_id'].'\'');
					$total_a_borrar = $low['c_replies'] + 1;
					$mysqli->query('UPDATE web_stats SET comments = comments - \''.$total_a_borrar.'\'');
					$mysqli->query('UPDATE users_stats SET u_comments = u_comments - 1 WHERE u_id = \''.$low['c_user'].'\'');
				}
				$mysqli->query('DELETE FROM comments WHERE c_type = \'1\' AND c_type_id = \''.$row['p_id'].'\'');
				// BORRAR FAVORITOS
				$mysqli->query('DELETE FROM favorites WHERE f_type_id = \''.$row['p_id'].'\' AND f_type = \'1\'');
				// BORRAR HISTORIAL
				$mysqli->query('DELETE FROM history WHERE h_type = \'1\' AND h_type_id = \''.$row['p_id'].'\'');
				// BORRAR VISITAS
				$mysqli->query('DELETE FROM hits WHERE h_type = \'1\' AND h_type_id = \''.$row['p_id'].'\'');
			}
			$mysqli->query('UPDATE web_stats SET posts = posts - \''.$post_activos.'\'');
			$mysqli->query('UPDATE users_stats SET u_posts = u_posts - \''.$post_activos.'\', u_points = u_points - \''.$total_puntos.'\' WHERE u_id = \''.$uid.'\'');
			$mysqli->query('DELETE FROM posts WHERE p_user = \''.$uid.'\'');
		}
		
		// BORRAR IMAGENES
		if(in_array(2, $c_send)){
			$query = $mysqli->query('SELECT COUNT(i_id) AS iactivas FROM images WHERE i_status = \'1\' AND i_user = \''.$uid.'\'');
			$data = $query->fetch_assoc();
			$imagenes_activas = $data['iactivas'];
			$query = $mysqli->query('SELECT i_id FROM images WHERE i_user = \''.$uid.'\'');
			while($row = $query->fetch_assoc()){
				// BORRAR VOTOS
				$mysqli->query('DELETE FROM votes WHERE v_type = \'3\' AND v_type_id = \''.$row['i_id'].'\'');
				// BORRAR COMENTARIOS 
				$query_comments = $mysqli->query('SELECT c.* FROM comments AS c WHERE c.c_type = \'3\' AND c.c_type_id = \''.$row['i_id'].'\' ORDER BY c.c_id ASC');
				while($low = $query_comments->fetch_assoc()){
					$mysqli->query('DELETE FROM votes WHERE v_type = \'4\' AND v_type_id = \''.$low['c_id'].'\'');
					$total_a_borrar = $low['c_replies'] + 1;
					$mysqli->query('UPDATE web_stats SET images_comments = images_comments - \''.$total_a_borrar.'\'');
				}
				$mysqli->query('DELETE FROM comments WHERE c_type = \'3\' AND c_type_id = \''.$row['i_id'].'\'');
				// BORRAR FAVORITOS
				$mysqli->query('DELETE FROM favorites WHERE f_type_id = \''.$row['i_id'].'\' AND f_type = \'3\'');
				// BORRAR HISTORIAL
				$mysqli->query('DELETE FROM history WHERE h_type = \'3\' AND h_type_id = \''.$row['i_id'].'\'');
				// BORRAR VISITAS
				$mysqli->query('DELETE FROM hits WHERE h_type = \'3\' AND h_type_id = \''.$row['i_id'].'\'');
			}
			$mysqli->query('UPDATE web_stats SET images = images - \''.$imagenes_activas.'\'');
			$mysqli->query('UPDATE users_stats SET u_images = u_images - \''.$imagenes_activas.'\' WHERE u_id = \''.$uid.'\'');
			$mysqli->query('DELETE FROM images WHERE i_user = \''.$uid.'\'');
		}
		
		// BORRAR TEMAS
		if(in_array(3, $c_send)){
			$query = $mysqli->query('SELECT COUNT(t_id) AS tactivos FROM comus_topics WHERE t_status = \'1\' AND t_user = \''.$uid.'\'');
			$data = $query->fetch_assoc();
			$temas_activos = $data['tactivos'];
			$query = $mysqli->query('SELECT t_id, t_comu FROM comus_topics WHERE t_user = \''.$uid.'\'');
			while($row = $query->fetch_assoc()){
				// BORRAR VOTOS
				$mysqli->query('DELETE FROM votes WHERE v_type = \'5\' AND v_type_id = \''.$row['t_id'].'\'');
				// BORRAR COMENTARIOS 
				$query_comments = $mysqli->query('SELECT c.* FROM comments AS c WHERE c.c_type = \'5\' AND c.c_type_id = \''.$row['t_id'].'\' ORDER BY c.c_id ASC');
				while($low = $query_comments->fetch_assoc()){
					$mysqli->query('DELETE FROM votes WHERE v_type = \'6\' AND v_type_id = \''.$low['c_id'].'\'');
					$total_a_borrar = $low['c_replies'] + 1;
					$mysqli->query('UPDATE web_stats SET replies = replies - \''.$total_a_borrar.'\'');
					$mysqli->query('UPDATE users_stats SET u_replies = u_replies - 1 WHERE u_id = \''.$low['c_user'].'\'');
				}
				$mysqli->query('DELETE FROM comments WHERE c_type = \'5\' AND c_type_id = \''.$row['t_id'].'\'');
				// BORRAR FAVORITOS
				$mysqli->query('DELETE FROM favorites WHERE f_type_id = \''.$row['t_id'].'\' AND f_type = \'5\'');
				// BORRAR HISTORIAL
				$mysqli->query('DELETE FROM history WHERE h_type = \'5\' AND h_type_id = \''.$row['t_id'].'\'');
				// BORRAR VISITAS
				$mysqli->query('DELETE FROM hits WHERE h_type = \'1\' AND h_type_id = \''.$row['t_id'].'\'');
				// RESTAS TEMAS A LA COMUNIDAD
				$mysqli->query('UPDATE comus SET comu_topics = comu_topics - 1 WHERE comu_id = \''.$row['t_comu'].'\'');
			}
			$mysqli->query('UPDATE web_stats SET topics = topics - \''.$temas_activos.'\'');
			$mysqli->query('UPDATE users_stats SET u_topics = u_topics - \''.$temas_activos.'\' WHERE u_id = \''.$uid.'\'');
			$mysqli->query('DELETE FROM comus_topics WHERE t_user = \''.$uid.'\'');
		}
		
		return '1: Los cambios ser&aacute;n aplicados en los pr&oacute;ximos minutos';
	}
	
//=> CATEGORIAS
	
	function cats(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM posts_cats AS c ORDER BY c.c_name ASC');
		$i = 0;
		while($row = $query->fetch_assoc()){
			$query_posts = $mysqli->query('SELECT p_id FROM posts WHERE p_cat = \''.$row['c_id'].'\'')->num_rows;
			$data[$i] = $row;
			$data[$i]['posts'] = $query_posts;
			$i++;
		}
		return $data;
	}
	
	function add_cat(){
		global $mysqli;
		$c_name = secure($_POST['c_name']);
		$c_img = secure($_POST['c_img']);
		$c_seo = seo($c_name);
		if(empty($c_name)) return '0: Ingresa el nombre de la categor&iacute;a';
		$mysqli->query('INSERT INTO posts_cats (c_name, c_seo, c_img) VALUES (\''.$c_name.'\', \''.$c_seo.'\', \''.$c_img.'\')');
		return '1: SMLine.NET';
	}
	
	function cat_info($c_id){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM posts_cats AS c WHERE c_id = \''.$c_id.'\'');
		$data = $query->fetch_assoc();
		$data['posts'] = $mysqli->query('SELECT p_id FROM posts WHERE p_cat = \''.$c_id.'\'')->num_rows;
		return $data;
	}
	
	function save_cat(){
		global $mysqli;
		$c_id = intval($_POST['c_id']);
		$c_name = secure($_POST['c_name']);
		$c_img = secure($_POST['c_img']);
		$c_seo = seo($c_name);
		if(empty($c_name)) return '0: Ingresa el nombre de la categor&iacute;a';
		$mysqli->query('UPDATE posts_cats SET c_name = \''.$c_name.'\', c_seo = \''.$c_seo.'\', c_img = \''.$c_img.'\' WHERE c_id = \''.$c_id.'\'');
		return '1: SMLine.NET';
	}
	
	function cat_del($c_id){
		global $mysqli;
		$query_posts = $mysqli->query('SELECT p_id FROM posts WHERE p_cat = \''.$c_id.'\'');
		if($query_posts->num_rows){
			$move_to = intval($_POST['move_to']);
			$query = $mysqli->query('SELECT c.* FROM posts_cats AS c WHERE c.c_id = \''.$move_to.'\'');
			if(!$query->num_rows) return '0: La categor&iacute;a para mover posts no existe';
			else{
				$mysqli->query('UPDATE posts SET p_cat = \''.$move_to.'\' WHERE p_cat = \''.$c_id.'\'');
			}
		}
		$mysqli->query('DELETE FROM posts_cats WHERE c_id = \''.$c_id.'\'');
		return '1: La categor&iacute;a fue eliminada con exito!';
	}
	
//=> MENSAJES
	
	function get_mps(){
		// GLOBALES
		global $mysqli;
		
		// PAGINACION
		$web['max_mps'] = 40;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_mps'];
		$query = $mysqli->query('SELECT m.mp_subject, m.mp_id, m.mp_user, m.mp_to, m.mp_date, u.u_nick, u.u_last_avatar, sub.* FROM (SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies ORDER BY rp_id ASC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN users AS u ON u.u_id = sub.rp_user GROUP BY m.mp_id ORDER BY m.mp_id DESC LIMIT '.$inicio.', '.$web['max_mps']) or die($mysqli->error);
		$i = 0;
		while($row = $query->fetch_assoc()){
			$data['list'][$i] = $row;
			$data['list'][$i]['rp_body'] = get_meta_description($row['rp_body']);
			$i++;
		}
		$query_total = $mysqli->query('SELECT mp_id FROM mps');
		$data['pages'] = $this->pag($page, $query_total->num_rows, $web['max_mps'], '/admin?do=mps&');
		return $data;
	}
	
	function read_mp($mp_id){
		global $mysqli;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT m.mp_id, m.mp_user, m.mp_to, m.mp_del_to, m.mp_del_from, m.mp_subject, m.mp_date, u.u_nick, u.u_id, u.u_last_avatar FROM mps AS m LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE m.mp_id = \''.$mp_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: Este mensaje no existe';
		
		// LIBS
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		
		// RESPUESTAS
		$query_replies = $mysqli->query('SELECT r.rp_id, r.rp_user, r.rp_body, r.rp_date, r.rp_view, u.u_nick, u.u_last_avatar FROM mps_replies AS r JOIN users AS u ON u.u_id = r.rp_user WHERE r.mp_id = \''.$data['mp_id'].'\' ORDER BY r.rp_id ASC');
		$i = 0;
		while($row = $query_replies->fetch_assoc()){
			$data['replies'][$i] = $row;
			$data['replies'][$i]['rp_body'] = $bbcode->start($row['rp_body']);
			$i++;
		}
		
		// RETORNAMOS EL RESULTADO
		return $data;
	}
	
	function del_mp($mp_id){
		global $mysqli, $user;
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT mp_id, mp_user, mp_to, mp_del_to, mp_del_from FROM mps WHERE mp_id = \''.$mp_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: El mensaje que buscas no existe';
		
		// BORRAR DEFINITVAMENTE
		$mysqli->query('DELETE FROM mps WHERE mp_id = \''.$data['mp_id'].'\' LIMIT 1');
		// BORRAR RESPUESTAS
		$mysqli->query('DELETE FROM mps_replies WHERE mp_id = \''.$data['mp_id'].'\'');
		
		// RETORNO
		return '1: Mp is del';
	}
	
//=> ESTADISTICAS
	
	function get_stats(){
		global $mysqli;
		
		$data['dias_online'] = $this->get_dias_online();
		
		// GET USUARIOS
		$query['users'] = $mysqli->query('SELECT
			(SELECT COUNT(u_id) FROM users) AS registrados,
			(SELECT COUNT(u_id) FROM users WHERE u_status = \'1\') AS activos,
			(SELECT COUNT(u_id) FROM users WHERE u_status = \'2\') AS inactivos,
			(SELECT COUNT(u_id) FROM users WHERE u_status = \'3\') AS baneados
		');
		$data['users'] = $query['users']->fetch_assoc();
		
		// USUARIOS
		$data['users_x_dia'] = round($data['users']['registrados']/$data['dias_online']);
		$data['users_x_semana'] = round($data['users']['registrados']/($data['dias_online']/7));
		$data['users_x_mes'] = round($data['users']['registrados']/(($data['dias_online']/7)/4));
		$date = $this->setTime(1);
		$data['users_hoy'] = $mysqli->query('SELECT u_id FROM users WHERE u_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(2);
		$data['users_ayer'] = $mysqli->query('SELECT u_id FROM users WHERE u_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(3);
		$data['users_semana'] = $mysqli->query('SELECT u_id FROM users WHERE u_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(4);
		$data['users_mes'] = $mysqli->query('SELECT u_id FROM users WHERE u_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$data['users_act_xciento'] = $this->xciento($data['users']['activos'], $data['users']['registrados']);
		$data['users_inact_xciento'] = $this->xciento($data['users']['inactivos'], $data['users']['registrados']);
		$data['users_ban_xciento'] = $this->xciento($data['users']['baneados'], $data['users']['registrados']);
		
		// GET POSTS
		$query['posts'] = $mysqli->query('SELECT
			(SELECT COUNT(p_id) FROM posts) AS total,
			(SELECT COUNT(p_id) FROM posts WHERE p_status = \'1\') AS activos,
			(SELECT COUNT(p_id) FROM posts WHERE p_status = \'2\') AS inactivos,
			(SELECT COUNT(p_id) FROM posts WHERE p_status = \'0\') AS eliminados
		');
		$data['posts'] = $query['posts']->fetch_assoc();
		
		$data['posts_x_dia'] = round($data['posts']['total']/$data['dias_online']);
		$data['posts_x_semana'] = round($data['posts']['total']/($data['dias_online']/7));
		$data['posts_x_mes'] = round($data['posts']['total']/(($data['dias_online']/7)/4));
		$date = $this->setTime(1);
		$data['posts_hoy'] = $mysqli->query('SELECT p_id FROM posts WHERE p_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(2);
		$data['posts_ayer'] = $mysqli->query('SELECT p_id FROM posts WHERE p_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(3);
		$data['posts_semana'] = $mysqli->query('SELECT p_id FROM posts WHERE p_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(4);
		$data['posts_mes'] = $mysqli->query('SELECT p_id FROM posts WHERE p_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$data['posts_act_xciento'] = $this->xciento($data['posts']['activos'], $data['posts']['total']);
		$data['posts_inact_xciento'] = $this->xciento($data['posts']['inactivos'], $data['posts']['total']);
		$data['posts_del_xciento'] = $this->xciento($data['posts']['eliminados'], $data['posts']['total']);
		
		// GET COMENTARIOS
		$query['com'] = $mysqli->query('SELECT
			(SELECT COUNT(c_id) FROM comments) AS total,
			(SELECT COUNT(c_id) FROM comments WHERE c_type = \'1\' OR c_type = \'2\') AS post,
			(SELECT COUNT(c_id) FROM comments WHERE c_type = \'3\' OR c_type = \'4\') AS img,
			(SELECT COUNT(c_id) FROM comments WHERE c_type = \'5\' OR c_type = \'6\') AS topic
		');
		$data['com'] = $query['com']->fetch_assoc();
		
		$data['com_x_dia'] = round($data['com']['total']/$data['dias_online']);
		$data['com_x_semana'] = round($data['com']['total']/($data['dias_online']/7));
		$data['com_x_mes'] = round($data['com']['total']/(($data['dias_online']/7)/4));
		$date = $this->setTime(1);
		$data['com_hoy'] = $mysqli->query('SELECT c_id FROM comments WHERE c_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(2);
		$data['com_ayer'] = $mysqli->query('SELECT c_id FROM comments WHERE c_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(3);
		$data['com_semana'] = $mysqli->query('SELECT c_id FROM comments WHERE c_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$date = $this->setTime(4);
		$data['com_mes'] = $mysqli->query('SELECT c_id FROM comments WHERE c_date BETWEEN \''.$date['start'].'\' AND \''.$date['end'].'\'')->num_rows;
		$data['com_post_xciento'] = $this->xciento($data['com']['post'], $data['com']['total']);
		$data['com_img_xciento'] = $this->xciento($data['com']['img'], $data['com']['total']);
		$data['com_topic_xciento'] = $this->xciento($data['com']['topic'], $data['com']['total']);
		
		// IMPRIMIR RESULTADO
		return $data;
	}
	
	function get_dias_online(){
		global $mysqli;
		$query['admin'] = $mysqli->query('SELECT u_date FROM users WHERE u_id = \'1\' LIMIT 1');
		$data['admin'] = $query['admin']->fetch_assoc();
		
		$ano_1 = strftime('%Y', $data['admin']['u_date']);
		$mes_1 = strftime('%m', $data['admin']['u_date']);
		$dia_1 = strftime('%d', $data['admin']['u_date']);

		$ano_2 = date('Y');
		$mes_2 = date('m');
		$dia_2 = date('d');

		$timestamp_1 = mktime(0,0,0,$mes_1,$dia_1,$ano_1);
		$timestamp_2 = mktime(4,12,0,$mes_2,$dia_2,$ano_2);
		
		$segundos_diferencia = $timestamp_1 - $timestamp_2; 

		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24);
		$dias_diferencia = abs($dias_diferencia);
		$dias_diferencia = floor($dias_diferencia);
		return $dias_diferencia;
	}
	
	function setTime($fecha){
		$tiempo = time();
		$dia = date('d',$tiempo);
		$hora = date('G',$tiempo);
		$min = date('i',$tiempo);
		$seg = date('s',$tiempo);
		$resta = $this->setSegs($hora, 'hor') + $this->setSegs($min, 'min') + $seg;
		switch($fecha){
			case 1: 
				$data['start'] = $tiempo - $resta;
				$data['end'] = $tiempo;
			break;
			case 2: 
				$restaDos = $resta + $this->setSegs(1,'dia') + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
			break;
			case 3: 
				$restaDos = $resta + $this->setSegs(1,'sem')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
			break;
			case 4: 
				$restaDos = $resta + $this->setSegs(1,'mes')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
			break;
			case 5: 
				$data['start'] = 0;
				$data['end'] = $tiempo;
			break;
			case 6: 
				$restaDos = $resta + $this->setSegs(1,'ano')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
			break;
		}
		return $data;
	}
	
	function setSegs($tiempo, $tipo){
		switch($tipo){
			case 'min' :
				$segundos = $tiempo * 60;
			break;
			case 'hor' :
				$segundos = $tiempo * 3600;
			break;
			case 'dia' :
				$segundos = $tiempo * 86400;
			break;
			case 'sem' :
				$segundos = $tiempo * 604800;
			break;
			case 'mes' :
				$segundos = $tiempo * 2592000;
			break;
			case 'ano' :
				$segundos = $tiempo * 31104000;
			break;

		}
		return $segundos;
	}
	
	function xciento($num, $total, $sep = 1){
		$result = ($num*100)/$total;
		if($sep) return round($result, $sep);
		else return ceil($result);
	}
	
	/* PARA LA V2 :P
	function list_files($directory = '.'){

		  $MyDirectory = opendir($directory) or die('Error');
			while($Entry = @readdir($MyDirectory)) {
				if(is_dir($directory.'/'.$Entry) && $Entry != '.' && $Entry != '..') {
								 $data['dir'][]  = $Entry;
				}
				else if($Entry != '.' && $Entry != '..') {
					 $data['fil'][]  = $Entry;
				}
			}
		  closedir($MyDirectory);
		  return $data;

	}
	*/

}
?>