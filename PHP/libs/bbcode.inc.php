<?php
if(!defined('UNTARGETED')) die('Lo que buscas no se encuentra por aqu&acute;');
class bbcode{
	function start($text, $smiles = true, $code_in = false, $title){
		global $mysqli;
		$text = $this->anti_xss($text);
		$text = htmlentities($text, ENT_NOQUOTES);
		$text = nl2br($text);		
		$explorar = explode('[code]', $text);
		if(count($explorar) > 1) $explorar_2 = explode('[/code]', $explorar[1]);
		
		/*if(count($explorar_2) > 1 && !$code_in){
			// IMPORTANTE: ESTA FUNCION NO ANDA AL 100%
			$text .= $this->codes($explorar[0]);
			$text .= '<pre class="text_code">'.$this->special_codes($explorar_2[0]).'</pre>';
			$text .= $this->codes($explorar_2[1]);
		}else{*/
			$text = $this->codes($text, $title);
			$text = $this->censuras($text);
			if($smiles) $text = $this->smiles($text);
		//}
		
		return $this->special_codes($text);
	}
	
	function codes($text, $title){
		global $user;
		$a = array( 
			"/(?i)\[\/(b|i|u)\]\[(b|i|u)\]/i",
			"/(?i)\[i\](.*?)\[\/i\]/i",
			"/(?i)\[b\](.*?)\[\/b\]/i",
			"/(?i)\[u\](.*?)\[\/u\]/i",
			"/(?i)\[hr\]/i",
			"/(?i)\[swf\=(.+?)\]/i",
			"/(?i)\[video\](.*?)=(.*?)\[\/video\]/i",
			"/(?i)\[align\=([a-z]+)\]([^\a]+?)\[\/align\]/i",
			"/(?i)\[size\=([0-9]{1,2})\]([^\a]+?)\[\/size\]/i",
			"/(?i)\[font\=([^\a]+?)\]([^\a]+?)\[\/font\]/i",
			"/(?i)\[color\=([\#]?[0-9a-f]{3}|[\#]?[0-9a-f]{6}|[a-z]{3,})\]([^\a]+?)\[\/color\]/i",
			"/(?i)\[quote\=([^\n\r\t\<\>]+?)\|([0-9]+?)\]([^\a]+?)\[\/quote\]/i",
			//"/(?i)\[img\](http|https|ftp|irc|ed2k|gopher|telnet)?(\:\/\/)?([^\<\>[:space:]]+)\[\/img\]/i",
			"/(?i)\[img\](.*?)\[\/img\]/i",
			"/(?i)\[img\=(.*?)\]/i", 
			"/(?i)(\[url\])(http|https|ftp|irc|ed2k|gopher|telnet)(\:\/\/)([^\<\>[:space:]]+?)(\[\/url\])/i",
			"/(?i)\[url\=(http|https|ftp|irc|ed2k|gopher|telnet|gopher|telnet)(\:\/\/)([^\<\>[:space:]]+?)\](.+?)(\[\/url\])/i",
			"/\[spoiler\](.*?)\[\/spoiler\]/i",
			"/\[code\](.*?)\[\/code\]/is"
	   ); 

	   $b = array(
			"",
			"<i>\\1</i>",
			"<b>\\1</b>",
			"<u>\\1</u>",
			"<hr />",
			"<embed width=\"640\" height=\"390\" wmode=\"transparent\" autoplay=\"false\" allownetworking=\"internal\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" quality=\"high\" src=\"\\1\"><br/>",
			"<embed width=\"640\" height=\"390\" wmode=\"transparent\" autoplay=\"false\" allownetworking=\"internal\" allowfullscreen=\"true\" type=\"application/x-shockwave-flash\" quality=\"high\" src=\"http://www.youtube.com/v/\\2\"><br />",
			"<div align=\"\\1\">\\2</div>",
			"<span style=\"font-size:\\1pt;line-height:\\1pt;\">\\2</span>",
			"<font face=\"\\1\">\\2</font>",
			"<span style=\"color: \\1;\">\\2</span>",
			"<blockquote><div class=\"cita\"><strong>\\1</strong> dijo:</div><div class=\"citacuerpo\"><p>\\3</p></div></blockquote>",
			"<img src=\"\\1\\2\\3\"".($title ? " alt=\"".$title."\"" : "")."/>",
			"<img src=\"\\1\\2\\3\" />",
			"<a href=\"\\2\\3\\4\" target=\"_blank\">\\2\\3\\4</a>",
			"<a href=\"\\1\\2\\3\" target=\"_blank\">\\4</a>",
			"<div class=\"spoiler\"><a class=\"spoiler-title\" onclick=\"spoiler($(this))\">Spoiler</a><div class=\"spoiler-body\" style=\"display:none\">\\1</div></div>",
			"<pre class=\"text_code\">\\1</pre>"
		);
		foreach($a AS $key => $val){
			while(preg_match($val, $text)){
				$text = preg_replace($val, $b[$key], $text);
			}
		}
		$tu = empty($user->nick) ? 'visitante' : $user->nick;
		$text = str_replace('[tu]', $tu, $text);
		return html_entity_decode($text, ENT_NOQUOTES);
	}
	
