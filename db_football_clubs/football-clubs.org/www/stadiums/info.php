<?php
	require('Z:\home\football-clubs.org\_data\connect.php');
	if (!$link_id){
		$link_id = mysql_connect($db_lc,$db_login,$db_password);
	}else{
		die("Can't create connection!" . mysql_error());
	}
	mysql_select_db($db_name,$link_id);
require('output.php');
require('input.php');
?>