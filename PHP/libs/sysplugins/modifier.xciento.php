<?php 
/** 
 * Smarty plugin 
 * @package Smarty 
 * @subpackage plugins 
 */ 

function smarty_modifier_xciento($num, $total, $sep = 1){
		$result = ($num*100)/$total;
		if($sep) return round($result, $sep);
		else return ceil($result);
	}

/* vim: set expandtab: */ 

?> 