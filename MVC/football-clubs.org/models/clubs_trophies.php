<?php
Class Clubs_Trophies extends FootballClubs{	
	protected $table_name = "clubs_trophies";
	private $club_id;
	private $trophy_id;

	public function __construct(){
		$this->table_name = "clubs_trophies";
	}
}
?>