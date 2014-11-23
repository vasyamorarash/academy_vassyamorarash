<?php
Class Clubs_Leagues extends FootballClubs{	
	protected $table_name = "clubs_leagues";
	private $club_id;
	private $league_id;

	public function __construct(){
		$this->table_name = "clubs_leagues";
	}
}
?>