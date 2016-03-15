<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class mod{
	
	// PAGINACION
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
	
	// GLOBAL DATA
	function global_data(){
		global $mysqli;
		// USERS
		$data['usuarios_suspendidos'] = $mysqli->query('SELECT ub_id FROM users_bans')->num_rows;
		$data['usuarios_reportados'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'5\'')->num_rows;
		// POSTS
		$data['posts_aprobar'] = $mysqli->query('SELECT p_id FROM posts WHERE p_status = \'2\'')->num_rows;
		$data['posts_eliminados'] = $mysqli->query('SELECT p_id FROM posts WHERE p_status = \'0\'')->num_rows;
		$data['posts_reportados'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'1\'')->num_rows;
		// IMGS
		$data['imagenes_eliminadas'] = $mysqli->query('SELECT i_id FROM images WHERE i_status = \'0\'')->num_rows;
		$data['imagenes_reportadas'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'2\'')->num_rows;
		// COMUS
		$data['comus_suspendidas'] = $mysqli->query('SELECT comu_id FROM comus WHERE comu_status = \'0\'')->num_rows;
		$data['comus_reportadas'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'6\'')->num_rows;
		// TEMAS
		$data['temas_eliminados'] = $mysqli->query('SELECT t_id FROM comus_topics WHERE t_status = \'0\'')->num_rows;
		$data['temas_reportados'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'3\'')->num_rows;
		// MPS
		$data['mensajes_reportados'] = $mysqli->query('SELECT r_id FROM reports WHERE r_type = \'4\'')->num_rows;
		// RETORNO
		return $data;
	}
	
	// INSERTAR ACCESO
	function set_access(){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT a_id, a_user FROM mod_access ORDER BY a_id DESC LIMIT 1');
		$data = $query->fetch_assoc();
		if($data['a_user'] == $user->uid){
			$mysqli->query('UPDATE mod_access SET a_date = \''.time().'\' WHERE a_id = \''.$data['a_id'].'\' LIMIT 1');
			return;
		}
		$ip = $_SERVER['X_FORWARDED_FOR'] ? $_SERVER['X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
		$mysqli->query('INSERT INTO mod_access (a_ip, a_user, a_date) VALUES (\''.$ip.'\', \''.$user->uid.'\', \''.time().'\')');
		
		// BORRAMOS ACCESOS ANTIGUOS
		$limit_del = $data['a_id']-9;
		$mysqli->query('DELETE FROM mod_access WHERE a_id < \''.$limit_del.'\'');
	}
	
	// OBTENER ACCESOS
	function get_access(){
		global $mysqli;
		$query = $mysqli->query('SELECT a.a_ip, a.a_user, a.a_date, u.u_nick FROM mod_access AS a LEFT JOIN users AS u ON u.u_id = a.a_user ORDER BY a.a_id DESC LIMIT 10');
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	// OBTENER MODERADORES
	function get_mods(){
		global $mysqli;
		$query = $mysqli->query('SELECT r_id, r_permits FROM users_ranks');
		while($row = $query->fetch_assoc()){
			$row['p'] = unserialize($row['r_permits']);
			if($row['p']['gomod']){
				$query_users = $mysqli->query('SELECT u_nick FROM users WHERE u_rank = \''.$row['r_id'].'\'');
				while($data = $query_users->fetch_assoc()) $result[] = $data;
			}
		}
		return $result;
	}
	
	function set_unban(){
		global $mysqli;
		$query = $mysqli->query('SELECT ub_user FROM users_bans WHERE ub_end > \'0\' AND ub_end < \''.time().'\' ORDER BY RAND() LIMIT 150');
		while($row = $query->fetch_assoc()){
			$mysqli->query('UPDATE users SET u_status = \'1\' WHERE u_id = \''.$row['ub_user'].'\' LIMIT 1');
			$mysqli->query('DELETE FROM users_bans WHERE ub_user = \''.$row['ub_user'].'\' LIMIT 1');
		}
		
		$query_c = $mysqli->query('SELECT b_id, b_user, b_comu FROM comus_bans WHERE b_end > \'0\' AND b_end < \''.time().'\' ORDER BY RAND() LIMIT 150');
		while($row = $query_c->fetch_assoc()){
			$mysqli->query('UPDATE comus_members SET m_status = \'1\' WHERE m_user = \''.$row['b_user'].'\' AND m_comu = \''.$row['b_comu'].'\' LIMIT 1');
			$mysqli->query('DELETE FROM comus_bans WHERE b_id = \''.$row['b_id'].'\' LIMIT 1');
		}
	}
	
	// USUARIOS SUSPENDIDOS
	function usuarios_suspendidos(){
		global $mysqli;
		
		// UNBAN
		$this->set_unban();
		
		// PAGINACION
		$web['max_users'] = 50;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_users'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_user = 'WHERE u.u_nick LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT b.ub_mod, b.ub_reason, b.ub_date, b.ub_end, u.u_id, u.u_nick FROM users_bans AS b LEFT JOIN users AS u ON u.u_id = b.ub_user '.$w_user.' ORDER BY b.ub_id DESC LIMIT '.$inicio.', '.$web['max_users']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT b.ub_id FROM users_bans AS b LEFT JOIN users AS u ON u.u_id = b.ub_user '.$w_user.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_users'], '/mod?do=usuarios_suspendidos&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// USUARIOS REPORTADOS
	function usuarios_reportados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_users'] = 50;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_users'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_user = 'AND u.u_nick LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_user, r.r_date, u.u_id, u.u_nick, u.u_status FROM reports AS r LEFT JOIN users AS u ON u.u_id = r.r_type_id WHERE r.r_type = \'5\' '.$w_user.' ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_users']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT r.r_id FROM reports AS r LEFT JOIN users AS u ON u.u_id = r.r_type_id  WHERE r.r_type = \'5\' '.$w_user.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_users'], '/mod?do=usuarios_reportados&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// BORRAR REPORTE
	function del_report($r_id){
		global $mysqli;
		$mysqli->query('DELETE FROM reports WHERE r_id = \''.$r_id.'\' LIMIT 1');
		return '1: ';
	}
	
	// POSTS X APROBAR
	function posts_aprobar(){
		global $mysqli;
		
		// PAGINACION
		$web['max_posts'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND p.p_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT p.p_id, p.p_title, p.p_user, p.p_date, u.u_id, u.u_nick, c.c_seo, c.c_img, c.c_name FROM posts AS p LEFT JOIN users AS u ON u.u_id = p.p_user LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE p.p_status = \'2\' '.$w_title.' ORDER BY p.p_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT p_id FROM posts AS p WHERE p.p_status = \'2\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/mod?do=posts_aprobar&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// POSTS ELIMINADOS
	function posts_eliminados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_posts'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND p.p_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT p.p_id, p.p_title, p.p_user, p.p_date, u.u_id, u.u_nick, c.c_seo, c.c_img, c.c_name FROM posts AS p LEFT JOIN users AS u ON u.u_id = p.p_user LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE p.p_status = \'0\' '.$w_title.' ORDER BY p.p_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT p_id FROM posts AS p WHERE p.p_status = \'0\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/mod?do=posts_eliminados&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// POSTS REPORTADOS
	function posts_reportados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_posts'] = 50;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_post = 'AND p.p_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_date, u.u_id, u.u_nick, p.p_id, p.p_title, p.p_user, p.p_date, p.p_status, c.c_seo, c.c_img, c.c_name FROM reports AS r LEFT JOIN posts AS p ON p.p_id = r.r_type_id LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat LEFT JOIN users AS u ON u.u_id = r.r_user WHERE r.r_type = \'1\' '.$w_post.' ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT r.r_id FROM reports AS r LEFT JOIN posts AS p ON p.p_id = r.r_type_id  WHERE r.r_type = \'1\' '.$w_post.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/mod?do=posts_reportados&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// IMAGENES ELIMINADAS
	function imagenes_eliminadas(){
		global $mysqli;
		
		// PAGINACION
		$web['max_images'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_images'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND i.i_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT i.i_id, i.i_title, i.i_user, i.i_date, u.u_id, u.u_nick FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user WHERE i.i_status = \'0\' '.$w_title.' ORDER BY i.i_id DESC LIMIT '.$inicio.', '.$web['max_images']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT i_id FROM images AS i WHERE i.i_status = \'0\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_images'], '/mod?do=imagenes_eliminadas&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// IMAGENES REPORTADAS
	function imagenes_reportadas(){
		global $mysqli;
		
		// PAGINACION
		$web['max_images'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_images'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND i.i_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_date, u.u_id, u.u_nick, i.i_id, i.i_title, i.i_user, i.i_date, i.i_status FROM reports AS r LEFT JOIN images AS i ON i.i_id = r.r_type_id LEFT JOIN users AS u ON u.u_id = r.r_user WHERE r.r_type = \'2\' '.$w_title.' ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_images']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT r.r_id FROM reports AS r LEFT JOIN images AS i ON i.i_id = r.r_type_id  WHERE r.r_type = \'2\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_images'], '/mod?do=imagenes_reportadas&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// COMUNIDADES SUSPENDIDAS
	function comus_suspendidas(){
		global $mysqli;
		
		// PAGINACION
		$web['max_comus'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_comus'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_comu = 'AND co.comu_name LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT co.comu_seo, co.comu_id, co.comu_name, co.comu_date, c.c_img, c.c_name, u.u_id, u.u_nick FROM comus AS co LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = co.comu_admin WHERE co.comu_status = \'0\' '.$w_comu.' ORDER BY co.comu_date DESC LIMIT '.$inicio.', '.$web['max_comus']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT co.comu_id FROM comus AS co WHERE co.comu_status = \'0\' '.$w_comu.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_comus'], '/mod?do=comus_suspendidas&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// COMUNIDADES REPORTADAS
	function comus_reportadas(){
		global $mysqli;
		
		// PAGINACION
		$web['max_comus'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_comus'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_comu = 'AND co.comu_name LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_user, r.r_date, co.comu_seo, co.comu_id, co.comu_name, co.comu_date, co.comu_status, c.c_img, c.c_name, u.u_id, u.u_nick FROM reports AS r LEFT JOIN comus AS co ON co.comu_id = r.r_type_id LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = co.comu_admin WHERE r.r_type = \'6\' '.$w_comu.' ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_comus']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT r.r_id FROM reports AS r LEFT JOIN comus AS co ON co.comu_id = r.r_type_id  WHERE r.r_type = \'6\' '.$w_comu.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_comus'], '/mod?do=comus_reportadas&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
    
    // TEMAS ELIMINADOS
	function temas_eliminados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_posts'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND t.t_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT t.t_id, t.t_title, t.t_user, t.t_date, u.u_id, u.u_nick, co.comu_seo FROM comus_topics AS t LEFT JOIN users AS u ON u.u_id = t.t_user LEFT JOIN comus AS co ON co.comu_id = t.t_comu WHERE t.t_status = \'0\' '.$w_title.' ORDER BY t.t_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT t_id FROM comus_topics AS t WHEREt.t_status = \'0\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/mod?do=temas_eliminados&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// TEMAS REPORTADOS
	function temas_reportados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_posts'] = 50;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_posts'];
		
		// BUSCADOR
		$search = secure($_GET['qu']);
		if($search) $w_title = 'AND t.t_title LIKE \'%'.$search.'%\'';
		
		// CONSULTA
		$sql['list'] = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_date, u.u_id, u.u_nick, t.t_id, t.t_title, t.t_user, t.t_date, t.t_status, co.comu_seo FROM reports AS r LEFT JOIN comus_topics AS t ON t.t_id = r.r_type_id LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN users AS u ON u.u_id = r.r_user WHERE r.r_type = \'3\' '.$w_title.' ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_posts']);
		while($row = $sql['list']->fetch_assoc()) $data['list'][] = $row;
		$sql['total'] = $mysqli->query('SELECT r.r_id FROM reports AS r LEFT JOIN comus_topics AS t ON t.t_id = r.r_type_id  WHERE r.r_type = \'3\' '.$w_title.'');
		$data['pages'] = $this->pag($page, $sql['total']->num_rows, $web['max_posts'], '/mod?do=posts_reportados&'.($search ? '&qu='.$search.'&' : '').'');
		
		// RESULTADO
		return $data;
	}
	
	// MENSAJES REPORTADOS
	function mensajes_reportados(){
		global $mysqli;
		
		// PAGINACION
		$web['max_mps'] = 20;
		$page = intval($_GET['page']);
		if(empty($page)){
			$inicio = 0;
			$page = 1;
		}else $inicio = ($page - 1) * $web['max_mps'];
		$query = $mysqli->query('SELECT r.r_id, r.r_reason, r.r_date, m.mp_subject, m.mp_id, m.mp_user, m.mp_to, m.mp_date, u.u_nick, u.u_status, sub.* FROM(SELECT rp_body, rp_id, rp_view, rp_user, rp_date, rp_read, mp_id FROM mps_replies ORDER BY rp_id ASC)sub LEFT JOIN mps AS m ON m.mp_id = sub.mp_id LEFT JOIN reports AS r ON r.r_type_id = m.mp_id LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE r.r_type = \'4\' GROUP BY r.r_id ORDER BY r.r_id DESC LIMIT '.$inicio.', '.$web['max_mps']);
		$i = 0;
		while($row = $query->fetch_assoc()){
			$data['list'][$i] = $row;
			$data['list'][$i]['rp_body'] = get_meta_description($row['rp_body']);
			$i++;
		}
		$query_total = $mysqli->query('SELECT r.r_id FROM reports AS r WHERE r.r_type = \'4\'');
		$data['pages'] = $this->pag($page, $query_total->num_rows, $web['max_mps'], '/mod?do=mensajes_reportados');
		
		return $data;
	}
	
	function read_mp($mp_id){
		global $mysqli;
		
		// ESTA REPORTADO
		$query_report = $mysqli->query('SELECT r.r_id FROM reports AS r WHERE r.r_type = \'4\' AND r.r_type_id = \''.$mp_id.'\'');
		if(empty($query_report->num_rows)) return '0: Este mensaje no se encuentra reportado';
		
		// SELECCIONAR MENSAJE
		$query = $mysqli->query('SELECT m.mp_id, m.mp_user, m.mp_to, m.mp_del_to, m.mp_del_from, m.mp_subject, m.mp_date, u.u_nick, u.u_id, u.u_last_avatar FROM mps AS m LEFT JOIN users AS u ON u.u_id = m.mp_user WHERE m.mp_id = \''.$mp_id.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if(empty($query->num_rows)) return '0: Este mensaje no existe o no te pertenece';
		
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
	
}
?>