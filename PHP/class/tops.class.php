<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class tops{

	function posts_cats(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM posts_cats AS c ORDER BY c.c_name ASC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function comus_cats(){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM comus_cats AS c ORDER BY c.c_name ASC');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}

	function get_users($date, $type){
		$data = $this->users($this->setTime($date), $type);
		return $data;
	}
	
	function get_comus($date, $type){
		$data = $this->comus($this->setTime($date), $type);
		return $data;
	}
	
	function get_posts($date, $type){
		$data = $this->posts($this->setTime($date), $type);
		return $data;
	}
	
	function posts($date, $type){
		global $mysqli;
		switch($type){
			case 'favoritos':
				$p_order = 'p.p_favs';
			break;
			case 'seguidores':
				$p_order = 'p.p_follows';
			break;
			case 'comentarios':
				$p_order = 'p.p_comments';
			break;
			default:
				$p_order = 'p.p_puntos';
			break;
		}
		$cat = intval($_GET['cat']);
		if($cat){
			$q_cat = $mysqli->query('SELECT c_id FROM posts_cats WHERE c_id = \''.$cat.'\' LIMIT 1');
			if($q_cat->num_rows) $w_cat = 'AND c.c_id = \''.$cat.'\'';
		}
		$query = $mysqli->query('SELECT c.c_seo, c.c_img, p.p_id, p.p_puntos, p_favs, p.p_follows, p.p_comments, p.p_title FROM posts AS p LEFT JOIN posts_cats AS c ON p.p_cat = c.c_id WHERE p.p_status = \'1\' AND p.p_date > '.$date['start'].' && p.p_date < '.$date['end'].' '.$w_cat.' ORDER BY '.$p_order.' DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function users($date, $type){
		global $mysqli;
		if($date['start'] == 0 && !$type){
			$query = $mysqli->query('SELECT u.u_nick, s.u_points AS total FROM users_stats AS s LEFT JOIN users AS u ON u.u_id = s.u_id ORDER BY s.u_points DESC LIMIT 10');
		}else{
			switch($type){
				case 'seguidores':
					$query = $mysqli->query('SELECT COUNT(f.f_type) AS total, u.u_id, u.u_nick, u.u_last_avatar FROM follows AS f LEFT JOIN users AS u ON u.u_id = f.f_type_id WHERE f.f_type = \'1\' AND f.f_date > '.$date['start'].' AND f.f_date < '.$date['end'].' GROUP BY u.u_id ORDER BY total DESC LIMIT 10');
				break;
				case 'comentarios':
					$query = $mysqli->query('SELECT COUNT(c.c_id) AS total, u.u_id, u.u_nick, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c.c_date > '.$date['start'].' AND c.c_date < '.$date['end'].' AND (c.c_type = \'1\' OR c.c_type = \'2\') GROUP BY u.u_id ORDER BY total DESC LIMIT 10');
				break;
				case 'posts':
					$query = $mysqli->query('SELECT COUNT(p.p_id) AS total, u.u_id, u.u_nick, u.u_last_avatar FROM posts AS p LEFT JOIN users AS u ON u.u_id = p.p_user WHERE p.p_status = \'1\' AND p.p_date > '.$date['start'].' AND p.p_date < '.$date['end'].' GROUP BY p.p_user ORDER BY total DESC LIMIT 10');
				break;
				default:
					$query = $mysqli->query('SELECT SUM(p.p_puntos) AS total, u.u_id, u.u_nick, u.u_last_avatar FROM posts AS p LEFT JOIN users_stats AS s ON s.u_id = p.p_user LEFT JOIN users AS u ON u.u_id = s.u_id WHERE p.p_status = \'1\' AND p.p_date > '.$date['start'].' AND p.p_date < '.$date['end'].' GROUP BY p.p_user ORDER BY total DESC LIMIT 10');
				break;
			}
		}
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function comus($date, $type){
		global $mysqli;
		$cat = intval($_GET['cat']);
		if($cat){
			$q_cat = $mysqli->query('SELECT c_id FROM comus_cats WHERE c_id = \''.$cat.'\' LIMIT 1');
			if($q_cat->num_rows) $w_cat = 'AND co.comu_cat = \''.$cat.'\'';
		}
		switch($type){
			case 'seguidores':
				$query = $mysqli->query('SELECT COUNT(f.f_type) AS total, co.comu_id, co.comu_name, co.comu_seo, co.comu_last_image, c.c_name, c.c_img FROM follows AS f LEFT JOIN comus AS co ON co.comu_id = f.f_type_id LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat WHERE co.comu_status = \'1\' AND f.f_type = \'4\' AND f.f_date > '.$date['start'].' AND f.f_date < '.$date['end'].' '.$w_cat.' GROUP BY co.comu_id ORDER BY total DESC LIMIT 10');
			break;
			case 'temas':
				$query = $mysqli->query('SELECT COUNT(t.t_id) AS total, co.comu_id, co.comu_name, co.comu_seo, co.comu_last_image, c.c_name, c.c_img FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat WHERE co.comu_status = \'1\' AND t.t_status = \'1\' AND t.t_date > '.$date['start'].' AND t.t_date < '.$date['end'].' '.$w_cat.' GROUP BY co.comu_id ORDER BY total DESC LIMIT 10');
			break;
			default:
				$query = $mysqli->query('SELECT COUNT(m.m_id) AS total, co.comu_id, co.comu_name, co.comu_seo, co.comu_last_image, c.c_name, c.c_img FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat WHERE co.comu_status = \'1\' AND m.m_date > '.$date['start'].' AND m.m_date < '.$date['end'].' '.$w_cat.' GROUP BY co.comu_id ORDER BY total DESC LIMIT 10');
			break;
		}
		while($row = $query->fetch_assoc()) $result[] = $row;
		return $result;
	}
	
	function setTime($fecha){
		$tiempo = time();
		$dia = date("d",$tiempo);
		$hora = date("G",$tiempo);
		$min = date("i",$tiempo);
		$seg = date("s",$tiempo);
		$resta = $this->setSegs($hora, 'hor') + $this->setSegs($min, 'min') + $seg;
		switch($fecha){
			// HOY
			case 1: 
				//
				$data['start'] = $tiempo - $resta;
				$data['end'] = $tiempo;
				//
			break;
			// AYER
			case 2: 
				//
				$restaDos = $resta + $this->setSegs(1,'dia') + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// SEMANA
			case 3: 
				//
				$restaDos = $resta + $this->setSegs(1,'sem')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// MES
			case 4: 
				//
				$restaDos = $resta + $this->setSegs(1,'mes')  + $this->setSegs(1,'hor');
				$data['start'] = $tiempo - $restaDos;
				$data['end'] = $tiempo - $resta;
				//
			break;
			// TODO EL TIEMPO
			case 5: 
				//
				$data['start'] = 0;
				$data['end'] = $tiempo;
				//
			break;
		}
		//
		return $data;
	}

	function setSegs($tiempo, $tipo){
		//
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

		}
		//
		return $segundos;
	}
	
}
?>