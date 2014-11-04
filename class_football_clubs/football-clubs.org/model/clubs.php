<?php
Class Clubs extends FootballClubs{	
	private $name;
	private $town;
	private $country;
	private $leagues;
	private $year;
	private $trophy_count = 0;
	private $annual_budget;
	private $president;
	private $stadium;
	public function __construct(){
		$this->table_name = "clubs";
	}
	public function __get($var){
		return $this->$var;
	}
	public function __set($var,$value){
		$this->$var = $value;
	}
	public function delete($clubId){
		$sql = "DELETE FROM `clubs_trophies` WHERE `clubs_trophies`.`club_id` = $clubId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`club_id` = $clubId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `clubs` WHERE `clubs`.`id` = $clubId";
		$result_id = mysql_query($sql);
	}	
}
?>