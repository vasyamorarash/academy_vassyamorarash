<?php
Class Trophies extends FootballClubs{	
	private $name;
	private $year;
	public function __construct(){
		$this->table_name = "trophies";
	}
	public function delete($trophyId){
		$sql = "DELETE FROM `clubs_trophies` WHERE `clubs_trophies`.`trophy_id` = $trophyId";
			$result_id = mysql_query($sql);
			$sql = "DELETE FROM `trophies` WHERE `trophies`.`id` = $trophyId";
			$result_id = mysql_query($sql);
	}	
}
?>