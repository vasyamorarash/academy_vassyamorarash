<?php
Class Stadiums extends FootballClubs{	
	private $name;
	private $year;
	private $capacity;
	public function __construct(){
		$this->table_name = "stadiums";
	}	
}
?>