	function anti_xss($text){
		$a = array( 
			'@< [/!]*?[^<>]*?>@si',
			'@< ![sS]*?--[ tnr]*>@',
			'/(?i)\<script\>(.*?)\<\/script\>/i',
			'/(?i)\<script (.*?)\>(.*?)\<\/script>/i',
			'/(?i)\<style\>(.*?)\<\/style\>/i',
			'/(?i)\<style (.*?)\>(.*?)\<\/style>/i'
	   ); 

	   $b = array( 
			'',
			'',
			html_entity_decode('<script>\\1</script>'),
			html_entity_decode('<script \\1>\\2</script>'),
			html_entity_decode('<style>\\1</style>'),
			html_entity_decode('<style \\1>\\2</style>')
		);
		$text = preg_replace($a, $b, $text);
		return $text;
	}
	
	function special_codes($text){
		$text = str_replace('\\\n', '<br />', $text);
		$text = str_replace('\\n', '<br />', $text);
		$text = str_replace('\n', '<br />', $text);
		$text = str_replace('\r', '', $text);
		//$text = str_replace('\"', '"', $text);
		//$text = str_replace("\'", "'", $text);
		$lss = substr('\/', 0, 1);
		$text = str_ireplace($lss.$lss, $lss, $text);
		//$text = str_replace('	', '<span style="margin-left:40px"></span>', $text);
		return $text;
	}
	
	function censuras($text){
		global $mysqli;
		$query = $mysqli->query('SELECT c.* FROM censored AS c');
		while($row = $query->fetch_assoc()){
			if($row['c_ireplace']) $text = str_ireplace($row['c_val'], $row['c_por'], $text);
			else $text = str_replace($row['c_val'], $row['c_por'], $text);
		}
		return $text;
	}
	
	function smiles($text){
		global $web;
		$bbcode = array();
		$html = array();
        $pre = '<img src="'.$web['img'].'/smiles/';
        $end = '.gif" align="absmiddle" class="smile" />';
		$bbcode[] = ':-)'; $html[] = $pre.'1'.$end;
		$bbcode[] = ':-('; $html[] = $pre.'3'.$end;
		$bbcode[] = ':-?'; $html[] = $pre.'2'.$end;
		$bbcode[] = ':-F'; $html[] = $pre.'4'.$end;
		$bbcode[] = '8-|'; $html[] = $pre.'5'.$end;
		$bbcode[] = 'X-('; $html[] = $pre.'6'.$end;
		$bbcode[] = '^.^'; $html[] = $pre.'7'.$end;
		$bbcode[] = ':-|'; $html[] = $pre.'8'.$end;
		$bbcode[] = ':-D'; $html[] = $pre.'9'.$end;
		$bbcode[] = ':-P'; $html[] = $pre.'10'.$end;
		$bbcode[] = ';-)'; $html[] = $pre.'11'.$end;
		$bbcode[] = ':-]'; $html[] = $pre.'12'.$end;
		$bbcode[] = ':roll:'; $html[] = $pre.'13'.$end;
		$bbcode[] = ':cry:'; $html[] = $pre.'14'.$end;
        $bbcode[] = ':twisted:'; $html[] = $pre.'15'.$end;
		$bbcode[] = ':oops:'; $html[] = $pre.'16'.$end;
		$bbcode[] = ':blind:'; $html[] = $pre.'17'.$end;
		$bbcode[] = ':hot:'; $html[] = $pre.'18'.$end;
		$bbcode[] = ':cold:'; $html[] = $pre.'19'.$end;
		$bbcode[] = ':zombie:'; $html[] = $pre.'20'.$end;
		$bbcode[] = ':noo:'; $html[] = $pre.'21'.$end;
		$bbcode[] = ':crying:'; $html[] = $pre.'22'.$end;
		$bbcode[] = ':shrug:'; $html[] = $pre.'23'.$end;
		$bbcode[] = ':grin:'; $html[] = $pre.'24'.$end;
		$bbcode[] = ':winky:'; $html[] = $pre.'25'.$end;
		$bbcode[] = ':cool:'; $html[] = $pre.'26'.$end;
		$bbcode[] = ':blaf:'; $html[] = $pre.'27'.$end;
		$bbcode[] = ':bobo:'; $html[] = $pre.'28'.$end;
		return str_replace($bbcode, $html, $text);
	}
}
?>