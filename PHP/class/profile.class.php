<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&iacute;');
class profile{
	function get($nick){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT s.*, ac.*, u.u_id, u.u_nick, u.u_date, u.u_sex, u.u_last_avatar, u.u_country, u.u_status, u.u_last_active, u.u_last_ip, r.r_name, r.r_image, r.r_color FROM users AS u LEFT JOIN users_ranks AS r ON r.r_id = u.u_rank LEFT JOIN users_stats AS s ON u.u_id = s.u_id LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id WHERE LOWER(u.u_nick) = \''.strtolower($nick).'\' LIMIT 1');
		$data = $query->fetch_assoc();
		if($data){
			require_once'PHP/libs/datos.php';
			$data['u_register'] = array(date('d', $data['u_date']), $time_data['meces'][date('M', $data['u_date'])], date('Y', $data['u_date']));
			if(date('d', $data['u_last_active']) == date('d') && date('M', $data['u_last_active']) == date('M') && date('Y', $data['u_last_active']) == date('Y')){
				$data['last_active'] = 'Hoy, '.date('g:s A', $data['u_last_active']);
			}else{
				if(date('Y') != date('Y', $data['u_last_active'])) $complement = ' de '.date('Y', $data['u_last_active']);
				$data['last_active'] = date('d', $data['u_last_active']).' de '.$time_data['meces'][date('M', $data['u_last_active'])].$complement.' a las '.date('g:s A', $data['u_last_active']);
			}
			$data['u_country_name'] = $array_data['paises'][$data['u_country']];
			$data['u_medals'] = $mysqli->query('SELECT ma_id FROM admin_medals_assign WHERE ma_user = \''.$data['u_id'].'\'')->num_rows;
			// BLOQUEADO?
			if($data['u_id'] != $user->uid){
				$query_block = $mysqli->query('SELECT b_id FROM users_blocks WHERE b_user = \''.$user->uid.'\' AND b_to_user = \''.$data['u_id'].'\' LIMIT 1');
				if($query_block->num_rows) $data['is_block'] = true;
			}
		}
		return $data;
	}
	
	function get_state($state_id){
		global $mysqli, $user;
		$query = $mysqli->query('SELECT s.*, u.u_nick, u.u_id, u.u_last_avatar FROM states AS s LEFT JOIN users AS u ON u.u_id = s.s_user WHERE s.s_id = \''.$state_id.'\' LIMIT 1');
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		$row = $query->fetch_assoc();
		$data = $row;
		$query_like = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'8\' AND v_type_id = \''.$row['s_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
		$data_like = $query_like->fetch_assoc();
		$data['s_body'] = $bbcode->smiles($row['s_body']);
		if(!empty($data_like)) $data['like'] = 1;
		if($row['s_comments']){
			$i = 0;
			$query_c = $mysqli->query('SELECT c.*, u.u_nick, u.u_id, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c_type = \'8\' AND c.c_type_id = \''.$row['s_id'].'\' ORDER BY c.c_id ASC LIMIT 30');
			while($row2 = $query_c->fetch_assoc()){
				$query_like_c[$i] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'7\' AND v_type_id = \''.$row2['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
				$data_like_c[$i] = $query_like_c[$i]->fetch_assoc();
				$data['comments'][$i] = $row2;
				$data['comments'][$i]['c_body'] = $bbcode->smiles($row2['c_body']);
				if(!empty($data_like_c[$i])) $data['comments'][$i]['like'] = 1;
				$i++;
			}
		}
		return $data;
	}
	
	function states($uid, $start = 0, $limit = 15){
		global $mysqli, $user;
		$start = $start * $limit;
		$uid = empty($_POST['uid']) ? $uid : intval($_POST['uid']);
		$query = $mysqli->query('SELECT s.*, u.u_nick, u.u_id, u.u_last_avatar FROM states AS s LEFT JOIN users AS u ON u.u_id = s.s_user WHERE s.s_to_user = \''.$uid.'\' ORDER BY s.s_id DESC LIMIT '.$start.', '.$limit);
		$i = 0;
		require_once'PHP/libs/bbcode.inc.php';
		$bbcode = new bbcode;
		while($row = $query->fetch_assoc()){
			$data[$i] = $row;
			$query_like = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'8\' AND v_type_id = \''.$row['s_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
			$data_like = $query_like->fetch_assoc();
			$data[$i]['s_body'] = $bbcode->smiles($row['s_body']);
			if(!empty($data_like)) $data[$i]['like'] = 1;
			if($row['s_comments']){
				$ic[$i] = 0;
				$query_c = $mysqli->query('SELECT c.*, u.u_nick, u.u_id, u.u_last_avatar FROM comments AS c LEFT JOIN users AS u ON u.u_id = c.c_user WHERE c_type = \'8\' AND c.c_type_id = \''.$row['s_id'].'\' ORDER BY c.c_id ASC LIMIT 2');
				while($row2 = $query_c->fetch_assoc()){
					$query_like_c[$ic[$i]] = $mysqli->query('SELECT v_id FROM votes WHERE v_type = \'7\' AND v_type_id = \''.$row2['c_id'].'\' AND v_user = \''.$user->uid.'\' LIMIT 1');
					$data_like_c[$ic[$i]] = $query_like_c[$ic[$i]]->fetch_assoc();
					$data[$i]['comments'][$ic[$i]] = $row2;
					$data[$i]['comments'][$ic[$i]]['c_body'] = $bbcode->smiles($row2['c_body']);
					if(!empty($data_like_c[$ic[$i]])) $data[$i]['comments'][$ic[$i]]['like'] = 1;
					$ic[$i]++;
				}
			}
			$i++;
		}
		return $data;
	}
	
	function medals($uid, $start = 0, $limit = 18){
		global $mysqli, $user;
		$uid = empty($_POST['uid']) ? $uid : intval($_POST['uid']);
		$query = $mysqli->query('SELECT m.m_title, m.m_desc, m.m_image, m.m_date FROM admin_medals_assign AS ma LEFT JOIN admin_medals AS m ON ma.m_id = m.m_id WHERE ma.ma_user = \''.$uid.'\' ORDER BY ma.ma_id DESC LIMIT '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function followers($uid, $start = 0, $limit = 18){
		global $mysqli, $user;
		$uid = empty($_POST['uid']) ? $uid : intval($_POST['uid']);
		$query = $mysqli->query('SELECT f.*, u.u_nick, u.u_id, u.u_last_avatar FROM follows AS f LEFT JOIN users AS u ON u.u_id = f.f_user WHERE f.f_type_id = \''.$uid.'\' AND f.f_type = \'1\' ORDER BY f.f_date DESC LIMIT '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function following($uid, $start = 0, $limit = 18){
		global $mysqli, $user;
		$uid = empty($_POST['uid']) ? $uid : intval($_POST['uid']);
		$query = $mysqli->query('SELECT f.*, u.u_nick, u.u_id, u.u_last_avatar FROM follows AS f LEFT JOIN users AS u ON u.u_id = f.f_type_id WHERE f.f_user = \''.$uid.'\' AND f.f_type = \'1\' ORDER BY f.f_date DESC LIMIT '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_info($uid){
		global $mysqli;
		$query = $mysqli->query('SELECT u_nick FROM users WHERE u_id = \''.$uid.'\' LIMIT 1');
		$data = $query->fetch_assoc();
		$result = $this->get($data['u_nick']);
		return $result;
	}
	
	function get_posts($uid, $start = 0, $limit = 18){
		global $mysqli, $web;
		$order = secure($_POST['order']);
		$orders = array('puntos', 'comments', 'hits', 'date');
		if(!in_array($order, $orders)) $order = 'date';
		$start = $start * $limit;
		$query = $mysqli->query('SELECT p.p_id, p.p_title, p.p_puntos, p.p_date, c.c_seo, c.c_name, c.c_img FROM posts AS p LEFT JOIN posts_cats AS c ON c.c_id = p.p_cat WHERE p.p_user = \''.intval($uid).'\' AND p.p_status = \'1\' ORDER BY p.p_'.$order.' DESC LIMIT '.$start.', '.$limit);
		$i = 0;
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_topics($uid, $start = 0, $limit = 18){
		global $mysqli, $web;
		$order = secure($_POST['order']);
		$orders = array('comments', 'hits', 'date');
		if(!in_array($order, $orders)) $order = 'date';
		$start = $start * $limit;
		$query = $mysqli->query('SELECT t.*, co.*, ca.*, u.u_id, u.u_nick, u.u_last_avatar FROM comus_topics AS t LEFT JOIN comus AS co ON co.comu_id = t.t_comu LEFT JOIN comus_cats AS ca ON ca.c_id = co.comu_cat LEFT JOIN users AS u ON u.u_id = t.t_user WHERE t.t_user = \''.intval($uid).'\' AND t.t_status = \'1\' ORDER BY t.t_'.$order.' DESC LIMIT '.$start.', '.$limit);
		$i = 0;
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_images($uid, $start = 0, $limit = 10){
		global $mysqli, $web;
		$order = secure($_POST['order']);
		$orders = array('comments', 'hits', 'date');
		if(!in_array($order, $orders)) $order = 'date';
		$start = $start * $limit;
		$query = $mysqli->query('SELECT i.i_id, i.i_title, i.i_description, i.i_date, u.u_nick FROM images AS i LEFT JOIN users AS u ON u.u_id = i.i_user WHERE i.i_user = \''.intval($uid).'\' AND i.i_status = \'1\' ORDER BY i.i_'.$order.' DESC LIMIT '.$start.', '.$limit);
		$i = 0;
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_follows($uid, $start = 0, $limit = 18){
		global $mysqli, $user;
		$start = $start * $limit;
		$query = $mysqli->query('SELECT f.*, u.u_nick, u.u_id, u.u_last_avatar, u.u_country, ac.u_bio FROM follows AS f LEFT JOIN users AS u ON u.u_id = f.f_user LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id WHERE f.f_type_id = \''.$uid.'\' AND f.f_type = \'1\' ORDER BY f.f_date DESC LIMIT '.$start.', '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_following($uid, $start = 0, $limit = 18){
		global $mysqli, $user;
		$start = $start * $limit;
		$query = $mysqli->query('SELECT f.*, u.u_nick, u.u_id, u.u_last_avatar, u.u_country, ac.u_bio FROM follows AS f LEFT JOIN users AS u ON u.u_id = f.f_type_id LEFT JOIN users_accounts AS ac ON ac.u_id = u.u_id WHERE f.f_user = \''.$uid.'\' AND f.f_type = \'1\' ORDER BY f.f_date DESC LIMIT '.$start.', '.$limit);
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
	
	function get_comus($uid, $start = 0, $limit = 18){
		global $mysqli, $web;
		$start = $start * $limit;
		// SQL PRINCIPAL
		$query = $mysqli->query('SELECT co.comu_id, co.comu_name, co.comu_seo, co.comu_rank, co.comu_last_image, c.c_name, r.r_name FROM comus_members AS m LEFT JOIN comus AS co ON co.comu_id = m.m_comu LEFT JOIN comus_cats AS c ON c.c_id = co.comu_cat LEFT JOIN comus_ranks AS r ON r.r_id = m.m_rank WHERE m.m_user = \''.$uid.'\' AND m.m_status = \'1\' ORDER BY m.m_date DESC LIMIT '.$start.', '.$limit) or die($mysqli->error);
		$i = 0;
		while($row = $query->fetch_assoc()) $data[] = $row;
		return $data;
	}
}
?>