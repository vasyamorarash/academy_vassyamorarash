<?php
Class Clubs_Leagues extends FootballClubs{	
	private $club_id;
	private $league_id;
	public function __construct(){
		$this->table_name = "clubs_leagues";
	}
}
?>