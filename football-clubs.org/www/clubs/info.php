<?php
	require('Z:\home\football-clubs.org\_data\connect.php');
	if (!$link_id){
		$link_id = mysql_connect($db_lc,$db_login,$db_password);
	}else{
		die("Can't create connection!" . mysql_error());
	}
	mysql_select_db($db_name,$link_id);
	Class Clubs{
		public $id;
		public $name;
		public $town_name;
		public $country_name;
		public $league_name;
		public $year; 
		public $trophy_count;
		public $annual_budget;
		public $president_name;
		public $stadion_name; 
	}
require('output.php');
require('input.php');
?>