<?php
Class Leagues extends FootballClubs{	
	private $name;
	private $country_id;
	private $uefa_rating;
	private $president_id;
	public function __construct(){
		$this->table_name = "leagues";
	}
	public function delete($leagueId){
		$sql = "DELETE FROM `clubs_leagues` WHERE `clubs_leagues`.`league_id` = $leagueId";
		$result_id = mysql_query($sql);
		$sql = "DELETE FROM `leagues` WHERE `leagues`.`id` = $leagueId";
		$result_id = mysql_query($sql);
	}	
}
?>