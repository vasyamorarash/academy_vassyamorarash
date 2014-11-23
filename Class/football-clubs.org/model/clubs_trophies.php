<?php
Class Clubs_Trophies extends FootballClubs{	
	private $club_id;
	private $trophy_id;
	public function __construct(){
		$this->table_name = "clubs_trophies";
	}
}
?>